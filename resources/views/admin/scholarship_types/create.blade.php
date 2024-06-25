<!-- resources/views/admin/scholarship_types/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Scholarship Type</h1>
    <form action="{{ route('admin.scholarship_types.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
