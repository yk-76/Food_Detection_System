@extends('layouts.app')

<script src="https://unpkg.com/html5-qrcode"></script>

@section('content')
<div class="container mx-auto py-4 lg:py-12! px-4">
    <div class="w-full lg:container">
        <!-- Main Profile Card -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Header Banner with Centered Profile Picture -->
            <div class="bg-gradient-to-r from-orange-400 to-orange-500 h-20 md:h-30! flex items-end justify-center pb-0">
                <div class="w-24 h-24 lg:w-32! lg:h-32! bg-white rounded-full p-2 shadow-md transform translate-y-12 lg:translate-y-16!">
                    <div class="w-full h-full bg-orange-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-orange-400 text-3xl lg:text-5xl!"></i>
                    </div>
                </div>
            </div>
            
            <div class="px-3 pb-3 md:px-8! md:pb-8!">
                <!-- User Info Section -->
                <div class="mt-20">
                    <div class="text-center">
                        <h1 class="text-3xl font-bold text-gray-800">{{ auth()->user()->UserName }}</h1>
                        <p class="text-gray-500 mt-2">
                            <i class="fas fa-envelope text-orange-400 mr-2"></i>
                            {{ auth()->user()->Email ?? 'No email provided' }}
                        </p>
                    </div>

                    <!-- User Details - Responsive Grid (1 column on mobile, 2 columns on tablet/laptop) -->
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-3">
                        <!-- Phone Number -->
                        <div class="p-3 md:p-4! bg-gray-50 rounded-xl border border-gray-100 hover:border-orange-200 transition-all">
                            <p class="text-xs font-bold text-orange-500 uppercase tracking-wider mb-1">Phone Number</p>
                            <p class="text-gray-700 font-medium mb-0">
                                <i class="fas fa-phone text-orange-400 mr-2"></i>
                                {{ auth()->user()->PhoneNo ?? 'Not provided' }}
                            </p>
                        </div>

                        <!-- Gender -->
                        <div class="p-3 md:p-4!  bg-gray-50 rounded-xl border border-gray-100 hover:border-orange-200 transition-all">
                            <p class="text-xs font-bold text-orange-500 uppercase tracking-wider mb-1">Gender</p>
                            <p class="text-gray-700 font-medium mb-0">
                                @if(auth()->user()->Gender)
                                    <i class="fas fa-{{ auth()->user()->Gender == 'Male' ? 'mars' : (auth()->user()->Gender == 'Female' ? 'venus' : 'genderless') }} text-orange-400 mr-2"></i>
                                    {{ auth()->user()->Gender }}
                                @else
                                    <i class="fas fa-genderless text-orange-400 mr-2"></i>
                                    Not provided
                                @endif
                            </p>
                        </div>

                        <!-- Date of Birth -->
                        <div class="p-3 md:p-4! bg-gray-50 rounded-xl border border-gray-100 hover:border-orange-200 transition-all">
                            <p class="text-xs font-bold text-orange-500 uppercase tracking-wider mb-1">Date of Birth</p>
                            <p class="text-gray-700 font-medium mb-0">
                                <i class="fas fa-birthday-cake text-orange-400 mr-2"></i>
                                {{ auth()->user()->DateOfBirth ? \Carbon\Carbon::parse(auth()->user()->DateOfBirth)->format('M d, Y') : 'Not provided' }}
                            </p>
                        </div>

                        <!-- Member Since -->
                        <div class="p-3 md:p-4!  bg-gray-50 rounded-xl border border-gray-100 hover:border-orange-200 transition-all">
                            <p class="text-xs font-bold text-orange-500 uppercase tracking-wider mb-1">Member Since</p>
                            <p class="text-gray-700 font-medium mb-0">
                                <i class="fas fa-calendar-check text-orange-400 mr-2"></i>
                                {{ auth()->user()->CreatedAt ? \Carbon\Carbon::parse(auth()->user()->CreatedAt)->format('M d, Y') : 'Not available' }}
                            </p>
                        </div>
                    </div>

                    <!-- QR Code Scanner Section -->
                    <div class="mt-6">
                        <div class="p-3 md:p-4! bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl border-2 border-orange-200 flex flex-col items-center gap-4">
                            
                            <!-- Icon Row -->
                            <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center">
                                <i class="fas fa-qrcode text-white text-xl"></i>
                            </div>

                            <!-- Content Row -->
                            <div class="w-full text-center">
                                <h4 class="text-lg font-bold text-orange-700 mb-2">Login to Another Device</h4>
                                <p class="text-sm text-gray-700 mb-4">
                                    Scan the QR code displayed on your PC or tablet to sign in instantly without entering your credentials.
                                </p>
                                
                                <!-- Scanner Button -->
                                <button id="openScannerBtn" class="w-full bg-orange-500 text-white font-bold py-3 px-4 rounded-xl! hover:bg-orange-600 transition-all flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                                    <i class="fas fa-camera"></i> 
                                    <span>Scan QR Code</span>
                                </button>

                                <!-- Scanner Container -->
                                <div id="scannerContainer" class="hidden mt-4">
                                    <!-- Camera Preview -->
                                    <div class="relative">
                                        <div id="reader" class="overflow-hidden rounded-xl border-4 border-orange-400 bg-black shadow-lg"></div>
                                        
                                        <!-- Scanning Indicator -->
                                        <div id="scanningIndicator" class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-2">
                                            <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                                            Scanning...
                                        </div>
                                    </div>
                                    
                                    <!-- Close Button -->
                                    <button id="closeScannerBtn" class="mt-4 w-full py-3 text-sm font-bold text-gray-600 bg-white rounded-xl! hover:bg-gray-100 hover:text-orange-600 transition-all border border-orange-400">
                                        <i class="fas fa-times mr-2"></i>
                                        Stop Camera
                                    </button>

                                    <!-- Instructions -->
                                    <div class="mt-3 p-3 border border-gray-300 bg-gray-50 bg-opacity-70 rounded-lg text-center">
                                        <p class="text-xs text-gray-600 flex items-center justify-center mb-0">
                                            <i class="fas fa-info-circle text-orange-500 mr-3"></i>
                                            Point your camera at the QR code on your other device
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Additional Info Card -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-2xl p-3 md:p-4!">
            <div class="flex items-start gap-3">
                <i class="fas fa-shield-alt text-blue-500 text-2xl mt-1"></i>
                <div>
                    <h5 class="font-bold text-blue-700 mb-1">Account Security</h5>
                    <p class="text-sm text-gray-700">
                        Your account is secured with encrypted password protection. 
                        Never share your login credentials with anyone.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let html5QrCode = null;

document.getElementById('openScannerBtn').addEventListener('click', function() {
    const container = document.getElementById('scannerContainer');
    const openBtn = document.getElementById('openScannerBtn');
    
    container.classList.remove('hidden');
    openBtn.classList.add('hidden');

    html5QrCode = new Html5Qrcode("reader");
    
const config = { fps: 10};
    // Start scanning with the back camera
    html5QrCode.start({ facingMode: "environment" }, config, (decodedText) => {
        // Stop camera immediately upon success
        stopScanner();
        
        // redirect to the URL contained in the QR code 
        // (which is your /qr-login/{token} route)
        window.location.href = decodedText;
    }).catch(err => {
        console.error("Camera error:", err);
        alert("Could not access camera. Please check permissions.");
        stopScanner();
    });
});

document.getElementById('closeScannerBtn').addEventListener('click', stopScanner);

function stopScanner() {
    if (html5QrCode) {
        html5QrCode.stop().then(() => {
            document.getElementById('scannerContainer').classList.add('hidden');
            document.getElementById('openScannerBtn').classList.remove('hidden');
        }).catch(err => console.error("Stop failed", err));
    }
}



/**
 * This script adds visual feedback and animations to the QR scanner
 * It does not modify the core scanning functionality
 */

// Add pulse animation to scanning indicator when camera is active
document.getElementById('openScannerBtn').addEventListener('click', function() {
    setTimeout(() => {
        const indicator = document.getElementById('scanningIndicator');
        if (indicator) {
            // Add smooth fade-in animation
            indicator.style.opacity = '0';
            indicator.style.display = 'flex';
            setTimeout(() => {
                indicator.style.transition = 'opacity 0.3s';
                indicator.style.opacity = '1';
            }, 10);
        }
    }, 500);
});

// Add success visual feedback when QR is scanned
const originalStopScanner = window.stopScanner;
window.stopScanner = function() {
    const reader = document.getElementById('reader');
    if (reader && !reader.classList.contains('hidden')) {
        // Add success flash effect
        const flash = document.createElement('div');
        flash.className = 'absolute inset-0 bg-green-400 opacity-0 pointer-events-none';
        flash.style.transition = 'opacity 0.3s';
        reader.parentElement.style.position = 'relative';
        reader.parentElement.appendChild(flash);
        
        setTimeout(() => {
            flash.style.opacity = '0.7';
            setTimeout(() => {
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 300);
            }, 200);
        }, 10);
    }
    
    // Call original function
    if (originalStopScanner) {
        originalStopScanner();
    }
};

// Responsive adjustments for camera reader size
function adjustReaderSize() {
    const reader = document.getElementById('reader');
    if (reader && !reader.classList.contains('hidden')) {
        const containerWidth = reader.parentElement.offsetWidth;
        // The html5-qrcode library handles sizing, but we can adjust container
        if (containerWidth < 400) {
            reader.style.maxHeight = '250px';
        } else {
            reader.style.maxHeight = '400px';
        }
    }
}

window.addEventListener('resize', adjustReaderSize);
document.getElementById('openScannerBtn').addEventListener('click', function() {
    setTimeout(adjustReaderSize, 100);
});
</script>
@endsection