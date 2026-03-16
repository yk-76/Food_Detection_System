@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-orange-50/50 py-12 px-4">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl border border-orange-100">
        <div>
            <h2 class="text-center text-3xl font-extrabold text-orange-400">Verify & Reset</h2>
            <p class="mt-2 text-center text-sm text-orange-600">
                Enter the 6-digit code and choose a new password.
            </p>
        </div>

        <form action="{{ route('password.update') }}" method="POST" class="mt-8 space-y-4">
            @csrf
            <input type="hidden" name="user_id" value="{{ $id }}">

            {{-- Verification Code --}}
            <div>
                <label class="block text-sm font-medium text-orange-700">6-Digit Code</label>
                <input name="code" type="text" maxlength="6" required 
                    class="appearance-none block w-full px-3 py-3 border border-orange-300 rounded-xl text-center text-2xl tracking-widest focus:ring-orange-500 focus:border-orange-500">
                @error('code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            {{-- New Password --}}
            <div>
                <label class="block text-sm font-medium text-orange-700">New Password</label>
                <input name="password" type="password" required 
                    class="appearance-none block w-full px-3 py-3 border border-orange-300 rounded-xl focus:ring-orange-500 focus:border-orange-500">
            </div>

            {{-- Confirm Password --}}
            <div>
                <label class="block text-sm font-medium text-orange-700">Confirm New Password</label>
                <input name="password_confirmation" type="password" required 
                    class="appearance-none block w-full px-3 py-3 border border-orange-300 rounded-xl focus:ring-orange-500 focus:border-orange-500">
                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-xl transition-all">
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection