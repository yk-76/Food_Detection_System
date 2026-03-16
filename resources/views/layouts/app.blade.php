<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EatWise</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>      {{-- using sswalFire cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>     {{-- using tensor flow --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">      {{-- tailwind css --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>      {{-- using chart cdn --}}
    <script src="https://cdn.roboflow.com/0.2.26/roboflow.js"></script>      {{-- using roboflow cdn --}}
</head>
<body class="bg-gray-50">

<!--NAVBAR -->
<nav class="sticky top-0 z-9999! w-full bg-orange-50/95 backdrop-blur-md shadow-sm">
    <div class="w-full lg:container mx-auto px-4 h-16 flex items-center justify-between">

        <!--LOGO-->
        <a href="{{ url('/') }}" class="flex items-center shrink-0 no-underline!">
            <img src="{{ asset('image/Logo.png') }}" alt="EatWise Logo" class="h-6 w-auto object-contain">
        </a>

        <!--DESKTOP MENU-->
        <div class="hidden lg:flex items-center space-x-8">
            <a href="{{ url('/') }}" class="text-sm font-semibold text-gray-500! no-underline! hover:text-gray-800! transition-colors">Home</a>
            <a href="{{ route('about') }}" class="text-sm font-semibold text-gray-500! no-underline! hover:text-gray-800! transition-colors">About Us</a>
            @guest
                <a href="javascript:void(0);" 
                id="serviceLoginTrigger"
                class="text-sm font-semibold text-gray-500! no-underline! hover:text-gray-800! transition-colors">
                    Services
                </a>
            @else
                <a href="{{ route('services') }}" 
                class="text-sm font-semibold text-gray-500! no-underline! hover:text-gray-800! transition-colors">
                    Services
                </a>
            @endguest
            
           @guest
                <button id="loginBtn">
                    <a class="text-sm font-semibold text-orange-500! no-underline! hover:text-orange-700! transition-colors">Login</a>
                </button>
           @else
                <!-- DESKTOP DROPDOWN -->
                <div class="relative!">
                    <button id="desktopDropdownBtn" class="flex items-center group no-underline! focus:outline-none">
                        <div class="w-9 h-9 rounded-full bg-orange-100 flex items-center justify-center border-2 border-orange-200 group-hover:bg-orange-400 transition-all duration-300">
                            <i class="fas fa-user text-orange-500 group-hover:text-white text-sm"></i>
                        </div>
                        <span class="ml-2 text-sm font-semibold text-gray-500! group-hover:text-gray-800! transition-colors">
                            {{ auth()->user()->UserName }}
                        </span>
                        <i class="fas fa-chevron-down ml-2 text-xs text-gray-500 group-hover:text-gray-800 transition-transform duration-200" id="desktopDropdownIcon"></i>
                    </button>

                    <!-- DROPDOWN MENU -->
                    <div id="desktopDropdownMenu" class="absolute! right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden opacity-0 invisible transform scale-95 transition-all duration-200 origin-top-right z-10000!">
                        <a href="{{ route('profile') }}" class="flex items-center px-4 py-3 text-sm! text-gray-700! hover:bg-orange-50 transition-colors no-underline!">
                            <i class="fas fa-user-circle mr-3 text-orange-500 flex! items-center!"></i>
                            View Profile
                        </a>
                        <a href="{{route('record.record')}}" class="flex items-center px-4 py-3 text-sm! text-gray-700! hover:bg-orange-50 transition-colors no-underline!">
                            <i class="fas fa-file-alt mr-3 text-orange-500 flex! items-center!"></i>
                            View Record
                        </a>
                        <div class="border-t border-gray-200"></div>
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="flex! items-center! w-full px-4 py-3 text-sm! text-gray-700! hover:bg-orange-50 transition-colors text-left">
                                <i class="fas fa-sign-out-alt mr-3 text-orange-500 flex! items-center!"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endguest
        </div>

        <!--BURGER BUTTON-->
        <button id="mobile-menu-button" class="lg:hidden text-orange-400! hover:bg-white/20 rounded-lg transition-colors">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobile-menu" class="lg:hidden overflow-hidden max-h-0 opacity-0 transition-all duration-400 ease-in-out bg-orange-50">
        <div>
            <a href="{{ url('/') }}"
            class="text-sm font-semibold text-gray-500! no-underline! hover:text-gray-800! transition-colors block odd:bg-orange-100 even:bg-orange-50">
                <span class="w-full lg:container flex px-4 py-3">
                    Home
                </span>
            </a>

            <a href="{{ route('about') }}"
            class="text-sm font-semibold text-gray-500! no-underline! hover:text-gray-800! transition-colors block odd:bg-orange-100 even:bg-orange-50">
                <span class="w-full lg:container flex px-4 py-3">
                    About Us
                </span>
            </a>

            @guest
                <a href="javascript:void(0);" 
                id="serviceLoginTriggerMobile"
                class="text-sm font-semibold text-gray-500! no-underline! hover:text-gray-800! transition-colors block odd:bg-orange-100 even:bg-orange-50">
                    <span class="w-full lg:container flex px-4 py-3">
                        Services
                    </span>
                </a>
            @else
                <a href="{{ route('services') }}"
                class="text-sm font-semibold text-gray-500! no-underline! hover:text-gray-800! transition-colors block odd:bg-orange-100 even:bg-orange-50">
                    <span class="w-full lg:container flex px-4 py-3">
                        Services
                    </span>
                </a>
            @endguest

            </a>

            @guest
                <button id="loginBtnMobile" class="w-full odd:bg-orange-100 even:bg-orange-50">
                    <a class="flex px-4 py-3 text-sm font-semibold text-orange-500! no-underline! hover:text-orange-700! transition-colors">
                        Login
                    </a>
                </button>
            @else
                <!-- MOBILE DROPDOWN -->
                <div class="odd:bg-orange-100 even:bg-orange-50">
                    <button id="mobileDropdownBtn" class="flex items-center justify-between w-full px-4 py-3 text-smfont-semibold text-gray-500! hover:text-gray-800! transition-colors">
                        <span class="flex items-center">
                            <i class="fas fa-user-circle mr-3 text-orange-500 text-lg"></i>
                            {{ auth()->user()->UserName }}
                        </span>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200" id="mobileDropdownIcon"></i>
                    </button>
                    
                    <!-- MOBILE DROPDOWN CONTENT -->
                    <div id="mobileDropdownContent" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-orange-200/50">
                        <a href="{{ route('profile') }}" class="flex items-center px-8 py-2 text-sm! text-gray-700! hover:text-gray-800 no-underline! transition-colors">
                            <i class="fas fa-user-circle mr-4 h-[10px]! w-[10px]! text-orange-500 flex! justify-start!"></i>
                            View Profile
                        </a>
                        <a href="{{ route('record.record') }}" class="flex items-center px-8 py-2 text-sm! text-gray-700! hover:text-gray-800 no-underline! transition-colors">
                            <i class="fas fa-file-alt mr-4 h-[10px]! w-[10px]! text-orange-500 flex! justify-start!"></i>
                            View Record
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-8 py-2 text-sm! text-gray-700! hover:text-orange-700 transition-colors text-left">
                                <i class="fas fa-sign-out-alt mr-4 h-[10px]! w-[10px]! text-orange-500 flex! justify-start!"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="bg-gray-900 text-light text-xs py-5 flex items-center">
    <div class="container text-center">
        <a href="{{ url('/') }}" class="flex items-center shrink-0 no-underline!">
            <img class="block mx-auto h-4 w-auto mb-2" src="{{ asset('image/Logo_white.png') }}" alt="EatWise Logo" />
        </a>
        <p class="mb-0">&copy; {{ date('Y') }} EatWise. All Rights Reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('authModal');
    const loginBtns = [document.getElementById('loginBtn'), document.getElementById('loginBtnMobile')];
    const closeBtn = document.getElementById('closeBtn');
    
    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    // TOGGLE MENU
    mobileMenuBtn.addEventListener('click', (e) => {
        e.stopPropagation(); // prevent outside click trigger

        if (mobileMenu.classList.contains('max-h-0')) {
            // OPEN
            mobileMenu.classList.remove('max-h-0', 'opacity-0');
            mobileMenu.classList.add('max-h-[500px]', 'opacity-100');
        } else {
            // CLOSE
            closeMobileMenu();
        }
    });

    // CLICK OUTSIDE TO CLOSE
    document.addEventListener('click', (e) => {
        if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
            closeMobileMenu();
        }
    });

    // CLOSE FUNCTION
    function closeMobileMenu() {
        mobileMenu.classList.remove('max-h-[500px]', 'opacity-100');
        mobileMenu.classList.add('max-h-0', 'opacity-0');
    }

    // Modal Controls
    loginBtns.forEach(btn => {
        if (btn && modal) {
            btn.addEventListener('click', () => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            });
        }
    });

    if(closeBtn && modal) {
        closeBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        });
    }

    // Close on outside click
    window.addEventListener('click', (e) => {
        if (modal && e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    });

    // ============================================
    // NEW SCRIPT START FROM HERE - DROPDOWN FUNCTIONALITY
    // ============================================
    
    // DESKTOP DROPDOWN
    const desktopDropdownBtn = document.getElementById('desktopDropdownBtn');
    const desktopDropdownMenu = document.getElementById('desktopDropdownMenu');
    const desktopDropdownIcon = document.getElementById('desktopDropdownIcon');

    // SERVICES CLICK → OPEN LOGIN MODAL
    const serviceLoginTrigger = document.getElementById('serviceLoginTrigger');
    const serviceLoginTriggerMobile = document.getElementById('serviceLoginTriggerMobile');

    if (serviceLoginTrigger) {
        serviceLoginTrigger.addEventListener('click', () => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        });
    }

    if (serviceLoginTriggerMobile) {
        serviceLoginTriggerMobile.addEventListener('click', () => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        });
    }

    if (desktopDropdownBtn && desktopDropdownMenu) {
        // Toggle dropdown on button click
        desktopDropdownBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleDesktopDropdown();
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!desktopDropdownMenu.contains(e.target) && !desktopDropdownBtn.contains(e.target)) {
                closeDesktopDropdown();
            }
        });

        function toggleDesktopDropdown() {
            if (desktopDropdownMenu.classList.contains('opacity-0')) {
                // Open
                desktopDropdownMenu.classList.remove('opacity-0', 'invisible', 'scale-95');
                desktopDropdownMenu.classList.add('opacity-100', 'visible', 'scale-100');
                desktopDropdownIcon.style.transform = 'rotate(180deg)';
            } else {
                // Close
                closeDesktopDropdown();
            }
        }

        function closeDesktopDropdown() {
            desktopDropdownMenu.classList.remove('opacity-100', 'visible', 'scale-100');
            desktopDropdownMenu.classList.add('opacity-0', 'invisible', 'scale-95');
            desktopDropdownIcon.style.transform = 'rotate(0deg)';
        }
    }

    // MOBILE DROPDOWN
    const mobileDropdownBtn = document.getElementById('mobileDropdownBtn');
    const mobileDropdownContent = document.getElementById('mobileDropdownContent');
    const mobileDropdownIcon = document.getElementById('mobileDropdownIcon');

    if (mobileDropdownBtn && mobileDropdownContent) {
        mobileDropdownBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            
            if (mobileDropdownContent.classList.contains('max-h-0')) {
                // Open
                mobileDropdownContent.classList.remove('max-h-0');
                mobileDropdownContent.classList.add('max-h-[300px]');
                mobileDropdownIcon.style.transform = 'rotate(180deg)';
            } else {
                // Close
                mobileDropdownContent.classList.remove('max-h-[300px]');
                mobileDropdownContent.classList.add('max-h-0');
                mobileDropdownIcon.style.transform = 'rotate(0deg)';
            }
        });
    }

    // ============================================
    // END OF NEW SCRIPT
    // ============================================
});
</script>
</body>
</html>