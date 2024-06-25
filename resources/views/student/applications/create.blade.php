<!-- resources/views/student/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Data Pengajuan Beasiswa</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('scholarship-applications.store') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            <div class="form-group">
                                <label for="scholarship_type_id">Jenis Beasiswa</label>
                                <select class="form-control" id="scholarship_type_id" name="scholarship_type_id">
                                    @foreach($scholarshipTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="period_id">Periode</label>
                                <select class="form-control" id="period_id" name="period_id">
                                    @foreach($periods as $period)
                                        <option value="{{ $period->id }}">{{ $period->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="gpa">IPK</label>
                                <input type="number" step="0.01" class="form-control" id="gpa" name="gpa" min="0" max="4" required>
                            </div>

                            <div class="form-group">
                                <label for="document">Upload Dokumen Trasnskip Nilai, Surat Rekomendasi jadikan dalam 1 File PDF</label>
                                <input type="file" class="form-control" id="document" name="document" accept="application/pdf" required>
                            </div>

                            <input type="hidden" name="status" value="pending">
                            <input type="hidden" name="created_at" value="{{ now() }}">
                            <input type="hidden" name="updated_at" value="{{ now() }}">
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
