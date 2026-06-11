<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index(Request $request)
    {
        $query = Leave::with(['user', 'approver']);

        if ($request->user()->role === 'karyawan') {
            $query->where('user_id', $request->user()->id);
        }

        return response()->json($query->latest()->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'leave_type' => 'required|in:Cuti,Izin,Sakit',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('leaves', 'public');
        }

        $leave = Leave::create([
            'user_id' => $request->user()->id,
            'leave_type' => $validated['leave_type'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'reason' => $validated['reason'],
            'attachment' => $attachmentPath,
            'status' => 'Pending',
        ]);

        return response()->json([
            'message' => 'Leave request submitted successfully',
            'data' => $leave
        ], 201);
    }

    public function show(Leave $leave)
    {
        $leave->load(['user', 'approver']);
        return response()->json($leave);
    }

    public function approve(Request $request, Leave $leave)
    {
        if (!in_array($request->user()->role, ['admin', 'hr'])) {
            return response()->json(['message' => 'Unauthorized: Hanya admin atau HRD yang diizinkan'], 403);
        }

        $validated = $request->validate([
            'status' => 'required|in:Approved,Rejected'
        ]);

        $leave->update([
            'status' => $validated['status'],
            'approved_by' => $request->user()->id,
            'approved_at' => Carbon::now(),
        ]);

        return response()->json([
            'message' => "Leave request status updated to {$validated['status']}",
            'data' => $leave
        ]);
    }
}
