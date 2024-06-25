<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::with('faculty')->get();
        return response()->json($programs);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'faculty_id' => 'required|exists:faculties,id',
            'name' => 'required|string|max:255',
        ]);

        $program = Program::create($validatedData);

        return response()->json($program, 201);
    }

    public function show(Program $program)
    {
        return response()->json($program->load('faculty'));
    }

    public function update(Request $request, Program $program)
    {
        $validatedData = $request->validate([
            'faculty_id' => 'required|exists:faculties,id',
            'name' => 'required|string|max:255',
        ]);

        $program->update($validatedData);

        return response()->json($program);
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return response()->json(null, 204);
    }
}
