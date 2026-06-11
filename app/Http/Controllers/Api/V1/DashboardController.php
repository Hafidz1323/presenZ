<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $today = Carbon::today();

        if ($user->role === 'karyawan') {
            $attendanceToday = Attendance::where('user_id', $user->id)
                ->whereDate('check_in_time', $today)
                ->first();

            $leavesPending = Leave::where('user_id', $user->id)
                ->where('status', 'Pending')
                ->count();

            return response()->json([
                'attendance_today' => $attendanceToday,
                'leaves_pending' => $leavesPending,
            ]);
        }

        $totalHadir = Attendance::whereDate('check_in_time', $today)->count();
        $totalLeavesPending = Leave::where('status', 'Pending')->count();

        return response()->json([
            'total_hadir_today' => $totalHadir,
            'total_leaves_pending' => $totalLeavesPending,
        ]);
    }
}
