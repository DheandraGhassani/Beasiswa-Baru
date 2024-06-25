<!-- resources/views/student/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Pengajuan Beasiswa</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('scholarship-applications.update', $application->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Scholarship Type ID (select field) -->
                        <div class="form-group">
                            <label for="scholarship_type_id">Jenis Beasiswa</label>
                            <select class="form-control" id="scholarship_type_id" name="scholarship_type_id">
                                @foreach($scholarshipTypes as $type)
                                <option value="{{ $type->id }}" {{ $application->scholarship_type_id == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Period ID (select field) -->
                        <div class="form-group">
                            <label for="period_id">Periode</label>
                            <select class="form-control" id="period_id" name="period_id">
                                @foreach($periods as $period)
                                <option value="{{ $period->id }}" {{ $application->period_id == $period->id ? 'selected' : '' }}>
                                    {{ $period->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- GPA (input field) -->
                        <div class="form-group">
                            <label for="gpa">IPK</label>
                            <input type="text" class="form-control" id="gpa" name="gpa" value="{{ $application->gpa }}">
                        </div>

                        <!-- Current Document -->
                        <div class="form-group">
                            <label for="current_document">Dokumen Saat Ini</label><br>
                            @foreach ($application->documents as $document)
                            <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">View Document</a><br>
                            @endforeach
                        </div>

                        <!-- Upload New Document -->
                        <div class="form-group">
                            <label for="new_document">Upload Dokumen Baru</label>
                            <input type="file" class="form-control-file" id="new_document" name="new_document">
                        </div>

                        <!-- Status (select field) -->
                        <div class="form-group" hidden>
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="approved" {{ $application->status == 'approvedStudyProgram' ? 'selected' : '' }}>Approved Study Program</option>
                                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
