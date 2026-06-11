<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use App\Models\Department;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $today = Carbon::today();

        if ($user->role === 'karyawan') {
            $shift = $user->shifts()->first();

            $attendanceToday = Attendance::where('user_id', $user->id)
                ->whereDate('check_in_time', $today)
                ->first();

            $leavesPending = Leave::where('user_id', $user->id)
                ->where('status', 'Pending')
                ->count();

            $recentAttendances = Attendance::with(['shift'])
                ->where('user_id', $user->id)
                ->latest('check_in_time')
                ->take(5)
                ->get();

            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();

            $totalPresent = Attendance::where('user_id', $user->id)
                ->whereBetween('check_in_time', [$startOfMonth, $endOfMonth])
                ->whereIn('status', ['Hadir', 'Terlambat'])
                ->count();

            $totalOnTime = Attendance::where('user_id', $user->id)
                ->whereBetween('check_in_time', [$startOfMonth, $endOfMonth])
                ->where('status', 'Hadir')
                ->count();

            $totalLate = Attendance::where('user_id', $user->id)
                ->whereBetween('check_in_time', [$startOfMonth, $endOfMonth])
                ->where('status', 'Terlambat')
                ->count();

            $totalLeaves = Leave::where('user_id', $user->id)
                ->where('status', 'Approved')
                ->where(function($query) use ($startOfMonth, $endOfMonth) {
                    $query->whereBetween('start_date', [$startOfMonth, $endOfMonth])
                          ->orWhereBetween('end_date', [$startOfMonth, $endOfMonth]);
                })
                ->count();

            return view('dashboard', [
                'role' => 'karyawan',
                'shift' => $shift,
                'attendanceToday' => $attendanceToday,
                'leavesPending' => $leavesPending,
                'recentAttendances' => $recentAttendances,
                'monthlySummary' => (object) [
                    'total_present' => $totalPresent,
                    'total_ontime' => $totalOnTime,
                    'total_late' => $totalLate,
                    'total_leaves' => $totalLeaves,
                ]
            ]);
        }

        $totalKaryawan = User::where('role', 'karyawan')->count();

        $totalHadirToday = Attendance::whereDate('check_in_time', $today)->count();

        $totalPendingLeaves = Leave::where('status', 'Pending')->count();

        $recentAttendances = Attendance::with(['user', 'shift'])
            ->whereDate('check_in_time', $today)
            ->latest('check_in_time')
            ->take(5)
            ->get();

        $chartLabels = [];
        $chartDataValues = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chartLabels[] = $date->format('d M');
            $chartDataValues[] = Attendance::whereDate('check_in_time', $date)->count();
        }

        $chartData = [
            'labels' => $chartLabels,
            'datasets' => [
                [
                    'label' => 'Total Kehadiran',
                    'backgroundColor' => '#3B82F6',
                    'data' => $chartDataValues
                ]
            ]
        ];

        return view('admin.dashboard', [
            'role' => $user->role,
            'stats' => (object) [
                'total_karyawan' => $totalKaryawan,
                'total_hadir_today' => $totalHadirToday,
                'total_pending_leaves' => $totalPendingLeaves,
                'total_alpha_today' => max(0, $totalKaryawan - $totalHadirToday),
            ],
            'recentAttendances' => $recentAttendances,
            'chartData' => (object) $chartData
        ]);
    }
}
