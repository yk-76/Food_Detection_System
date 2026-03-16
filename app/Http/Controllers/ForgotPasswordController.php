<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Mail\ResetCodeMail;
use Illuminate\Support\Facades\Mail; 

class ForgotPasswordController extends Controller
{
    public function sendResetCode(Request $request)
    {
        $request->validate([
            'contactMethod' => 'required|in:email,phone', 
            'email' => 'required_if:contactMethod,email|email|nullable',
            'phone' => 'required_if:contactMethod,phone|nullable',
        ]);

        $user = ($request->contactMethod === 'email') 
            ? User::where('Email', $request->email)->first()
            : User::where('PhoneNo', $request->phone)->first();

        if (!$user) {
            return back()->withErrors(['error' => 'No account found with those details.']);
        }

        $code = rand(100000, 999999);
        
        $user->update([
            'reset_token_hash' => Hash::make($code),
            'reset_token_expires_at' => Carbon::now()->addMinutes(15),
        ]);

        // 5. Send the code via Mail
        Mail::to($user->Email)->send(new ResetCodeMail($code));

        return redirect()->route('password.verify', ['id' => $user->UserID])
                         ->with('status', 'Verification code sent!');
    } 

    public function resetPassword(Request $request)
{
    $request->validate([
        'user_id'  => 'required',
        'code'     => 'required|digits:6',
        'password' => 'required|min:8|confirmed', 
    ]);

    // Find user by the string ID
    $user = User::where('UserID', $request->user_id)->first();

    if (!$user) {
        return back()->withErrors(['code' => 'User session expired. Please restart the process.']);
    }

    // Verify the code
    if (!Hash::check($request->code, $user->reset_token_hash)) {
        return back()->withErrors(['code' => 'Invalid verification code.']);
    }

    // Check expiry
    if (Carbon::now()->isAfter($user->reset_token_expires_at)) {
        return back()->withErrors(['code' => 'Code has expired.']);
    }

    // Success: Update password and clear reset fields
    $user->update([
        'Password' => Hash::make($request->password),
        'reset_token_hash' => null,
        'reset_token_expires_at' => null,
    ]);

    return redirect('/')->with('status', 'Password reset successful!');
}
}