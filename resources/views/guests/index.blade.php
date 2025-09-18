{{-- resources/views/guests/index.blade.php --}}
<x-layout title="Manage Guests">
    <div class="container mt-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-success mb-0">
                <i class="bi bi-people me-2"></i> Guests
            </h1>
        </div>

        <!-- Search Form -->
        <form action="{{ route('guests.index') }}" method="GET" class="d-flex mb-4" style="max-width: 400px;">
            <input 
                type="text" 
                name="search" 
                class="form-control me-2 shadow-sm" 
                placeholder="Search by name or email..." 
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

        <!-- Guests Table -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Guest Name</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-center">Favourites</th>
                            <th scope="col" class="text-center">Registered</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($guests as $guest)
                            <tr>
                                <td>{{ $guest->id }}</td>
                                <td>{{ $guest->name }}</td>
                                <td>{{ $guest->email }}</td>
                                <td class="text-center">
                                    <button 
                                        class="btn btn-outline-primary btn-sm shadow-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#favoritesModal{{ $guest->id }}">
                                        <i class="bi bi-heart-fill text-danger me-1"></i>
                                        {{ $guest->favorites_count }}
                                    </button>
                                </td>
                                <td class="text-center">{{ $guest->created_at->format('M d, Y') }}</td>
                                <td class="text-center">
                                    <!-- View Button -->
                                    <button 
                                        class="btn btn-sm btn-info shadow-sm me-1"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#viewGuestModal{{ $guest->id }}">
                                        <i class="bi bi-eye"></i> View
                                    </button>

                                    <!-- Delete -->
                                    <form action="{{ route('guests.destroy', $guest->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="btn btn-sm btn-danger shadow-sm" 
                                            onclick="return confirm('Delete this guest?')">
                                            <i class="bi bi-trash-fill"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- View Guest Modal -->
                            <div class="modal fade" id="viewGuestModal{{ $guest->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content shadow-lg border-0 rounded-3">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title">
                                                <i class="bi bi-person-circle me-2"></i> Guest Details
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><i class="bi bi-hash text-success me-2"></i><strong>ID:</strong> {{ $guest->id }}</p>
                                            <p><i class="bi bi-person text-success me-2"></i><strong>Name:</strong> {{ $guest->name }}</p>
                                            <p><i class="bi bi-envelope text-success me-2"></i><strong>Email:</strong> {{ $guest->email }}</p>
                                            <p><i class="bi bi-calendar3 text-success me-2"></i><strong>Registered On:</strong> {{ $guest->created_at->format('F d, Y h:i A') }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Favorites Modal -->
                            <div class="modal fade" id="favoritesModal{{ $guest->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content shadow-lg border-0 rounded-3">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">
                                                <i class="bi bi-heart-fill me-2"></i> {{ $guest->name }}'s Favorites
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if($guest->favorites->isEmpty())
                                                <p class="text-muted"><i class="bi bi-info-circle"></i> No favorite properties.</p>
                                            @else
                                                <ul class="list-group">
                                                    @foreach($guest->favorites as $favorite)
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <span>
                                                                <strong><i class="bi bi-building text-primary me-1"></i>{{ $favorite->property->title }}</strong> 
                                                                <br>
                                                                <small class="text-muted">
                                                                    <i class="bi bi-geo-alt text-danger me-1"></i>{{ $favorite->property->city }} 
                                                                    - <i class="bi bi-cash-coin text-success me-1"></i>${{ number_format($favorite->property->price, 2) }}
                                                                </small>
                                                                <br>
                                                                @if($favorite->property->agent)
                                                                    <small class="text-muted">
                                                                        <i class="bi bi-person-badge text-warning me-1"></i>Agent: {{ $favorite->property->agent->name }}
                                                                    </small>
                                                                @endif
                                                                <small class="text-muted d-block">
                                                                    <i class="bi bi-clock-history text-secondary me-1"></i>Added on: {{ $favorite->created_at->format('M d, Y') }}
                                                                </small>
                                                            </span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-info-circle"></i> No guests found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $guests->appends(['search' => request('search')])->links() }}
        </div>
    </div>
</x-layout>
