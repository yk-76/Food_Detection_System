@extends('layouts.app')

@section('content')

<!-- MAIN CONTENT -->
<div class="w-full lg:container mx-auto py-10 px-4">
    <div class="max-w-5xl mx-auto">
        
        <!-- CAMERA/IMAGE PANEL -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8 border-2 border-orange-400" data-aos="fade-up">
            <div class="p-6 lg:p-8! text-center">
                <p class="text-xl md:text-2xl lg:text-3xl font-bold text-orange-400 mb-2 md:mb-3">Analyze Your Food</p>
                <p class="text-sm md:text-base! text-gray-500 mb-6 mx-auto">
                    Take a photo of your meal and get instant insights about nutritional value and healthier alternatives
                </p>

        
                <!-- Camera/Image Display Area -->
                <div class="relative bg-gray-900 rounded-xl overflow-hidden mb-6" style="aspect-ratio: 16/9;">
                    <!-- Video Stream -->
                    <video id="videoStream" class="absolute inset-0 w-full h-full object-cover hidden" autoplay playsinline></video>
                    
                    <!-- Captured Image -->
                    <canvas id="capturedImage" class="absolute inset-0 w-full h-full object-cover hidden"></canvas>
                    
                    <!-- Camera Rotation Button (Mobile Only) -->
                    <button id="rotateCameraBtn" class="absolute top-2 right-2 z-30 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full! backdrop-blur-sm transition-all duration-300 hover:scale-110 hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </button>
                    
                    <!-- Placeholder -->
                    <div id="cameraPlaceholder" class="absolute inset-0 flex flex-col items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-15 h-15 md:w-20! md:h-20! text-gray-600 mb-2 lg:mb-4!" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="text-gray-500 text-sm md:text-base!">Click "Start Camera" to begin</p>
                    </div>

                    <!-- Loading Overlay -->
                    <div id="loadingOverlay" class="absolute inset-0 bg-black/70 backdrop-blur-sm hidden flex items-center justify-center z-40">
                        <div class="text-center">
                            <div class="animate-spin rounded-full h-16 w-16 border-4 border-orange-400 border-t-transparent mx-auto mb-4"></div>
                            <p class="text-white text-lg">Analyzing your food...</p>
                        </div>
                    </div>
                </div>

                <!-- Control Buttons -->
                <div class="flex flex-col sm:flex-row gap-2 md:gap-4! justify-center">
                    <!-- Start/Capture/Recapture Button -->
                    <button id="cameraBtn" class="flex-1 sm:flex-none sm:min-w-[200px] bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 md:py-4! md:px-8! rounded-xl! transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span id="cameraBtnText">Start Camera</span>
                    </button>

                    <button id="uploadBtn" type="button" class="flex-1 sm:flex-none sm:min-w-[200px] bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 md:py-4! md:px-8! rounded-xl! transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        <span>Upload Photo</span>
                    </button>
                    <input type="file" id="fileInput" accept="image/*" class="hidden">

                    
                    <button id="analyzeBtn" class="flex-1 sm:flex-none sm:min-w-[200px] bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-6 md:py-4! md:px-8! rounded-xl! transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:transform-none flex items-center justify-center gap-2" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span>Analyze</span>
                    </button>
                  
                </div>
            </div>
        </div>
    </div>
</div>

<!-- RECOMMENDATIONS SECTION -->
<div id="recommendationsSection" class="bg-gradient-to-br from-green-50 to-blue-50 rounded-2xl shadow-xl overflow-hidden hidden" data-aos="fade-up">
    <div class="p-6 lg:p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h2 class="text-2xl lg:text-3xl font-bold text-gray-800">
                Analysis Results
            </h2>
        </div>

        <!-- Analysis Content -->
       <div id="analysisContent" class="space-y-6">
    
    <div class="flex border-b border-gray-200 mb-6">
        <button id="tabResults" class="px-6 py-2 font-bold text-orange-500 border-b-2 border-orange-500 transition-all">
            Current Result
        </button>
        <button id="tabStats" class="px-6 py-2 font-bold text-gray-500 hover:text-orange-400 transition-all">
            Health Statistics
        </button>
    </div>

    <div id="layoutResults" class="space-y-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
                Food Category
            </h3>
            <p id="foodCategory" class="text-gray-700 text-base leading-relaxed"></p>
        </div>

        <!--
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                Health Assessment
            </h3>
            <p id="healthAssessment" class="text-gray-700 text-base leading-relaxed"></p>
        </div>
        -->

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                </svg>
                Recommendations
            </h3>
            <p id="recommendations" class="text-gray-700 text-base leading-relaxed"></p>
        </div>
    </div>

   <div id="layoutStats" class="hidden grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h4 class="text-center font-bold text-gray-700 mb-4">Weekly Meal Count (Bar)</h4>
        <div class="relative h-64">
            <canvas id="weeklyChart"></canvas>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h4 class="text-center font-bold text-gray-700 mb-4">Monthly Distribution (Pie)</h4>
        <div class="relative h-64">
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>
</div>
</div>
    </div>
</div>

<!-- PLACEHOLDER MESSAGE -->
<div id="placeholderMessage" class="bg-orange-100/40 overflow-hidden" data-aos="fade-up">
    <div class="p-8 lg:p-15 text-center">
        <div class="w-20 h-20 bg-orange-200/40 border-2 border-amber-500/50 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-xl md:text-2xl lg:text-3xl font-bold text-gray-800 mb-3">
            Ready to Analyze Your Food?
        </p>
        <p class="text-gray-600 text-sm md:text-base! mx-auto text-justify md:text-center">
            Please take a picture of your food and click on <span class="font-semibold text-orange-500">Analyze</span> to get detailed information about nutritional value and personalized recommendations.
        </p>
    </div>
</div>

<!-- DISCLAIMER MODAL -->
<div id="disclaimerModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full relative overflow-hidden max-h-[90vh] flex flex-col">
        <button id="closeDisclaimerBtn" class="absolute top-4 right-4 text-3xl text-gray-400 hover:text-gray-800 transition-colors z-30">&times;</button>

        <div class="p-3 md:p-8! overflow-y-auto">
            <div class="text-center mb-6">
                <div class="w-20 h-20 bg-red-100/50 rounded-full border-2 border-red-400 flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-red-500/80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <p class="text-xl md:text-2xl lg:text-3xl font-semibold text-orange-400 mb-2">
                    Important Disclaimer
                </p>
                <p class="text-sm md:text-base! text-gray-500">Please read carefully before using our service</p>
            </div>

            <div class="space-y-4 text-gray-700 text-sm lg:text-base leading-relaxed mb-6">
                <div class="bg-amber-200/20 border-l-4 border-amber-500/40 p-4 rounded-r-lg rounded-xl">
                    <p class="font-semibold text-amber-900 mb-2">1. For Reference Only</p>
                    <p class="text-amber-800">
                        The food analysis, nutritional information, and recommendations provided by this service are generated using artificial intelligence and are intended for informational and educational purposes only. They should not be considered as professional medical, nutritional, or dietary advice.
                    </p>
                </div>

                <div class="bg-amber-200/40 border-l-4 border-amber-500/60 p-4 rounded-r-lg rounded-xl">
                    <p class="font-semibold text-amber-900 mb-2">2. Consult Healthcare Professionals</p>
                    <p class="text-amber-800">
                        If you have specific dietary requirements, food allergies, medical conditions, or health concerns, please consult with qualified healthcare professionals, registered dietitians, or nutritionists before making any dietary changes based on our recommendations.
                    </p>
                </div>

                <div class="bg-amber-200/20 border-l-4 border-amber-500/40 p-4 rounded-r-lg rounded-xl">
                    <p class="font-semibold text-amber-900 mb-2">3. Accuracy Limitations</p>
                    <p class="text-amber-800">
                        While we strive to provide accurate food classification and analysis, the AI system may not always correctly identify all ingredients, portion sizes, or nutritional content. Results may vary depending on image quality, lighting conditions, and food presentation.
                    </p>
                </div>

                <div class="bg-amber-200/40 border-l-4 border-amber-500/60 p-4 rounded-r-lg rounded-xl">
                    <p class="font-semibold text-amber-900 mb-2">4. No Liability</p>
                    <p class="text-amber-800">
                        We do not assume any liability for decisions made based on the information provided by this service. Users are responsible for their own dietary choices and health outcomes.
                    </p>
                </div>

                <div class="bg-amber-200/20 border-l-4 border-amber-500/40 p-4 rounded-r-lg rounded-xl">
                    <p class="font-semibold text-amber-900 mb-2">5. Privacy Notice</p>
                    <p class="text-amber-800">
                        Images uploaded for analysis are processed securely and are not stored permanently on our servers. However, please avoid uploading images containing personal or sensitive information.
                    </p>
                </div>
            </div>

            <div class="bg-gray-100 border-2 border-gray-300 rounded-xl p-4 mb-6">
                <p class="text-gray-600 text-sm md:text-base! font-normal text-center mb-0">
                    By clicking "I Understand" below, you acknowledge and accept these terms and understand that the recommendations are for reference purposes only.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <button id="acceptDisclaimerBtn" class="flex-1 bg-gradient-to-r from-orange-400 via-orange-500 to-orange-400 hover:from-orange-500 hover:via-orange-600 hover:to-orange-500 text-white font-bold py-4 px-8 rounded-xl! transition-all shadow-lg shadow-orange-500/30 active:scale-[0.98]">
                    I Understand & Accept
                </button>
                <button id="declineDisclaimerBtn" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-4 px-8 rounded-xl! border-2 border-gray-300 transition-all active:scale-[0.98]">
                    Decline
                </button>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. SELECT ALL ELEMENTS
    const videoStream = document.getElementById('videoStream');
    const capturedImage = document.getElementById('capturedImage');
    const cameraPlaceholder = document.getElementById('cameraPlaceholder');
    const cameraBtn = document.getElementById('cameraBtn');
    const cameraBtnText = document.getElementById('cameraBtnText');
    const analyzeBtn = document.getElementById('analyzeBtn');
    const loadingOverlay = document.getElementById('loadingOverlay');
    const recommendationsSection = document.getElementById('recommendationsSection');
    const placeholderMessage = document.getElementById('placeholderMessage');
    
    // Modal Elements
    const disclaimerModal = document.getElementById('disclaimerModal');
    const acceptDisclaimerBtn = document.getElementById('acceptDisclaimerBtn');
    const declineDisclaimerBtn = document.getElementById('declineDisclaimerBtn');
    const closeDisclaimerBtn = document.getElementById('closeDisclaimerBtn');

    // 2. APP STATE
    const labels = [
    "Fruits", // Add this!
    "Vegetable-Fruit", "Soup", "Seafood", "Meat", "Noodle", 
    "Rice", "Fried Food", "Egg", "Dessert", "Bread"
];

    let model = null;
    let stream = null;
    let currentState = 'initial';
    let facingMode = 'environment';

    // 3. DISCLAIMER LOGIC
    const disclaimerAccepted = localStorage.getItem('foodClassifierDisclaimerAccepted');
    
    // Check if the user has NOT accepted yet
    if (!disclaimerAccepted) {
        disclaimerModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    } else {
        // Explicitly ensure it is hidden if they HAVE accepted
        disclaimerModal.classList.add('hidden');
    }

    acceptDisclaimerBtn.addEventListener('click', function() {
        // Save the choice in the browser
        localStorage.setItem('foodClassifierDisclaimerAccepted', 'true');
        
        // Hide the modal immediately
        disclaimerModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });

    // Handle declining (redirect away)
    declineDisclaimerBtn.addEventListener('click', () => window.location.href = '/');
    closeDisclaimerBtn.addEventListener('click', () => window.location.href = '/');

    // 4. MODEL LOADING
    async function loadModel() {
        try {
            model = await tf.loadLayersModel('/food_detection_model/model.json');
            console.log("Model loaded successfully");
        } catch (e) {
            console.error("Failed to load model", e);
        }
    }
    loadModel();

    // Inside your DOMContentLoaded listener
const uploadBtn = document.getElementById('uploadBtn');
const fileInput = document.getElementById('fileInput');

uploadBtn.addEventListener('click', () => fileInput.click());

fileInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(event) {
        const img = new Image();
        img.onload = function() {
            const context = capturedImage.getContext('2d');
            
            // Match canvas to image size
            capturedImage.width = img.width;
            capturedImage.height = img.height;
            context.drawImage(img, 0, 0);

            // Update UI
            videoStream.classList.add('hidden');
            cameraPlaceholder.classList.add('hidden');
            capturedImage.classList.remove('hidden');
            
            // Enable analyze button for manual click, or auto-run
            analyzeBtn.disabled = false;
            runAnalysis(); 
        };
        img.src = event.target.result;
    };
    reader.readAsDataURL(file);
});

    // 5. CAMERA & AUTO-PROCESS LOGIC
    async function startCamera() {
        try {
            // Reset UI for new scan
            recommendationsSection.classList.add('hidden');
            placeholderMessage.classList.remove('hidden');
            capturedImage.classList.add('hidden');

            stream = await navigator.mediaDevices.getUserMedia({ 
                video: { facingMode: facingMode } 
            });
            videoStream.srcObject = stream;
            videoStream.classList.remove('hidden');
            cameraPlaceholder.classList.add('hidden');
            
            cameraBtn.disabled = true; 
            
            // --- 5 SECOND COUNTDOWN ---
            let count = 5;
            cameraBtnText.textContent = `Capturing in ${count}...`;
            
            const countdownInterval = setInterval(async () => {
                count--;
                cameraBtnText.textContent = `Capturing in ${count}...`;
                
                if (count <= 0) {
                    clearInterval(countdownInterval);
                    captureImage(); // Take the photo
                    await runAnalysis(); // Automatically start detection
                    cameraBtn.disabled = false;
                }
            }, 1000);

            currentState = 'streaming';
        } catch (error) {
            console.error('Camera Error:', error);
            alert('Camera access denied or hardware error.');
        }
    }

    function captureImage() {
    const context = capturedImage.getContext('2d');
    
    // Explicitly set dimensions to the video source dimensions
    capturedImage.width = videoStream.videoWidth;
    capturedImage.height = videoStream.videoHeight;
    
    // Draw the current frame
    context.drawImage(videoStream, 0, 0, capturedImage.width, capturedImage.height);
    
    // Show the canvas and hide the video immediately so the user sees the "still"
    videoStream.classList.add('hidden');
    capturedImage.classList.remove('hidden');
    
    // Stop the camera stream
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
    }
    
    cameraBtnText.textContent = 'Start New Scan';
    currentState = 'captured';
}

    let weeklyChartInstance = null;
    let monthlyChartInstance = null;

    // --- NEW: TAB SWITCHING LOGIC ---
    function switchToTab(activeTab) {
        const tabResults = document.getElementById('tabResults');
        const tabStats = document.getElementById('tabStats');
        const layoutResults = document.getElementById('layoutResults');
        const layoutStats = document.getElementById('layoutStats');

        if (activeTab === 'results') {
            layoutResults.classList.remove('hidden');
            layoutStats.classList.add('hidden');
            tabResults.className = "px-6 py-2 font-bold text-orange-500 border-b-2 border-orange-500 transition-all";
            tabStats.className = "px-6 py-2 font-bold text-gray-500 hover:text-orange-400 transition-all";
        } else {
            layoutResults.classList.add('hidden');
            layoutStats.classList.remove('hidden');
            tabStats.className = "px-6 py-2 font-bold text-orange-500 border-b-2 border-orange-500 transition-all";
            tabResults.className = "px-6 py-2 font-bold text-gray-500 hover:text-orange-400 transition-all";
        }
    }

    // Add Tab Click Listeners
    document.getElementById('tabResults').addEventListener('click', () => switchToTab('results'));
    document.getElementById('tabStats').addEventListener('click', () => switchToTab('stats'));

    // --- UPDATED: DIFFERENT CHART PATTERNS ---
    function updateCharts(stats) {
        // 1. Weekly Progress - Bar Chart
        if (weeklyChartInstance) weeklyChartInstance.destroy();
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        weeklyChartInstance = new Chart(weeklyCtx, {
            type: 'bar', // Using Bar for weekly
            data: {
                labels: ['Healthy', 'Unhealthy'],
                datasets: [{
                    label: 'Meals',
                    data: [stats.week.healthy, stats.week.unhealthy],
                    backgroundColor: ['#4ade80', '#f87171'],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false } // Hide legend for cleaner bar look
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 } // Since meals are whole numbers
                    }
                }
            }
        });

        // 2. Monthly Overview - Pie Chart
        if (monthlyChartInstance) monthlyChartInstance.destroy();

        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const hasMonthlyData = (stats.month.healthy + stats.month.unhealthy) > 0;

        monthlyChartInstance = new Chart(monthlyCtx, {
            type: 'pie',
            data: {
                labels: hasMonthlyData ? ['Healthy', 'Unhealthy'] : ['No Data'],
                datasets: [{
                    // If no data, show a neutral gray circle
                    data: hasMonthlyData ? [stats.month.healthy, stats.month.unhealthy] : [1],
                    backgroundColor: hasMonthlyData ? ['#4ade80', '#f87171'] : ['#e5e7eb'],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: { enabled: hasMonthlyData } // Disable tooltips if no data
                }
            }
        });
    }

    // --- EXISTING LOGIC: Model, Camera, Analysis ---
    async function loadModel() {
        model = await tf.loadLayersModel('/food_detection_model/model.json');
    }
    loadModel();

    async function startCamera() {
        try {
            recommendationsSection.classList.add('hidden');
            placeholderMessage.classList.remove('hidden');
            capturedImage.classList.add('hidden');

            stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: facingMode } });
            videoStream.srcObject = stream;
            videoStream.classList.remove('hidden');
            cameraPlaceholder.classList.add('hidden');
            cameraBtn.disabled = true; 
            
            let count = 5;
            cameraBtnText.textContent = `Capturing in ${count}...`;
            const countdownInterval = setInterval(async () => {
                count--;
                cameraBtnText.textContent = `Capturing in ${count}...`;
                if (count <= 0) {
                    clearInterval(countdownInterval);
                    captureImage();
                    await runAnalysis();
                    cameraBtn.disabled = false;
                }
            }, 1000);
        } catch (e) { alert('Camera Error'); }
    }

    function captureImage() {
    const context = capturedImage.getContext('2d');
    
    // Set the internal resolution to match the video feed exactly
    capturedImage.width = videoStream.videoWidth;
    capturedImage.height = videoStream.videoHeight;
    
    // Use high-quality scaling
    context.imageSmoothingEnabled = true;
    context.imageSmoothingQuality = 'high';
    
    context.drawImage(videoStream, 0, 0, capturedImage.width, capturedImage.height);
    
    videoStream.classList.add('hidden');
    capturedImage.classList.remove('hidden');
    
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
    }
    
    cameraBtnText.textContent = 'Start New Scan';
    currentState = 'captured';
    analyzeBtn.disabled = false; 
}

    async function runAnalysis() {
    loadingOverlay.classList.remove('hidden');
    loadingOverlay.classList.add('flex');
    
    const imageData = capturedImage.toDataURL("image/jpeg", 0.9).split(',')[1];

    try {
        // Step A: Get detection from Roboflow
        const response = await fetch('https://serverless.roboflow.com/eatwise/workflows/detect-count-and-visualize', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                api_key: 'PrvGHPhydqS6isMWUpmF',
                inputs: { "image": { "type": "base64", "value": imageData } }
            })
        });

        const result = await response.json();
        const predictions = result.outputs?.[0]?.predictions?.predictions || [];

        if (predictions && predictions.length > 0) {
            renderResults(predictions);

            const mainFood = predictions[0]; // Take the top prediction
            
            const saveResponse = await fetch('/store-analysis', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    all_detections: predictions.map(p => ({
                        category: p.class,
                        confidence: p.confidence
                    }))
                })
            });

            const dbResult = await saveResponse.json();

            if (dbResult.status === 'success') {
                const detectedNames = [...new Set(predictions.map(p => p.class))].join(", ");
                
                //document.getElementById('healthAssessment').innerText = "Detailed Analysis for " + detectedNames;
                
                // Formatting: convert AI newlines to HTML breaks and clean up bolding
                const formattedRecommendation = dbResult.ai_recommendation
                    .replace(/\n/g, '<br>')
                    .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
                    
                document.getElementById('recommendations').innerHTML = `<div class="leading-relaxed text-gray-700">${formattedRecommendation}</div>`;
                
                if (dbResult.stats) {
                    updateCharts(dbResult.stats); 
                }
            

                } else {
                    // Show the actual error message from the controller
                    alert("Error: " + dbResult.message);
                }
                        }
                    } catch (err) {
                        console.error("Workflow Error:", err);
                        handleNoDetections("Error connecting to server.");
                    } finally {
                        loadingOverlay.classList.add('hidden');
                        placeholderMessage.classList.add('hidden');
                        recommendationsSection.classList.remove('hidden');
                        recommendationsSection.scrollIntoView({ behavior: 'smooth' });
                    }
                }

    function renderResults(predictions) {
    const context = capturedImage.getContext('2d');
    
    const img = new Image();
    img.src = capturedImage.toDataURL();
    context.drawImage(img, 0, 0);

    const modelWidth = 390; 
    const modelHeight = 280;
    const scaleX = capturedImage.width / modelWidth;
    const scaleY = capturedImage.height / modelHeight;

    // Display all detected unique names
    const detectedNames = [...new Set(predictions.map(p => p.class))].join(", ");
    document.getElementById('foodCategory').innerText = detectedNames || "Unknown Item";

    // Loop through ALL predictions and draw boxes
    predictions.forEach(p => {
        const width = p.width * scaleX;
        const height = p.height * scaleY;
        const x = (p.x * scaleX) - (width / 2);
        const y = (p.y * scaleY) - (height / 2);
        
        context.strokeStyle = "#00000000"; 
        context.lineWidth = 4;
        context.strokeRect(x, y, width, height);

        // Add a text label above each box
        context.fillStyle = "#00000000";
        context.font = "bold 16px sans-serif";
        context.fillText(p.class, x, y > 20 ? y - 5 : y + 20);
    });
}

    function handleNoDetections(customMessage = null) {
        document.getElementById('foodCategory').textContent = "No food items detected.";
        //document.getElementById('healthAssessment').textContent = customMessage || "Ensure the food is centered and well-lit.";
        document.getElementById('recommendations').textContent = "Try taking a clearer photo from a top-down angle.";
    }

    cameraBtn.addEventListener('click', startCamera);
    analyzeBtn.addEventListener('click', runAnalysis);
});
</script>
@endsection