<x-layout title="Manage Properties">
    <div class="container mt-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-success mb-0">
                <i class="bi bi-houses-fill me-2"></i> Properties
            </h1>

            <!-- Add Property Button -->
            <button class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#addPropertyModal">
                <i class="bi bi-plus-circle-fill me-1"></i> Add New Property
            </button>
        </div>

        <!-- Search Form -->
        <form action="{{ route('properties.index') }}" method="GET" class="d-flex mb-4" style="max-width: 400px;">
            <input 
                type="text" 
                name="search" 
                class="form-control me-2 shadow-sm" 
                placeholder="Search by title, city or type..." 
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-success shadow-sm">
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
                            setTimeout(() => alert.remove(), 500);
                        }, 3000);
                    }
                });
            </script>
        @endif

        <!-- Properties Table -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">City</th>
                            <th scope="col">Type</th>
                            <th scope="col">Price</th>
                            <th scope="col">Agent</th>
                            <th scope="col">Image</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($properties as $property)
                            <tr>
                                <td>{{ $property->id }}</td>
                                <td>{{ $property->title }}</td>
                                <td>{{ $property->city }}</td>
                                <td>{{ $property->type }}</td>
                                <td>${{ number_format($property->price, 2) }}</td>
                                <td>{{ $property->agent ? $property->agent->name : '—' }}</td>
                                <td>
                                    @if($property->image)
                                        <img src="{{ asset('storage/' . $property->image) }}" 
                                             alt="Property Image" 
                                             class="rounded shadow-sm" 
                                             width="70">
                                    @endif
                                </td>
                                <td class="text-center">
                                    <!-- Edit Button -->
                                    <button 
                                        class="btn btn-sm btn-warning me-1 shadow-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editPropertyModal{{ $property->id }}">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>

                                    <!-- Delete -->
                                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Delete this property?')">
                                            <i class="bi bi-trash-fill"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Property Modal -->
                            <div class="modal fade" id="editPropertyModal{{ $property->id }}" tabindex="-1" aria-labelledby="editPropertyModalLabel{{ $property->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content shadow-lg border-0 rounded-3">
                                        <div class="modal-header bg-warning text-dark">
                                            <h5 class="modal-title" id="editPropertyModalLabel{{ $property->id }}">
                                                <i class="bi bi-pencil-square me-2"></i> Edit Property
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                @include('properties.form', ['property' => $property])
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
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="bi bi-info-circle"></i> No properties found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $properties->appends(['search' => request('search')])->links() }}
        </div>
    </div>

    <!-- Add Property Modal -->
    <div class="modal fade" id="addPropertyModal" tabindex="-1" aria-labelledby="addPropertyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg border-0 rounded-3">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addPropertyModalLabel">
                        <i class="bi bi-plus-circle-fill me-2"></i> Add New Property
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- Force empty property to avoid pre-filled values --}}
                        @include('properties.form', ['property' => null])
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-1"></i> Save Property
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
