<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm() {
    // Only generate a token if the user is NOT logged in
    if (!Auth::check()) {
        $loginToken = Str::random(40);
        Cache::put('qr_login_' . $loginToken, ['status' => 'pending'], 300);
        return view('index.index', compact('loginToken'));
    }

    // If already logged in, just show the page
    return view('index.index');
}


public function checkStatus($token) {
    $data = Cache::get('qr_login_' . $token);

    if ($data && $data['status'] === 'authenticated') {
        // Perform the actual login in the background
        Auth::loginUsingId($data['user_id']);
        Cache::forget('qr_login_' . $token); 
        
        return response()->json(['authenticated' => true]); 
    }

    return response()->json(['authenticated' => false]);
}

// Step B: The Mobile Phone hits this.
public function confirmQrLogin($token) {
    if (!Auth::check()) {
        return redirect('/')->withErrors(['loginError' => 'Please log in on mobile first.']);
    }

    if (Cache::has('qr_login_' . $token)) {
        Cache::put('qr_login_' . $token, [
            'status' => 'authenticated',
            'user_id' => Auth::id() 
        ], 300);

        // After scanning, take the mobile user back to their profile
        return redirect()->route('profile')->with('success', 'PC Login Authorized!');
    }

    return redirect('/')->withErrors(['loginError' => 'QR Session expired.']);
}

public function refreshQrCode() {
    $newToken = \Str::random(40);
    
    // Store the new session in cache for 5 minutes
    \Cache::put('qr_login_' . $newToken, ['status' => 'pending'], 300);

    // Generate the SVG string
    // Note: We use the same format as your blade file
    $qrCodeSvg = \QrCode::size(180)->generate(url('/qr-login/' . $newToken));

    return response()->json([
        'token' => $newToken,
        'svg' => (string)$qrCodeSvg
    ]);
}

}
