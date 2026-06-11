<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function attendanceReport(Request $request)
    {
        if (!in_array($request->user()->role, ['admin', 'hr'])) {
            return response()->json(['message' => 'Unauthorized: Akses ditolak'], 403);
        }

        $query = Attendance::with(['user', 'shift']);

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('check_in_time', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $attendances = $query->get();

        return response()->json([
            'data' => $attendances,
            'summary' => [
                'total_records' => $attendances->count(),
            ]
        ]);
    }
}
