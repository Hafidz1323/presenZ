<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        return response()->json(Shift::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);

        $shift = Shift::create($validated);

        return response()->json($shift, 201);
    }

    public function show(Shift $shift)
    {
        return response()->json($shift);
    }

    public function update(Request $request, Shift $shift)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'start_time' => 'sometimes|date_format:H:i',
            'end_time' => 'sometimes|date_format:H:i',
        ]);

        $shift->update($validated);

        return response()->json($shift);
    }

    public function destroy(Shift $shift)
    {
        $shift->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
