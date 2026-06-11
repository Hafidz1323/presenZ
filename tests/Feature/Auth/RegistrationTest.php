<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $dept = \App\Models\Department::create(['name' => 'IT', 'code' => 'IT']);
        $pos = \App\Models\Position::create(['name' => 'Staff', 'code' => 'STF']);
        $shift = \App\Models\Shift::create(['name' => 'Morning', 'start_time' => '08:00', 'end_time' => '17:00']);

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'nip' => 'EMP999',
            'department_id' => $dept->id,
            'position_id' => $pos->id,
            'shift_id' => $shift->id,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
