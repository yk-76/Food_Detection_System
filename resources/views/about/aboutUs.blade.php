@extends('layouts.app')

@section('content')

<!-- HERO + OBJECTIVES WRAPPER -->
 <div class="relative overflow-hidden">

    <!-- BACKGROUND IMAGE -->
    <div class="absolute inset-0">
        <img src="{{ asset('image/Card_01.jpg') }}"
             class="w-full h-full object-cover scale-105 blur-lg"
             alt="Background">
        <!-- Dark overlay for contrast -->
        <div class="absolute inset-0 bg-black/30"></div>
    </div>

    <div class="py-4 lg:py-12! px-4">
        <div class="lg:container mx-auto flex flex-col z-10!">

            <!-- HERO / INTRO (Row 1) -->
            <div class="bg-white rounded-2xl shadow-lg! shadow-white/40 overflow-hidden border-1 border-white mb-12 lg:mb-16! z-10!"
                data-aos="fade-up">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-8 flex flex-col justify-center">
                        <p class="text-xl md:text-2xl lg:text-4xl font-bold text-orange-400 mb-2 md:mb-4!">
                            About EatWise
                        </p>
                        <p class="text-gray-600 text-sm lg:text-base leading-relaxed">
                            EatWise is a smart health-focused platform designed to help users make better food
                            and lifestyle decisions using simple, AI-powered tools.
                        </p>
                    </div>
                    <div class="h-auto">
                        <img src="{{ asset('image/About_01.jpg') }}" alt="Healthy lifestyle"
                            class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <!-- OBJECTIVES -->
            <h2 class="text-2xl font-bold text-white text-center mb-8! md:mb-10! z-10!">
                Our Objectives
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 z-10!">
                <div class="group bg-white rounded-3xl p-4 md:p-10! shadow-sm border border-gray-100 text-center hover:bg-orange-400! hover:shadow-xl! hover:shadow-white/50! transition-all duration-500 ease-in-out">
                    <p class="font-bold text-gray-800 mb-2 group-hover:text-white!">AI Assistance</p>
                    <p class="text-sm lg:text-base text-gray-600 group-hover:text-white!">
                        Use AI to analyze food and health data quickly and conveniently.
                    </p>
                </div>

                <div class="group bg-white rounded-3xl p-4 md:p-10! shadow-sm border border-gray-100 text-center hover:bg-orange-400! hover:shadow-xl! hover:shadow-white/50! transition-all duration-500 ease-in-out">
                    <p class="font-bold text-gray-800 mb-2 group-hover:text-white!">Health Awareness</p>
                    <p class="text-sm lg:text-base text-gray-600 group-hover:text-white!">
                        Increase awareness of nutrition, BMI, and healthy living.
                    </p>
                </div>

                <div class="group bg-white rounded-3xl p-4 md:p-10! shadow-sm border border-gray-100 text-center hover:bg-orange-400! hover:shadow-xl! hover:shadow-white/50! transition-all duration-500 ease-in-out">
                    <p class="font-bold text-gray-800 mb-2 group-hover:text-white!">Simple & Practical</p>
                    <p class="text-sm lg:text-base text-gray-600 group-hover:text-white!">
                        Deliver clear insights without complex medical terms.
                    </p>
                </div>
            </div>

            <!-- CONTENT CONTAINER -->
            <div class="relative mt-12 lg:mt-16!">
                <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl p-10"
                    data-aos="fade-up">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12! items-center">

                        <!-- IMAGE -->
                        <img src="{{ asset('image/About_02.jpg') }}"
                            class="rounded-2xl shadow-lg object-cover w-full h-80"
                            alt="Beneficiaries">

                        <!-- TEXT -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center md:text-left!">
                                Who Benefits from EatWise
                            </h2>

                            <p class="text-gray-600 mb-4 text-sm lg:text-base leading-relaxed">
                                EatWise is designed for people who want to make healthier decisions without dealing
                                with complicated medical terms or time-consuming research.
                            </p>

                            <ul class="space-y-3 text-gray-600 text-sm lg:text-base p-0! lg:pl-4!">
                                <li>• Individuals aiming to improve daily eating habits</li>
                                <li>• Users actively monitoring body weight and BMI</li>
                                <li>• People who want quick food health insights before meals</li>
                                <li>• Students and working adults with busy lifestyles</li>
                                <li>• Anyone seeking simple, AI-powered health guidance</li>
                            </ul>
                        </div>
                    </div>
                </div>
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
@endsection
