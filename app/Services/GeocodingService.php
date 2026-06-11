<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeocodingService
{
    public function getAddress(float $lat, float $lon): string
    {
        $details = $this->getAddressDetails($lat, $lon);
        return $details['display_name'];
    }

    public function getAddressDetails(float $lat, float $lon): array
    {
        try {
            $response = Http::withoutVerifying()->withHeaders([
                'User-Agent' => 'presenZ-Falco-App/1.0 (contact@presenz.com)',
            ])->timeout(5)->get('https://nominatim.openstreetmap.org/reverse', [
                'lat' => $lat,
                'lon' => $lon,
                'format' => 'json',
                'accept-language' => 'id',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $address = $data['address'] ?? [];

                return [
                    'display_name' => $data['display_name'] ?? "{$lat}, {$lon}",
                    'road' => $address['road'] ?? ($address['street'] ?? ($address['pedestrian'] ?? null)),
                    'kelurahan' => $address['suburb'] ?? ($address['village'] ?? ($address['neighbourhood'] ?? ($address['hamlet'] ?? null))),
                    'kecamatan' => $address['city_district'] ?? ($address['municipality'] ?? ($address['subdistrict'] ?? null)),
                    'kota' => $address['city'] ?? ($address['county'] ?? ($address['regency'] ?? null)),
                    'provinsi' => $address['state'] ?? ($address['region'] ?? null),
                    'negara' => $address['country'] ?? null,
                ];
            }
        } catch (\Exception $e) {
            Log::error('Geocoding details failed: ' . $e->getMessage());
        }

        return [
            'display_name' => "{$lat}, {$lon}",
            'road' => null,
            'kelurahan' => null,
            'kecamatan' => null,
            'kota' => null,
            'provinsi' => null,
            'negara' => null,
        ];
    }
}
