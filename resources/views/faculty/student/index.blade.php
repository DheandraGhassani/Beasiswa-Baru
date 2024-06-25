@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Scholarship Applications</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Scholarship Type</th>
                <th>Period</th>
                <th>Status</th>
                <th>Document</th>

                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($scholarshipApplicationsByFaculty as $application)
            <tr>
                <td>{{ $application->id }}</td>
                <td>{{ $application->user ? $application->user->name : 'N/A' }}</td>
                <td>{{ $application->scholarshipType ? $application->scholarshipType->name : 'N/A' }}</td>
                <td>{{ $application->period ? $application->period->name : 'N/A' }}</td>
                <td>
                    @if($application->status == 'approvedStudyProgram')
                    Approved by Study Program
                    @else
                    {{ $application->status }}
                    @endif
                </td>
                <td>
                    @foreach ($application->documents as $document)
                    <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">View Document</a><br>
                    @endforeach
                </td>
                <td>
                    @if($application->status == 'approvedStudyProgram')
                    <form action="{{ route('faculty.student.approve', $application->id) }}" method="POST" style="display: none;" id="approve-form-{{ $application->id }}">
                        @csrf
                    </form>
                    <a href="#" class="btn btn-secondary" onclick="event.preventDefault(); document.getElementById('approve-form-{{ $application->id }}').submit();">Approve</a>
                    <form action="{{ route('faculty.student.destroy', $application->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengajuan beasiswa ini beserta dokumennya?')">Hapus</button>
                    </form>
                    @else
                    <a href="#" class="btn btn-secondary disabled" tabindex="-1" aria-disabled="true">Approve</a>
                    <form action="{{ route('faculty.student.destroy', $application->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengajuan beasiswa ini beserta dokumennya?')">Hapus</button>
                    </form>
                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection