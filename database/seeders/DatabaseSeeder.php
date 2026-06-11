<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Departments (Minimal 3)
        $deptIT = Department::create(['name' => 'Information Technology', 'code' => 'IT']);
        $deptHR = Department::create(['name' => 'Human Resources', 'code' => 'HR']);
        $deptOps = Department::create(['name' => 'Operations', 'code' => 'OPS']);

        // 2. Create Positions
        $posManager = Position::create(['name' => 'Manager', 'code' => 'MGR']);
        $posStaff = Position::create(['name' => 'Staff', 'code' => 'STF']);

        // 3. Create Shifts (Minimal 2)
        $shiftPagi = Shift::create(['name' => 'Shift Pagi', 'start_time' => '08:00', 'end_time' => '17:00']);
        $shiftMalam = Shift::create(['name' => 'Shift Malam', 'start_time' => '20:00', 'end_time' => '05:00']);

        // 4. Create Admin & HR Users
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@presenz.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'nip' => 'ADM001',
            'department_id' => $deptIT->id,
            'position_id' => $posManager->id,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'HR Manager',
            'email' => 'hr@presenz.com',
            'password' => Hash::make('password'),
            'role' => 'hr',
            'nip' => 'HR001',
            'department_id' => $deptHR->id,
            'position_id' => $posManager->id,
            'email_verified_at' => now(),
        ]);

        // 5. Create 10 Karyawan Users
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => "Karyawan $i",
                'email' => "karyawan$i@presenz.com",
                'password' => Hash::make('password'),
                'role' => 'karyawan',
                'nip' => "EMP" . str_pad($i, 3, '0', STR_PAD_LEFT),
                'department_id' => $i % 2 == 0 ? $deptOps->id : $deptIT->id,
                'position_id' => $posStaff->id,
                'email_verified_at' => now(),
            ]);

            // Assign Shift (odd users get Pagi, even get Malam)
            $user->shifts()->attach($i % 2 == 0 ? $shiftMalam->id : $shiftPagi->id);
        }
    }
}
