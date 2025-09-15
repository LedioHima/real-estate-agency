<!-- resources/views/admin/dashboard.blade.php -->
<x-layout title="Admin Dashboard">
    <div class="card">
        <div class="card-body">
            <h2>Welcome, {{ $user->name }}!</h2>
            <p>You are logged in as <strong>Admin</strong>.</p>
            <a href="{{ route('properties.index') }}" class="btn btn-primary">Manage Properties</a>
        </div>
    </div>
</x-layout>
