@extends('layouts.app')

@section('content')
<div>
    <div class="w-full lg:container bg-orange-50/40 mx-auto py-8 lg:py-16 px-4">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
            <div class="space-y-1">
                <div class="flex items-center space-x-2 text-orange-500 font-bold text-sm uppercase tracking-widest">
                    <i class="fas fa-history"></i>
                    <span>Activity Log</span>
                </div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">Dietary History</h1>
                <p class="text-gray-500 font-medium">Analyze your nutritional journey powered by AI.</p>
            </div>
            
            <form action="{{ route('record.record') }}" method="GET" class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search your eats..." 
                    class="block w-full md:w-72 pl-10 pr-4 py-3 bg-white border-none shadow-sm rounded-2xl focus:ring-2 focus:ring-orange-400 outline-none transition-all placeholder:text-gray-400"
                >
                <button type="submit" class="hidden"></button>
            </form>
        </div>

        <div class="space-y-6">
            @forelse($records as $record)
                @php
                    $categoryName = $record->food_items['category'] ?? 'General'; 

                    $categoryMap = [
                        'Vegetable'       => 'emerald',
                        'Fruit'           => 'lime',
                        'Vegetable-Fruit' => 'emerald',
                        'Soup'            => 'blue',
                        'Seafood'         => 'cyan',
                        'Meat'            => 'red',
                        'Noodle'          => 'amber',  
                        'Rice'            => 'orange',
                        'Fried Food'      => 'orange',
                        'Egg'             => 'indigo',
                        'Dessert'         => 'pink',
                        'Bread'           => 'stone',
                    ];

                    $categoryIcons = [
                        'Vegetable'       => 'fa-carrot',
                        'Fruit'           => 'fa-apple-whole',
                        'Vegetable-Fruit' => 'fa-leaf',
                        'Soup'            => 'fa-bowl-rice',
                        'Seafood'         => 'fa-fish',
                        'Meat'            => 'fa-drumstick-bite',
                        'Noodle'          => 'fa-bowl-food',
                        'Rice'            => 'fa-circle-dot',
                        'Fried Food'      => 'fa-hotdog',
                        'Egg'             => 'fa-egg',
                        'Dessert'         => 'fa-ice-cream',
                        'Bread'           => 'fa-bread-slice',
                    ];

                    $theme = $categoryMap[$categoryName] ?? 'orange';
                    $icon = $categoryIcons[$categoryName] ?? 'fa-utensils';
                @endphp

                <div class="group bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6 md:p-8">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                            <div class="flex items-center space-x-5">
                                {{-- Dynamically colored icon container --}}
                                <div class="w-14 h-14 bg-{{ $theme }}-100 text-{{ $theme }}-600 rounded-2xl flex items-center justify-center shadow-sm">
                                    <i class="fas {{ $icon }} text-2xl"></i>
                                </div>
                                
                                <div>
                                    <div class="flex items-center space-x-2 mb-1">
                                        <span class="px-2 py-0.5 bg-{{ $theme }}-50 text-{{ $theme }}-700 text-[10px] font-black uppercase rounded-md">
                                            {{ $categoryName }}
                                        </span>
                                        <span class="text-gray-300">•</span>
                                        <span class="text-xs font-bold text-gray-400">
                                            {{ $record->created_at->format('M d, Y • h:i A') }}
                                        </span>
                                    </div>
                                    <h3 class="text-2xl font-black text-gray-800 capitalize tracking-tight">
                                        {{ $categoryName }}
                                    </h3>
                                </div>
                            </div>

                            <!--    
                            <div class="bg-gray-50 rounded-2xl p-4 min-w-[160px] border border-gray-100">
                                <div class="flex justify-between items-end mb-2">
                                    <span class="text-[10px] font-black text-gray-400 uppercase leading-none">AI Confidence</span>
                                    {{-- Added fallback of 0 if confidence_score is missing --}}
                                    <span class="text-sm font-black text-{{ $theme }}-600">{{ number_format($record->confidence_score ?? 0, 0) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-{{ $theme }}-500 h-full rounded-full transition-all duration-1000" 
                                        style="width: {{ $record->confidence_score ?? 0 }}%"></div>
                                </div>
                            </div>
                            -->
                        </div>
                        
                        
                        <div class="grid md:grid-cols-1 gap-4">
                            <!--
                            <div class="bg-{{ $theme }}-50/30 border border-{{ $theme }}-100 rounded-2xl p-5">
                                <h4 class="text-xs font-black text-{{ $theme }}-800 uppercase mb-2">Health Assessment</h4>
                                <p class="text-gray-600 text-sm italic">"{{ $record->health_assessment }}"</p>
                            </div>
                            -->
                            <div class="bg-white border border-gray-100 rounded-2xl p-3">
                                <h4 class="text-xs font-black text-gray-400 uppercase mb-2">Recommendation</h4>
                                <p class="text-gray-600 text-sm">{{ $record->recommendation_text }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-300">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-utensils text-5xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">No records found</h3>
                    <p class="text-gray-500">Try adjusting your search or add a new meal.</p>
                    @if(request('search'))
                        <a href="{{ route('record.record') }}" class="mt-4 inline-block text-orange-500 font-bold hover:underline">
                            Clear Search
                        </a>
                    @endif
                </div>
            @endforelse
                    </div>

                    <div class="mt-12 mb-20 flex justify-end">
                <div class="bg-white p-2 rounded-2xl shadow-sm border border-gray-100 pagination-orange">
                    {{ $records->links() }}
                </div>
            </div>

<div class="hidden bg-orange-100 bg-orange-500 text-orange-600 text-orange-700 border-orange-100"></div>
    </div>
</div>
<style>
    /* Custom hover effect for cards */
    .group:hover .w-14 {
        transform: scale(1.05) rotate(-3deg);
        transition: all 0.3s ease;
    }

    /* Orange Pagination Styling */
    .pagination-orange .pagination {
        margin-bottom: 0;
        gap: 4px;
    }

    .pagination-orange .page-item .page-link {
        border: none !important;
        border-radius: 12px !important;
        color: #f97316 !important; /* Tailwind Orange-500 */
        font-weight: 700;
        padding: 8px 16px;
        transition: all 0.2s ease;
    }

    .pagination-orange .page-item .page-link:hover {
        background-color: #fff7ed !important; /* Tailwind Orange-50 */
        color: #ea580c !important; /* Tailwind Orange-600 */
    }

    .pagination-orange .page-item.active .page-link {
        background-color: #f97316 !important; /* Tailwind Orange-500 */
        color: white !important;
        box-shadow: 0 4px 12px rgba(249, 115, 22, 0.2);
    }

    .pagination-orange .page-item.disabled .page-link {
        color: #d1d5db !important; /* Gray-300 */
        background-color: transparent !important;
    }
</style>
@endsection