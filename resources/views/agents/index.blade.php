<x-layout title="Manage Agents">
    <div class="container mt-4">
        <h1 class="mb-3">Agents</h1>

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('agents.create') }}" class="btn btn-primary">Add New Agent</a>

            <!-- Search form -->
            <form action="{{ route('agents.index') }}" method="GET" class="d-flex" style="max-width: 350px;">
                <input 
                    type="text" 
                    name="search" 
                    class="form-control me-2" 
                    placeholder="Search by name or email" 
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">Search</button>
            </form>
        </div>

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
                        <td colspan="4" class="text-center">No agents found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Keep pagination links -->
        {{ $agents->appends(['search' => request('search')])->links() }}
    </div>
</x-layout>
