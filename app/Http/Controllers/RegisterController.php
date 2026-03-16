<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;            
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

public function login(Request $request)
{
    $credentials = $request->validate([
        'userName' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt(['UserName' => $credentials['userName'], 'password' => $credentials['password']], $request->has('rememberMe'))) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'loginError' => 'Invalid username or password.',
    ])->withInput();
}

    public function register(Request $request)
{
    // 1. Validation
    $request->validate([
        'userName'    => 'required|unique:user,UserName|max:100',
        'email'       => 'required|email|unique:user,Email',
        'phoneNo'     => 'required|max:20',
        'dateOfBirth' => 'required|date',
        'gender'      => 'required|in:male,female',
        'password'    => 'required|min:6',
    ]);

    $lastUser = User::orderBy('UserID', 'desc')->first();

    if (!$lastUser) {
        // If no user exists, start with C0001
        $newUserId = 'C0001';
    } else {
        // Extract the numeric part (e.g., 0001 from C0001)
        $number = substr($lastUser->UserID, 1);
        
        // Increment the number and pad with leading zeros to 4 digits
        $newUserId = 'C' . str_pad((int)$number + 1, 4, '0', STR_PAD_LEFT);
    }

    // 3. Save to Database
    $user = User::create([
        'UserID'      => $newUserId,
        'UserName'    => $request->userName,
        'Email'       => $request->email,
        'Password'    => Hash::make($request->password), 
        'PhoneNo'     => $request->phoneNo,
        'DateOfBirth' => $request->dateOfBirth,
        'Gender'      => $request->gender,
        'CreatedAt'   => now(),
        'Role'        => 'user',
    ]);

    // 4. Log the user in
    auth()->login($user);

    return redirect('/')->with('success', 'Account created successfully!');
}
    
}