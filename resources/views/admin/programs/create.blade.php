<!-- resources/views/admin/programs/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Program</h1>
    <form action="{{ route('admin.programs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="faculty_id">Faculty</label>
            <select name="faculty_id" id="faculty_id" class="form-control" required>
                @foreach($faculties as $faculty)
                <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
