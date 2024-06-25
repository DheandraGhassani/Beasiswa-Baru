<!-- resources/views/admin/scholarship_types/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Scholarship Type</h1>
    <form action="{{ route('admin.scholarship_types.update', $scholarshipType->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $scholarshipType->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ $scholarshipType->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
