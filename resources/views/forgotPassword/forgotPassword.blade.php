@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-orange-50/50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl border border-orange-100">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-orange-400!">Reset Password</h2>
            <p class="mt-2 text-center text-sm text-orange-600">
                Choose how you want to receive your verification code.
            </p>
        </div>

        <div class="flex p-1 bg-orange-100 rounded-full! mb-6">
            <button onclick="toggleMethod('email')" id="btnEmail" class="flex-1 py-2 px-4 rounded-full! font-bold text-sm transition-all bg-white text-orange-600! shadow-sm">
                Email
            </button>
            <button onclick="toggleMethod('phone')" id="btnPhone" class="flex-1 py-2 px-4 rounded-full! font-bold text-sm transition-all text-orange-500 hover:text-orange-600">
                Phone
            </button>
        </div>

@if($errors->any())
    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
        <p class="text-sm text-red-700">{{ $errors->first() }}</p>
    </div>
@endif

@if(session('status'))
    <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4">
        <p class="text-sm text-green-700">{{ session('status') }}</p>
    </div>
@endif

        <form id="forgotPasswordForm" action="{{ route('password.email') }}" method="POST" class="mt-8 space-y-6">
            @csrf
            <input type="hidden" name="contactMethod" id="contactMethod" value="email">

            <div id="emailInputGroup">
                <label for="email" class="block text-sm font-medium text-orange-700">Email Address</label>
                <div class="mt-1 relative">
                    <div class="absolute inset-y-0 left-0! pl-3! flex! items-center! pointer-events-none">
                        <i class="fa-solid fa-envelope text-orange-400"></i>
                    </div>
                    <input id="email" name="email" type="email" required 
                        class="appearance-none block w-full pl-10! px-3 py-3 border border-orange-300! rounded-xl shadow-sm placeholder-orange-400! focus:outline-none focus:ring-orange-500! focus:border-orange-500! sm:text-sm" 
                        placeholder="name@company.com">
                </div>
            </div>

            <div id="phoneInputGroup" class="hidden">
                <label for="phone" class="block text-sm font-medium text-orange-700">Phone Number</label>
                <div class="mt-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3! flex items-center pointer-events-none">
                        <i class="fa-solid fa-phone text-orange-400!"></i>
                    </div>
                    <input id="phone" name="phone" type="tel" 
                        class="appearance-none block w-full pl-10! px-3 py-3 border border-orange-300! rounded-xl shadow-sm placeholder-orange-400! focus:outline-none focus:ring-orange-500! focus:border-orange-500! sm:text-sm" 
                        placeholder="+60123456789">
                </div>
            </div>

            <div>
                <button type="submit" class="w-full bg-gradient-to-r from-orange-400/80 via-orange-500/90 to-orange-400/80
                    hover:bg-orange-700 text-white font-bold py-4 rounded-xl! transition-all shadow-sm shadow-orange-500/30 active:scale-[0.98]">
                    Send Verification Code
                </button>
            </div>
        </form>

        <div class="text-center">
            <a href="{{ url('/?showLogin=1') }}" class="text-sm font-medium text-orange-600! hover:text-orange-500!">
                <i class="fa-solid fa-arrow-left mr-2!"></i>Back to Login
            </a>
        </div>
    </div>
</div>

<script>
function toggleMethod(method) {
    const emailGroup = document.getElementById('emailInputGroup');
    const phoneGroup = document.getElementById('phoneInputGroup');
    const methodInput = document.getElementById('contactMethod');
    const btnEmail = document.getElementById('btnEmail');
    const btnPhone = document.getElementById('btnPhone');

    methodInput.value = method;

    if (method === 'email') {
        emailGroup.classList.remove('hidden');
        phoneGroup.classList.add('hidden');
        // Set to Orange Theme
        btnEmail.classList.add('bg-white', 'text-orange-600', 'shadow-sm');
        btnPhone.classList.remove('bg-white', 'text-orange-600', 'shadow-sm');
        btnPhone.classList.add('text-orange-400');
    } else {
        phoneGroup.classList.remove('hidden');
        emailGroup.classList.add('hidden');
        // Set to Orange Theme
        btnPhone.classList.add('bg-white', 'text-orange-600', 'shadow-sm');
        btnEmail.classList.remove('bg-white', 'text-orange-600', 'shadow-sm');
        btnEmail.classList.add('text-orange-400');
    }
}
</script>
@endsection