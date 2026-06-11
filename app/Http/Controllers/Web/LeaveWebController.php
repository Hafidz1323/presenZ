<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeaveWebController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Leave::with(['approver']);

        if ($user->role === 'karyawan') {
            $query->where('user_id', $user->id);
        } else {
            $query->with('user');
        }

        $leaves = $query->latest()->paginate(15);

        return view($user->role === 'karyawan' ? 'leaves.index' : 'admin.leaves', [
            'leaves' => $leaves
        ]);
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

        Leave::create([
            'user_id' => $request->user()->id,
            'leave_type' => $validated['leave_type'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'reason' => $validated['reason'],
            'attachment' => $attachmentPath,
            'status' => 'Pending',
        ]);

        return back()->with('success', 'Leave request submitted successfully.');
    }

    public function approve(Request $request, Leave $leave)
    {
        if (!in_array($request->user()->role, ['admin', 'hr'])) {
            abort(403, 'Akses ditolak: Anda bukan Admin/HRD');
        }

        $validated = $request->validate([
            'status' => 'required|in:Approved,Rejected'
        ]);

        $leave->update([
            'status' => $validated['status'],
            'approved_by' => $request->user()->id,
            'approved_at' => Carbon::now(),
        ]);

        return back()->with('success', "Leave request {$validated['status']}!");
    }
}
