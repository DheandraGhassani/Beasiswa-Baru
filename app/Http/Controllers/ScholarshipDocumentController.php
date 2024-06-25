<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipDocument;
use Illuminate\Http\Request;

class ScholarshipDocumentController extends Controller
{
    public function index()
    {
        $documents = ScholarshipDocument::with('scholarshipApplication')->get();
        return response()->json($documents);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'application_id' => 'required|exists:scholarship_applications,id',
            'file_path' => 'required|string|max:255',
        ]);

        $document = ScholarshipDocument::create($validatedData);

        return response()->json($document, 201);
    }

    public function show(ScholarshipDocument $scholarshipDocument)
    {
        return response()->json($scholarshipDocument->load('scholarshipApplication'));
    }

    public function update(Request $request, ScholarshipDocument $scholarshipDocument)
    {
        $validatedData = $request->validate([
            'application_id' => 'required|exists:scholarship_applications,id',
            'file_path' => 'required|string|max:255',
        ]);

        $scholarshipDocument->update($validatedData);

        return response()->json($scholarshipDocument);
    }

    public function destroy(ScholarshipDocument $scholarshipDocument)
    {
        $scholarshipDocument->delete();
        return response()->json(null, 204);
    }
}
