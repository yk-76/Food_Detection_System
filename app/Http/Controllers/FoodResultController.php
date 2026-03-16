<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Ensure this is imported
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\FoodResult;

class FoodResultController extends Controller
{
    // FIX: Add (Request $request) here
    public function index(Request $request) 
    {
        $categoryMap = [
            'Vegetable'       => 'green',
            'Fruit'           => 'lime',
            'Vegetable-Fruit' => 'green', 
            'Soup'            => 'blue',
            'Seafood'         => 'cyan',
            'Meat'            => 'red',
            'Noodle'          => 'yellow',
            'Rice'            => 'amber',
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
            'Fried Food'      => 'fa-fire-alt',
            'Egg'             => 'fa-egg',
            'Dessert'         => 'fa-cookie-bite',
            'Bread'           => 'fa-bread-slice',
        ];

        $searchTerm = $request->input('search');

        $records = FoodResult::where('user_id', auth()->user()->UserID)
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where(function ($q) use ($searchTerm) {
                    $q->where('health_assessment', 'like', "%{$searchTerm}%")
                    ->orWhere('recommendation_text', 'like', "%{$searchTerm}%")
                    ->orWhere('food_items', 'like', "%{$searchTerm}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('record.record', compact('records', 'categoryMap', 'categoryIcons'));
    }
}