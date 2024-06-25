<!-- resources/views/faculty/periods/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Periods</h1>
    <a href="{{ route('faculty.periods.create') }}" class="btn btn-success mb-3">Add Period</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($periods as $period)
            <tr>
                <td>{{ $period->id }}</td>
                <td>{{ $period->name }}</td>
                <td>
                    <a href="{{ route('faculty.periods.edit', $period->id) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('faculty.periods.destroy', $period->id) }}" method="POST" style="display:inline-block;">
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
