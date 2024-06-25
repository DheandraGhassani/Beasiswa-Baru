<!-- resources/views/admin/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Pengajuan Beasiswa</h1>
        <p>Welcome, {{ $user->name }}</p>
    </div>
    <!-- <a href="{{ route('scholarship-applications.index') }}" class="btn btn-primary">View Applications</a>
    <a href="{{ route('scholarship-applications.create') }}" class="btn btn-primary">Make Applications</a> -->

@endsection