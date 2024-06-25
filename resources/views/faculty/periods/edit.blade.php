<!-- resources/views/faculty/periods/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Period</h1>
    <form action="{{ route('faculty.periods.update', ['id' => $period->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $period->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
