<!-- resources/views/admin/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard Fakultas</h1>
        <p>Welcome, {{ $user->name }}</p>
    </div>

    <!-- <h1>Dashboard Fakultas</h1>

    <a href="{{ route('faculty.periods.index') }}" class="btn btn-primary">View Periode</a>
    <a href="{{ route('faculty.student.index') }}" class="btn btn-primary">View Student Applicants</a> -->

@endsection