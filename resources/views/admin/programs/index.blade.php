<!-- resources/views/admin/programs/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Programs</h1>
    <a href="{{ route('admin.programs.create') }}" class="btn btn-success">Add Program</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Faculty</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($programs as $program)
            <tr>
                <td>{{ $program->id }}</td>
                <td>{{ $program->name }}</td>
                <td>{{ $program->faculty->name }}</td>
                <td>
                    <a href="{{ route('admin.programs.edit', $program->id) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('admin.programs.destroy', $program->id) }}" method="POST" style="display:inline-block;">
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
