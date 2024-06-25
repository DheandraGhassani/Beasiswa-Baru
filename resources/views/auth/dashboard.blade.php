@extends('auth.layouts')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <p>Welcome, {{ $user->name }}</p>
        <p>Your Role IDs: {{ implode(', ', $roleIds->toArray()) }}</p>
    </div>
@endsection
