<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FoodResultController;

Route::post('/login', [RegisterController::class, 'login'])->name('login');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    
    return redirect('/')->with('success_logout', 'Successfully logged out!');
})->name('logout');

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/forgot-password', function () {
    return view('forgotPassword.forgotPassword'); 
})->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetCode'])->name('password.email');

Route::get('/verify-password/{id}', function ($id) {
    return view('auth.verifyPassword', ['id' => $id]);
})->name('password.verify');

Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

Route::get('/about', function () { return view('about.aboutUs'); })->name('about');

Route::get('/services', function () { return view('service.services'); })->name('services');

Route::get('/', [LoginController::class, 'showLoginForm']);
Route::get('/check-qr-status/{token}', [LoginController::class, 'checkStatus']);
Route::get('/qr-login/{token}', [LoginController::class, 'confirmQrLogin'])->middleware('auth');
Route::get('/scan', function () {
    return view('scanner'); // Create a link to this page for logged-in mobile users
})->middleware('auth');

Route::get('/profile', function () {
    return view('profile.profile'); 
})->middleware('auth')->name('profile');

Route::get('/refresh-qr', [LoginController::class, 'refreshQrCode']);


Route::get('/records', [FoodResultController::class, 'index'])->name('record.record')->middleware('auth');

Route::post('/store-analysis', [\App\Http\Controllers\ServiceController::class, 'storeAnalysis'])->middleware('auth');