<!-- resources/views/admin/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard Program Studi</h1>
        <p>Welcome, {{ $user->name }}</p>
    </div>
    <!-- <a href="{{ route('studyProgram.student.index') }}" class="btn btn-primary">View Student Applicants</a> -->

@endsection