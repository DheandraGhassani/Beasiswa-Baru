<?php
namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::all();
        return response()->json($faculties);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $faculty = Faculty::create($validatedData);

        return response()->json($faculty, 201);
    }

    public function show(Faculty $faculty)
    {
        return response()->json($faculty);
    }

    public function update(Request $request, Faculty $faculty)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $faculty->update($validatedData);

        return response()->json($faculty);
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        return response()->json(null, 204);
    }
}
