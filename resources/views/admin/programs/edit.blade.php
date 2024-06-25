<!-- resources/views/admin/programs/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Program</h1>
    <form action="{{ route('admin.programs.update', $program->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $program->name }}" required>
        </div>
        <div class="form-group">
            <label for="faculty_id">Faculty</label>
            <select name="faculty_id" id="faculty_id" class="form-control" required>
                @foreach($faculties as $faculty)
                <option value="{{ $faculty->id }}" {{ $faculty->id == $program->faculty_id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
