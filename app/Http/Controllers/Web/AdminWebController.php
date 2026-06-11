<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminWebController extends Controller
{
    public function masterData()
    {
        return view('admin.master-data', [
            'departments' => Department::all(),
            'positions' => Position::all(),
            'shifts' => Shift::all(),
        ]);
    }

    public function employees()
    {
        return view('admin.employees', [
            'users' => User::with(['department', 'position', 'shifts'])
                ->where('role', 'karyawan')
                ->paginate(15),
            'departments' => Department::all(),
            'positions' => Position::all(),
            'shifts' => Shift::all(),
        ]);
    }

    public function storeEmployee(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nip' => 'nullable|string|unique:users',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'shift_id' => 'required|exists:shifts,id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'nip' => $validated['nip'],
            'role' => 'karyawan',
            'department_id' => $validated['department_id'],
            'position_id' => $validated['position_id'],
        ]);

        $user->shifts()->attach($validated['shift_id']);

        return back()->with('success', 'Employee created successfully.');
    }
}
