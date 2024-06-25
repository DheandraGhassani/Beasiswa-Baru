@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Daftar Pengajuan Beasiswa</div>

        <div class="card-body">
            @if (count($applications) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Jenis Beasiswa</th>
                        <th>Periode</th>
                        <th>IPK</th>
                        <th>Status</th>
                        <th>Dokumen</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                    <tr>
                        <td>{{ $application->scholarshipType->name }}</td>
                        <td>{{ $application->period->name }}</td>
                        <td>{{ $application->gpa }}</td>
                        <td>{{ $application->status }}</td>
                        <td>
                            @foreach ($application->documents as $document)
                            <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">View Document</a><br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('scholarship-applications.edit', $application->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('scholarship-applications.destroy', $application->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>Tidak ada data pengajuan</p>
            @endif
        </div>
    </div>
</div>
@endsection
