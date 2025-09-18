<x-layout title="Manage Agents">
    <div class="container mt-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-primary mb-0">
                <i class="bi bi-people-fill me-2"></i> Agents
            </h1>

            <!-- Add Agent Button -->
            <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addAgentModal">
                <i class="bi bi-person-plus-fill me-1"></i> Add New Agent
            </button>
        </div>

        <!-- Search Form -->
        <form action="{{ route('agents.index') }}" method="GET" class="d-flex mb-4" style="max-width: 400px;">
            <input 
                type="text" 
                name="search" 
                class="form-control me-2 shadow-sm" 
                placeholder="Search by name or email..." 
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary shadow-sm">
                <i class="bi bi-search"></i>
            </button>
        </form>

        <!-- Success Alert -->
        @if(session('success'))
    <div id="successAlert" class="alert alert-success shadow-sm">
        {{ session('success') }}
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const alert = document.getElementById("successAlert");
            if (alert) {
                setTimeout(() => {
                    alert.classList.add("fade");
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 500); // remove after fade
                }, 3000); // 3 sec
            }
        });
    </script>
@endif


        <!-- Agents Table -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Agent Name</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($agents as $agent)
                            <tr>
                                <td>{{ $agent->id }}</td>
                                <td>{{ $agent->name }}</td>
                                <td>{{ $agent->email }}</td>
                                <td class="text-center">
                                    <!-- Edit Button -->
                                    <button 
                                        class="btn btn-sm btn-warning me-1 shadow-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editAgentModal{{ $agent->id }}">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>

                                    <!-- Delete -->
                                    <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Delete this agent?')">
                                            <i class="bi bi-trash-fill"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Agent Modal -->
                            <div class="modal fade" id="editAgentModal{{ $agent->id }}" tabindex="-1" aria-labelledby="editAgentModalLabel{{ $agent->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content shadow-lg border-0 rounded-3">
                                        <div class="modal-header bg-warning text-dark">
                                            <h5 class="modal-title" id="editAgentModalLabel{{ $agent->id }}">
                                                <i class="bi bi-pencil-square me-2"></i> Edit Agent
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('agents.update', $agent->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Name</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                        <input type="text" name="name" class="form-control" value="{{ $agent->name }}" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                                        <input type="email" name="email" class="form-control" value="{{ $agent->email }}" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Password (leave blank to keep current)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                                        <input type="password" name="password" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="bi bi-check-circle me-1"></i> Save Changes
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="bi bi-info-circle"></i> No agents found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $agents->appends(['search' => request('search')])->links() }}
        </div>
    </div>

    <!-- Add Agent Modal -->
    <div class="modal fade" id="addAgentModal" tabindex="-1" aria-labelledby="addAgentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0 rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addAgentModalLabel">
                        <i class="bi bi-person-plus-fill me-2"></i> Add New Agent
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('agents.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-1"></i> Save Agent
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
