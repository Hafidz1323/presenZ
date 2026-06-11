<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Position;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class NewApiFeaturesTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $dept = Department::create(['name' => 'IT', 'code' => 'IT']);
        $pos = Position::create(['name' => 'Staff', 'code' => 'STF']);
        $shift = Shift::create(['name' => 'Morning', 'start_time' => '08:00', 'end_time' => '17:00']);

        $this->user = User::create([
            'name' => 'API User',
            'email' => 'api_user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'karyawan',
            'nip' => 'EMP001',
            'department_id' => $dept->id,
            'position_id' => $pos->id,
        ]);
        $this->user->shifts()->attach($shift->id);
    }

    /**
     * Test JWT login and JWT authenticated profile access.
     */
    public function test_jwt_auth_workflow(): void
    {
        // 1. Attempt login
        $response = $this->postJson('/api/v1/auth/jwt/login', [
            'email' => 'api_user@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'access_token',
                'token_type'
            ]);

        $token = $response->json('access_token');

        // 2. Fetch profile with JWT
        $profileResponse = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->getJson('/api/v1/jwt/profile');

        $profileResponse->assertStatus(200)
            ->assertJsonPath('data.email', 'api_user@example.com');
    }

    /**
     * Test API Key authenticated profile access.
     */
    public function test_api_key_auth_workflow(): void
    {
        $apiKey = $this->user->api_key;
        $this->assertNotEmpty($apiKey);

        $response = $this->withHeaders([
            'X-API-KEY' => $apiKey
        ])->getJson('/api/v1/apikey/profile');

        $response->assertStatus(200)
            ->assertJsonPath('data.email', 'api_user@example.com');
    }

    /**
     * Test HTTP Basic authenticated profile access.
     */
    public function test_basic_auth_workflow(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Basic ' . base64_encode('api_user@example.com:password123')
        ])->getJson('/api/v1/basic/profile');

        $response->assertStatus(200)
            ->assertJsonPath('data.email', 'api_user@example.com');
    }

    /**
     * Test Weather API consumption using external API mock.
     */
    public function test_weather_api_consumption(): void
    {
        // Mock the external Open-Meteo API response
        Http::fake([
            'api.open-meteo.com/*' => Http::response([
                'timezone' => 'UTC',
                'current_weather' => [
                    'temperature' => 28.5,
                    'windspeed' => 12.3,
                    'weathercode' => 1
                ]
            ], 200)
        ]);

        $response = $this->getJson('/api/v1/weather?latitude=-6.2088&longitude=106.8456');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'source' => 'Open-Meteo API',
                'timezone' => 'UTC',
            ])
            ->assertJsonPath('current_weather.temperature', 28.5);
    }
}
