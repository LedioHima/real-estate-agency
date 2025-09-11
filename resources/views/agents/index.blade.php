<x-layout title="Manage Agents">
    <div class="container mt-4">
        <h1 class="mb-3">Agents</h1>
        <a href="{{ route('agents.create') }}" class="btn btn-primary mb-3">Add New Agent</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               @forelse($agents as $agent)
    <tr>
        <td>{{ $agent->id }}</td>
        
        <td>{{ $agent->name }}</td>
        <td>{{ $agent->email }}</td>
        
        <td>
            <a href="{{ route('agents.edit', $agent->id) }}" class="btn btn-sm btn-warning">Edit</a>

            <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this agent?')">Delete</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5">No agents found.</td>
    </tr>
@endforelse

            </tbody>
        </table>

        {{ $agents->links() }}
    </div>
</x-layout>
