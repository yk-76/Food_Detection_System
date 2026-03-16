@extends('layouts.app')
@if (session('success_logout'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Logged Out',
            text: '{{ session("success_logout") }}',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
            iconColor: '#10b981', // Green color
        });
    });
</script>
@endif
@section('content')

<!--HERO-->
<div id="carouselExampleFade" class="relative h-[500px] lg:h-[800px]! bg-gray-900">
    <div class="absolute inset-0 z-10! bg-white/10"></div>
    <img src="{{ asset('image/Carousel_01.jpg') }}" class="absolute inset-0 w-full h-full object-cover" alt="Product Classification" />
    
    <div class="relative z-20 flex items-center justify-center h-full px-4">
        <div class="max-w-2xl bg-black/30 backdrop-blur-xs py-10 px-8 text-center rounded-2xl border border-white/10" data-aos="fade-up">
            <p class="text-xl md:text-2xl lg:text-3xl font-bold text-white mb-2 md:mb-3">Smart Food Classification</p>
            <p class="text-lg md:text-xl lg:text-2xl font-light text-white/90 mb-3 md:mb-4">
                AI-powered analysis to help you choose healthier food options effortlessly!
            </p>
            @auth
                <a href="{{ route('services') }}" 
                class="inline-block border-2 border-orange-400 bg-orange-400/30 hover:bg-orange-400 visited:text-orange-50! visited:hover:text-white! font-bold py-2 px-10 rounded-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-orange-400/40 text-sm md:text-base lg:text-lg no-underline!">
                    Start Now
                </a>
            @else
                <button id="startNowBtn"
                    class="inline-block border-2 border-orange-400 bg-orange-400/30 hover:bg-orange-400 text-orange-50 hover:text-white font-bold py-2 px-10 rounded-xl! transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-orange-400/40 text-sm md:text-base lg:text-lg no-underline!">
                    Start Now
                </button>
            @endauth
        </div>
    </div>
</div>

<!--CARDS-->
<div class="w-full lg:container bg-orange-50/40 mx-auto py-8 lg:py-16 px-4" data-aos="fade-up">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8!">

        <!-- CARD 1 -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100 hover:shadow-xl transition-shadow flex flex-col">
            <img src="{{ asset('image/Card_01.jpg') }}" alt="Card Image 1" class="w-full h-48 object-cover" />
            <div class="p-3 lg:p-6! text-center md:text-left! flex flex-col flex-1">
                <div>
                    <p class="font-semibold text-lg lg:text-xl mb-0 md:mb-1 text-gray-800">Know What You Eat</p>
                    <p class="text-gray-600 leading-relaxed mb-2 md:mb-3! text-sm lg:text-base">
                        Track what you eat, whether healthy or junk.
                    </p>
                </div>

                <!-- Nav Link -->
                <a href="#"
                class="mt-auto inline-flex items-center gap-3 self-center lg:self-end! border-1 border-orange-400 rounded-full p-2 px-3 transition-all duration-300 group hover:bg-orange-400 no-underline!">
                    <span class="font-semibold text-orange-400 group-hover:text-white text-sm md:text-base">Try Now</span>
                    <span class="w-6 h-6 flex items-center justify-center border-2 border-orange-400 rounded-full text-orange-400 group-hover:bg-white group-hover:text-orange-400 transition-all duration-300">
                        <!-- Right Arrow SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>

        <!-- CARD 2 -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100 hover:shadow-xl transition-shadow flex flex-col">
            <img src="{{ asset('image/Card_02.jpg') }}" alt="Card Image 1" class="w-full h-48 object-cover" />
            <div class="p-3 lg:p-6! text-center md:text-left! flex flex-col flex-1">
                <div>
                    <p class="font-semibold text-lg lg:text-xl mb-0 md:mb-1 text-gray-800">Categorize Your Food</p>
                    <p class="text-gray-600 leading-relaxed mb-2 md:mb-3! text-sm lg:text-base">
                        AI identifies and classifies your meals from images.
                    </p>
                </div>

                <!-- Nav Link -->
                <a href="#"
                class="mt-auto inline-flex items-center gap-3 self-center lg:self-end! border-1 border-orange-400 rounded-full p-2 px-3 transition-all duration-300 group hover:bg-orange-400 no-underline!">
                    <span class="font-semibold text-orange-400 group-hover:text-white text-sm md:text-base">Try Now</span>
                    <span class="w-6 h-6 flex items-center justify-center border-2 border-orange-400 rounded-full text-orange-400 group-hover:bg-white group-hover:text-orange-400 transition-all duration-300">
                        <!-- Right Arrow SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>

        <!-- CARD 3 -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100 hover:shadow-xl transition-shadow flex flex-col">
            <img src="{{ asset('image/Card_03.jpg') }}" alt="Card Image 1" class="w-full h-48 object-cover" />
            <div class="p-3 lg:p-6! text-center md:text-left! flex flex-col flex-1">
                <div>
                    <p class="font-semibold text-lg lg:text-xl mb-0 md:mb-1 text-gray-800">Healthy Suggestions</p>
                    <p class="text-gray-600 leading-relaxed mb-2 md:mb-3! text-sm lg:text-base">
                        Get recommendations based on your eating habits.
                    </p>
                </div>

                <!-- Nav Link -->
                <a href="#"
                class="mt-auto inline-flex items-center gap-3 self-center lg:self-end! border-1 border-orange-400 rounded-full p-2 px-3 transition-all duration-300 group hover:bg-orange-400 no-underline!">
                    <span class="font-semibold text-orange-400 group-hover:text-white text-sm md:text-base">Try Now</span>
                    <span class="w-6 h-6 flex items-center justify-center border-2 border-orange-400 rounded-full text-orange-400 group-hover:bg-white group-hover:text-orange-400 transition-all duration-300">
                        <!-- Right Arrow SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>


<div id="authModal" class="fixed inset-0 z-2000 hidden items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full relative overflow-hidden max-h-[90vh] flex flex-col">
        <button id="closeBtn" class="absolute top-4 right-4 text-3xl text-gray-400 hover:text-gray-800 transition-colors z-30">&times;</button>

        <div class="p-8 overflow-y-auto">
            
        @include('login.login') {{-- This calls resources/views/login/login.blade.php --}}

        @include('register.register') {{-- This calls resources/views/register/register.blade.php --}}

        </div>
    </div>
</div>

<style>
    .active-tab-blue { 
        background-color: #fb923c !important;
        color: white !important; /* text-blue-600 */
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const authModal = document.getElementById('authModal');
    const loginSection = document.getElementById('loginSection');
    const registerSection = document.getElementById('registerSection');
    const startBtn = document.getElementById('startNowBtn');
    const closeBtn = document.getElementById('closeBtn');

    // Section Toggling (Login vs Register)
    document.getElementById('showRegisterLink').addEventListener('click', () => {
        loginSection.classList.add('hidden');
        registerSection.classList.remove('hidden');
    });

    document.getElementById('showLoginLink').addEventListener('click', () => {
        registerSection.classList.add('hidden');
        loginSection.classList.remove('hidden');
    });

    // Modal Visibility
    startBtn.addEventListener('click', () => {
        authModal.classList.remove('hidden');
        authModal.classList.add('flex'); // Ensure flex is added when shown
        document.body.style.overflow = 'hidden';
    });

    closeBtn.addEventListener('click', () => {
        authModal.classList.add('hidden');
        authModal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    });

    // Login Method Toggling (Traditional vs QR)
    window.switchLoginMethod = function(method) {
        const tradSection = document.getElementById('traditionalFields');
        const qrSection = document.getElementById('qrFields');
        const tradTab = document.getElementById('traditionalTab');
        const qrTab = document.getElementById('qrTab');

        if (method === 'traditional') {
            tradSection.classList.remove('hidden');
            qrSection.classList.add('hidden');
            tradTab.classList.add('active-tab-blue');
            tradTab.classList.remove('text-gray-500');
            qrTab.classList.remove('active-tab-blue');
            qrTab.classList.add('text-gray-500');
        } else {
            qrSection.classList.remove('hidden');
            tradSection.classList.add('hidden');
            qrTab.classList.add('active-tab-blue');
            qrTab.classList.remove('text-gray-500');
            tradTab.classList.remove('active-tab-blue');
            tradTab.classList.add('text-gray-500');
        }
    };

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('showLogin')) {
        const authModal = document.getElementById('authModal');
        if (authModal) {
            authModal.classList.remove('hidden');
            authModal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
    }

    const desktopToken = document.getElementById('desktopLoginToken')?.value;

    if (desktopToken) {

        const checkStatusInterval = setInterval(async () => {
            const currentToken = document.getElementById('desktopLoginToken')?.value;
            
            if (!currentToken) return;

            try {
                const response = await fetch(`/check-qr-status/${currentToken}`);
                const data = await response.json();

                if (data.authenticated) {
                    clearInterval(checkStatusInterval);
                    
                    // Close modal and redirect
                    const authModal = document.getElementById('authModal');
                    if (authModal) {
                        authModal.classList.add('hidden');
                        authModal.classList.remove('flex');
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful!',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.assign('/');
                    });
                }
            } catch (error) {
                console.error('QR Check Error:', error);
            }
        }, 3000);
            }
});

async function refreshQr() {
    const refreshBtn = event.currentTarget;
    const svgWrapper = document.getElementById('qrSvgWrapper');
    const tokenInput = document.getElementById('desktopLoginToken');

    refreshBtn.classList.add('animate-pulse');
    svgWrapper.style.opacity = '0.5';

    try {
        const response = await fetch('/refresh-qr');
        const data = await response.json();

        if (data.token && data.svg) {
            document.getElementById('desktopLoginToken').value = data.token; 
            document.getElementById('qrSvgWrapper').innerHTML = data.svg;
        }
    } catch (error) {
        console.error('Refresh failed', error);
    } finally {
        refreshBtn.classList.remove('animate-pulse');
    }
}
</script>
@endsection