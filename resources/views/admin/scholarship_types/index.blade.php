<!-- resources/views/admin/scholarship_types/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Scholarship Types</h1>
    <a href="{{ route('admin.scholarship_types.create') }}" class="btn btn-success">Add Scholarship Type</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($scholarshipTypes as $scholarshipType)
            <tr>
                <td>{{ $scholarshipType->id }}</td>
                <td>{{ $scholarshipType->name }}</td>
                <td>{{ $scholarshipType->description }}</td>
                <td>
                    <a href="{{ route('admin.scholarship_types.edit', $scholarshipType->id) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('admin.scholarship_types.destroy', $scholarshipType->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
