<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ServiceController extends Controller
{
    public function storeAnalysis(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['status' => 'error', 'message' => 'Login required'], 401);
    }

    try {
        $apiKey = env('GEMINI_API_KEY');
        $detections = $request->input('all_detections'); 
        
        if (empty($detections)) {
            return response()->json(['status' => 'error', 'message' => 'No detections provided'], 400);
        }

        $allCategories = collect($detections)->pluck('category')->unique()->implode(', ');

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $apiKey;

        $prompt = "Analyze this meal: '{$allCategories}'. " .
            "Provide a professional nutritional analysis following these rules: " .
            "1. Start directly with the analysis; do not introduce yourself, do not use a greeting, and do not mention your persona or title. " .
            "2. Provide a detailed 2-sentence breakdown of the primary nutrients found in these ingredients. " .
            "3. Write a 2-sentence health assessment explaining how this meal impacts energy levels. " . 
            "4. Give 2 specific, detailed recommendations on what to add or change for a perfectly balanced diet. " .
            "Ensure the total response is at least 150 words long. Use a professional and encouraging tone.";

        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->timeout(30)
            ->post($url, [
                'contents' => [['parts' => [['text' => $prompt]]]]
            ]);

        $aiData = $response->json();

        if (isset($aiData['error'])) {
            throw new \Exception("Gemini API Error: " . $aiData['error']['message']);
        }

        $aiRecommendation = $aiData['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (!$aiRecommendation) {
            throw new \Exception("AI returned empty. Check API settings.");
        }

        // SAVE AS ONE RECORD
        DB::table('food_result')->insert([
            'user_id' => Auth::user()->UserID,
            'food_items' => json_encode($detections),
            'health_assessment' => "Nutritional Analysis for: " . $allCategories,
            'recommendation_text' => $aiRecommendation,
            'created_at' => now(),
        ]);

        // FIX: Define the $stats variable correctly before returning
        $unhealthyCats = ['Fried Food', 'Dessert', 'Noodle'];
        $records = DB::table('food_result')
            ->where('user_id', Auth::user()->UserID)
            ->where('created_at', '>=', now()->startOfWeek())
            ->get();

        $healthy = 0; $unhealthy = 0;
        foreach($records as $r) {
            $items = json_decode($r->food_items, true) ?? [];
            $isBad = collect($items)->pluck('category')->intersect($unhealthyCats)->isNotEmpty();
            $isBad ? $unhealthy++ : $healthy++;
        }

        $stats = [
            'week' => ['healthy' => $healthy, 'unhealthy' => $unhealthy],
            'month' => ['healthy' => $healthy, 'unhealthy' => $unhealthy] 
        ];

        return response()->json([
            'status' => 'success',
            'ai_recommendation' => $aiRecommendation,
            'stats' => $stats
        ]);

    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
}
}