<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipType;
use Illuminate\Http\Request;

class ScholarshipTypeController extends Controller
{
    public function index()
    {
        $scholarshipTypes = ScholarshipType::all();
        return response()->json($scholarshipTypes);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $scholarshipType = ScholarshipType::create($validatedData);

        return response()->json($scholarshipType, 201);
    }

    public function show(ScholarshipType $scholarshipType)
    {
        return response()->json($scholarshipType);
    }

    public function update(Request $request, ScholarshipType $scholarshipType)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $scholarshipType->update($validatedData);

        return response()->json($scholarshipType);
    }

    public function destroy(ScholarshipType $scholarshipType)
    {
        $scholarshipType->delete();
        return response()->json(null, 204);
    }
}
