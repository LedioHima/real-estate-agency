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
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agents as $agent)
                    <tr>
                        <td>
                            @if($agent->photo)
                                <img src="{{ asset('storage/' . $agent->photo) }}" width="50" height="50" style="object-fit: cover;">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $agent->name }}</td>
                        <td>{{ $agent->email }}</td>
                        <td>{{ $agent->phone ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('agents.edit', $agent) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('agents.destroy', $agent) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this agent?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $agents->links() }}
    </div>
</x-layout>
