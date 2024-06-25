<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScholarshipApplication;
use App\Models\ScholarshipDocument;
use App\Models\ScholarshipType;
use App\Models\Period;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ScholarshipApplicationController extends Controller
{
    /**
     * Display a listing of the scholarship applications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to log in to view this page.');
        }

        $roleIds = $user->roles->pluck('id');
        $applications = ScholarshipApplication::with('scholarshipType', 'period', 'documents')->get();

        return view('student.applications.index', compact('applications', 'user', 'roleIds'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $scholarshipTypes = ScholarshipType::all();
        $periods = Period::all();

        return view('student.applications.create', compact('scholarshipTypes', 'periods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'scholarship_type_id' => 'required|exists:scholarship_types,id',
            'period_id' => 'required|exists:periods,id',
            'gpa' => 'required|numeric|min:0|max:4',
            'document' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Save Scholarship Application
        $application = new ScholarshipApplication();
        $application->user_id = $request->user_id;
        $application->scholarship_type_id = $request->scholarship_type_id;
        $application->period_id = $request->period_id;
        $application->gpa = $request->gpa;
        $application->status = 'pending';
        $application->created_at = now();
        $application->updated_at = now();
        $application->save();

        // Handle File Upload
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = time() . '-' . $file->getClientOriginalName();
            $path = $file->storeAs('documents', $filename, 'public');

            // Save document path to ScholarshipDocument table
            ScholarshipDocument::create([
                'application_id' => $application->id,
                'file_path' => $path,
            ]);
        }

        return redirect()->route('scholarship-applications.index')
            ->with('success', 'Pengajuan beasiswa berhasil disimpan.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroySelf($id)
    {
        // Temukan pengajuan beasiswa berdasarkan ID
        $application = ScholarshipApplication::findOrFail($id);

        // Hapus dokumen terkait
        foreach ($application->documents as $document) {
            Storage::delete('public/' . $document->file_path);
            $document->delete();
        }

        // Hapus pengajuan beasiswa
        $application->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('scholarship-applications.index')
            ->with('success', 'Pengajuan beasiswa dan dokumen terkait berhasil dihapus.');
    }

    public function destroyByFaculty($id)
    {
        // Find the scholarship application by its id
        $application = ScholarshipApplication::findOrFail($id);

        // Delete the associated documents
        foreach ($application->documents as $document) {
            Storage::delete('public/' . $document->file_path);
            $document->delete();
        }

        // Delete the scholarship application
        $application->delete();

        // Redirect back with a success message
        return redirect()->route('faculty.student.index')
            ->with('success', 'Pengajuan beasiswa dan dokumen terkait berhasil dihapus.');
    }

    public function destroyByStudyProgram($id)
    {
        // Find the scholarship application by its id
        $application = ScholarshipApplication::findOrFail($id);

        // Delete the associated documents
        foreach ($application->documents as $document) {
            Storage::delete('public/' . $document->file_path);
            $document->delete();
        }

        // Delete the scholarship application
        $application->delete();

        // Redirect back with a success message
        return redirect()->route('studyProgram.student.index')
            ->with('success', 'Pengajuan beasiswa dan dokumen terkait berhasil dihapus.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find the scholarship application by its id
        $application = ScholarshipApplication::findOrFail($id);

        // Assuming you have retrieved scholarship types and periods from your database
        $scholarshipTypes = ScholarshipType::all();
        $periods = Period::all();

        // Return the view with the scholarship application data
        return view('student.applications.edit', compact('application', 'scholarshipTypes', 'periods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'scholarship_type_id' => 'required',
            'period_id' => 'required',
            'gpa' => 'required|numeric',
            'status' => 'required|in:pending,approved,approvedStudyProgram,rejected',
            'new_document' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Find the scholarship application by its id
        $application = ScholarshipApplication::findOrFail($id);

        // Update the scholarship application data
        $application->update([
            'scholarship_type_id' => $request->scholarship_type_id,
            'period_id' => $request->period_id,
            'gpa' => $request->gpa,
            'status' => $request->status,
        ]);

        // Handle File Upload if new document is provided
        if ($request->hasFile('new_document')) {
            // Delete the old document
            foreach ($application->documents as $document) {
                Storage::delete('public/' . $document->file_path);
                $document->delete();
            }

            // Upload new document
            $file = $request->file('new_document');
            $filename = time() . '-' . $file->getClientOriginalName();
            $path = $file->storeAs('documents', $filename, 'public');

            // Save new document path to ScholarshipDocument table
            ScholarshipDocument::create([
                'application_id' => $application->id,
                'file_path' => $path,
            ]);
        }

        // Redirect back with a success message
        return redirect()->route('scholarship-applications.index')
            ->with('success', 'Pengajuan beasiswa berhasil diperbarui.');
    }

    // Method untuk menampilkan semua data scholarship applications
    public function viewsAllDataByFaculty()
    {
        $scholarshipApplicationsByFaculty = ScholarshipApplication::with('user', 'scholarshipType', 'period')->get();

        foreach ($scholarshipApplicationsByFaculty as $application) {
            if (!$application->user) {
                Log::info('Missing user for application ID: ' . $application->id);
            }
            if (!$application->scholarshipType) {
                Log::info('Missing scholarshipType for application ID: ' . $application->id);
            }
            if (!$application->period) {
                Log::info('Missing period for application ID: ' . $application->id);
            }
        }

        return view('faculty.student.index', compact('scholarshipApplicationsByFaculty'));
    }

    public function approveByFaculty($id)
    {
        $application = ScholarshipApplication::findOrFail($id);
        $application->status = 'approved';
        $application->save();

        return redirect()->route('faculty.student.index')->with('success', 'Scholarship application approved successfully.');
    }

    public function viewsAllDataByStudyProgram()
    {
        $scholarshipApplicationsByStudyProgram = ScholarshipApplication::with('user', 'scholarshipType', 'period')->get();

        foreach ($scholarshipApplicationsByStudyProgram as $application) {
            if (!$application->user) {
                Log::info('Missing user for application ID: ' . $application->id);
            }
            if (!$application->scholarshipType) {
                Log::info('Missing scholarshipType for application ID: ' . $application->id);
            }
            if (!$application->period) {
                Log::info('Missing period for application ID: ' . $application->id);
            }
        }

        return view('studyProgram.student.index', compact('scholarshipApplicationsByStudyProgram'));
    }

    public function approveByStudyProgram($id)
    {
        $application = ScholarshipApplication::findOrFail($id);
        $application->status = 'approvedStudyProgram';
        $application->save();

        return redirect()->route('studyProgram.student.index')->with('success', 'Scholarship application approved successfully.');
    }
}
