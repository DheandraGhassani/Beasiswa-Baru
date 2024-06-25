<!-- resources/views/admin/index.blade.php -->
@extends('layouts.app')


@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <p>Welcome, {{ $user->name }}</p>

    <!-- <div>
        <a href="{{ route('admin.faculties.index') }}" class="btn btn-primary">View Faculties</a>
        <a href="{{ route('admin.faculties.create') }}" class="btn btn-success">Add Faculty</a>

        <a href="{{ route('admin.programs.index') }}" class="btn btn-primary">View Programs</a>
        <a href="{{ route('admin.programs.create') }}" class="btn btn-success">Add Program</a>
        
        Tautan untuk Users dan Scholarship Types
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">View Users</a>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">Add User</a>
        <a href="{{ route('admin.scholarship_types.index') }}" class="btn btn-primary">View Scholarship Types</a>
        <a href="{{ route('admin.scholarship_types.create') }}" class="btn btn-success">Add Scholarship Type</a>
    </div> -->

</div>
@endsection