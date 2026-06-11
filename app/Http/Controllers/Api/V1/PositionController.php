<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        return response()->json(Position::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|unique:positions',
            'description' => 'nullable|string',
        ]);

        $position = Position::create($validated);

        return response()->json($position, 201);
    }

    public function show(Position $position)
    {
        return response()->json($position);
    }

    public function update(Request $request, Position $position)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'code' => 'nullable|string|unique:positions,code,' . $position->id,
            'description' => 'nullable|string',
        ]);

        $position->update($validated);

        return response()->json($position);
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
