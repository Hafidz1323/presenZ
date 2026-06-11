<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with(['user', 'shift', 'logs']);

        if ($request->user()->role === 'karyawan') {
            $query->where('user_id', $request->user()->id);
        }

        if ($request->has('date')) {
            $query->whereDate('check_in_time', $request->date);
        }

        return response()->json($query->latest('check_in_time')->get());
    }

    public function checkIn(Request $request)
    {
        $validated = $request->validate([
            'shift_id' => 'required|exists:shifts,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'device' => 'nullable|string',
        ]);

        $user = $request->user();
        $today = Carbon::today();

        $existing = Attendance::where('user_id', $user->id)
            ->whereDate('check_in_time', $today)
            ->first();

        if ($existing) {
            return response()->json(['message' => 'Anda sudah melakukan absen masuk hari ini'], 400);
        }

        $photoPath = $request->file('photo')->store('attendances/check-in', 'public');

        $now = Carbon::now();
        $status = 'Hadir';

        $geocodingService = app(\App\Services\GeocodingService::class);
        $address = $geocodingService->getAddress($validated['latitude'], $validated['longitude']);

        $attendance = Attendance::create([
            'user_id' => $user->id,
            'shift_id' => $validated['shift_id'],
            'check_in_time' => $now,
            'check_in_photo' => $photoPath,
            'check_in_lat' => $validated['latitude'],
            'check_in_long' => $validated['longitude'],
            'check_in_address' => $address,
            'check_in_ip' => $request->ip(),
            'check_in_device' => $validated['device'] ?? $request->header('User-Agent'),
            'status' => $status,
        ]);

        AttendanceLog::create([
            'attendance_id' => $attendance->id,
            'action' => 'check_in',
            'description' => "User melakukan check-in pada pukul {$now->toDateTimeString()}",
        ]);

        return response()->json([
            'message' => 'Check-in sukses',
            'data' => $attendance
        ], 201);
    }

    public function checkOut(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'device' => 'nullable|string',
        ]);

        $user = $request->user();
        $today = Carbon::today();

        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('check_in_time', $today)
            ->whereNull('check_out_time')
            ->first();

        if (!$attendance) {
            return response()->json(['message' => 'Data absen masuk aktif tidak ditemukan untuk hari ini'], 404);
        }

        $photoPath = $request->file('photo')->store('attendances/check-out', 'public');
        $now = Carbon::now();

        $geocodingService = app(\App\Services\GeocodingService::class);
        $address = $geocodingService->getAddress($validated['latitude'], $validated['longitude']);

        $attendance->update([
            'check_out_time' => $now,
            'check_out_photo' => $photoPath,
            'check_out_lat' => $validated['latitude'],
            'check_out_long' => $validated['longitude'],
            'check_out_address' => $address,
            'check_out_ip' => $request->ip(),
            'check_out_device' => $validated['device'] ?? $request->header('User-Agent'),
        ]);

        AttendanceLog::create([
            'attendance_id' => $attendance->id,
            'action' => 'check_out',
            'description' => "User melakukan check-out pada pukul {$now->toDateTimeString()}",
        ]);

        return response()->json([
            'message' => 'Check-out sukses',
            'data' => $attendance
        ]);
    }
}
