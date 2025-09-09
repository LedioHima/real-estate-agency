<!-- resources/views/dashboard.blade.php -->
@extends('components.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2>Welcome, {{ $user->name }}!</h2>
            <p>You are logged in as <strong>{{ ucfirst($user->role) }}</strong>.</p>
        </div>
    </div>
@endsection
