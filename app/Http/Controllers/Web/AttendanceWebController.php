<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttendanceWebController extends Controller
{
    public function history(Request $request)
    {
        $user = $request->user();

        $query = Attendance::with(['shift']);

        if ($user->role === 'karyawan') {
            $query->where('user_id', $user->id);
        } else {
            $query->with('user');
        }

        $attendances = $query->latest('check_in_time')->paginate(15);

        return view($user->role === 'karyawan' ? 'attendance.history' : 'admin.attendance', [
            'attendances' => $attendances
        ]);
    }

    public function checkIn(Request $request)
    {
        $validated = $request->validate([
            'shift_id' => 'required|exists:shifts,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'required|string',
        ]);

        $user = $request->user();
        $today = Carbon::today();

        $existing = Attendance::where('user_id', $user->id)
            ->whereDate('check_in_time', $today)
            ->first();

        if ($existing) {
            return back()->with('error', 'You have already checked in today.');
        }

        $image = $validated['photo'];
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'attendances/check-in/' . Str::random(10) . '.jpg';
        Storage::disk('public')->put($imageName, base64_decode($image));

        $now = Carbon::now();
        $status = 'Hadir';

        $geocodingService = app(\App\Services\GeocodingService::class);
        $address = $geocodingService->getAddress($validated['latitude'], $validated['longitude']);

        $attendance = Attendance::create([
            'user_id' => $user->id,
            'shift_id' => $validated['shift_id'],
            'check_in_time' => $now,
            'check_in_photo' => $imageName,
            'check_in_lat' => $validated['latitude'],
            'check_in_long' => $validated['longitude'],
            'check_in_address' => $address,
            'check_in_ip' => $request->ip(),
            'check_in_device' => $request->header('User-Agent'),
            'status' => $status,
        ]);

        AttendanceLog::create([
            'attendance_id' => $attendance->id,
            'action' => 'check_in',
            'description' => "User checked in at {$now->toDateTimeString()}",
        ]);

        return back()->with('success', 'Check-in successful!');
    }

    public function checkOut(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'required|string',
        ]);

        $user = $request->user();
        $today = Carbon::today();

        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('check_in_time', $today)
            ->whereNull('check_out_time')
            ->first();

        if (!$attendance) {
            return back()->with('error', 'No active check-in found to check out.');
        }

        $image = $validated['photo'];
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'attendances/check-out/' . Str::random(10) . '.jpg';
        Storage::disk('public')->put($imageName, base64_decode($image));

        $now = Carbon::now();

        $geocodingService = app(\App\Services\GeocodingService::class);
        $address = $geocodingService->getAddress($validated['latitude'], $validated['longitude']);

        $attendance->update([
            'check_out_time' => $now,
            'check_out_photo' => $imageName,
            'check_out_lat' => $validated['latitude'],
            'check_out_long' => $validated['longitude'],
            'check_out_address' => $address,
            'check_out_ip' => $request->ip(),
            'check_out_device' => $request->header('User-Agent'),
        ]);

        AttendanceLog::create([
            'attendance_id' => $attendance->id,
            'action' => 'check_out',
            'description' => "User checked out at {$now->toDateTimeString()}",
        ]);

        return back()->with('success', 'Check-out successful!');
    }

    public function reverseGeocode(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $geocodingService = app(\App\Services\GeocodingService::class);
        $details = $geocodingService->getAddressDetails($validated['latitude'], $validated['longitude']);

        return response()->json($details);
    }
}
