<!-- resources/views/dashboard.blade.php -->
<x-layout title="Dashboard">
    <div class="card">
        <div class="card-body">
            <h2>Welcome, {{ $user->name }}!</h2>
            <p>You are logged in as <strong>{{ ucfirst($user->role) }}</strong>.</p>
        </div>
    </div>
</x-layout>
