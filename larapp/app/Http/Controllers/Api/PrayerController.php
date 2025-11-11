<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class PrayerController extends Controller
{
    /**
     * Get prayer times for a city
     *
     * @OA\Get(
     *     path="/api/prayer-times",
     *     tags={"Prayer Times"},
     *     @OA\Parameter(
     *         name="city",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         example="Jakarta"
     *     ),
     *     @OA\Parameter(
     *         name="country",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         example="Indonesia"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Prayer times data",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object")
     *         )
     *     )
     * )
     */
    public function getTimes(Request $request)
    {
        $city = $request->query('city');
        $country = $request->query('country');

        if (!$city || !$country) {
            return response()->json(['error' => 'City and country parameters are required'], 400);
        }

        // Use Aladhan API (free, no API key needed)
        $url = "https://api.aladhan.com/v1/timingsByCity?city={$city}&country={$country}&method=2";

        $response = Http::get($url);

        if ($response->ok()) {
            $data = $response->json();
            return response()->json($data);
        }

        return response()->json(['error' => 'Failed to fetch prayer times'], 500);
    }
}