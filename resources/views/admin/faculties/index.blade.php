<!-- resources/views/admin/faculties/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Faculties</h1>
    <a href="{{ route('admin.faculties.create') }}" class="btn btn-primary">Add New Faculty</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faculties as $faculty)
            <tr>
                <td>{{ $faculty->id }}</td>
                <td>{{ $faculty->name }}</td>
                <td>
                    <a href="{{ route('admin.faculties.edit', $faculty->id) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('admin.faculties.destroy', $faculty->id) }}" method="POST" style="display:inline-block;">
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
