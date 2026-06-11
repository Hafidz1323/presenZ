<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExternalWeatherController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWeather(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $lat = $validated['latitude'];
        $long = $validated['longitude'];

        try {
            $response = Http::withoutVerifying()->timeout(5)->get('https://api.open-meteo.com/v1/forecast', [
                'latitude' => $lat,
                'longitude' => $long,
                'current_weather' => 'true',
                'timezone' => 'auto',
            ]);

            if ($response->successful()) {
                $data = $response->json();

                return response()->json([
                    'message' => 'Weather data retrieved successfully',
                    'source' => 'Open-Meteo API',
                    'coordinates' => [
                        'latitude' => $lat,
                        'longitude' => $long,
                    ],
                    'timezone' => $data['timezone'] ?? null,
                    'current_weather' => $data['current_weather'] ?? null,
                ]);
            }

            return response()->json([
                'message' => 'Failed to retrieve weather data from external API',
                'error' => $response->body()
            ], $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while calling external weather API',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
