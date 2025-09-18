<x-layout title="My Favorites">
    <div class="container py-4">
        <!-- Page Title -->
        <h1 class="mb-5 text-center fw-bold">
            ❤️ My <span class="text-primary">Favorite</span> Properties
        </h1>

        <!-- Search Bar -->
        <form action="{{ route('favorites.index') }}" method="GET" 
              class="mb-5 d-flex mx-auto shadow-sm rounded-pill overflow-hidden"
              style="max-width: 500px;">
            <input 
                type="text" 
                name="search" 
                class="form-control border-0 ps-4" 
                placeholder="Search by title, city, or type..."
                value="{{ request('search') }}"
            >
            <button class="btn btn-primary px-4" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>

        @if($favorites->isEmpty())
            <div class="text-center">
                <i class="bi bi-heart text-danger display-1"></i>
                <p class="mt-3 fs-5 text-muted">You don’t have any favorites yet.</p>
                <a href="{{ route('home') }}" class="btn btn-outline-primary mt-2">
                    <i class="bi bi-house-heart"></i> Browse Properties
                </a>
            </div>
        @else
            <!-- Favorite Properties Grid -->
            <div class="row g-4">
                @foreach($favorites as $favorite)
                    @php $property = $favorite->property; @endphp
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm border-0 rounded-3 h-100 property-card">
                            <!-- Property Image -->
                            @if($property->image)
                                <img src="{{ asset('storage/' . $property->image) }}" 
                                    class="card-img-top rounded-top-3" 
                                    alt="{{ $property->title }}" 
                                    style="height:220px; object-fit:cover;">
                            @endif

                            <div class="card-body d-flex flex-column">
                                <!-- Title -->
                                <h5 class="card-title fw-bold text-primary">{{ $property->title }}</h5>

                                <!-- Details -->
                                <p class="card-text mb-1"><i class="bi bi-geo-alt text-danger"></i> {{ $property->city }}</p>
                                <p class="card-text mb-1"><strong>Type:</strong> {{ $property->type }}</p>
                                <p class="card-text fw-bold text-success mb-3">
                                    ${{ number_format($property->price, 2) }}
                                </p>

                                <div class="d-flex gap-2 mt-auto">
                                    <!-- Show More -->
                                    <button type="button" 
                                            class="btn btn-outline-primary w-50 rounded-pill"
                                            data-bs-toggle="modal"
                                            data-bs-target="#propertyModal-{{ $property->id }}">
                                        <i class="bi bi-info-circle"></i> Details
                                    </button>

                                    <!-- Remove from Favorites -->
                                    <form action="{{ route('favorites.toggle', $property->id) }}" method="POST" class="w-50">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger w-100 rounded-pill">
                                            <i class="bi bi-heart-fill"></i> Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="propertyModal-{{ $property->id }}" tabindex="-1" aria-labelledby="propertyModalLabel-{{ $property->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold text-primary" id="propertyModalLabel-{{ $property->id }}">
                                        {{ $property->title }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    @if($property->image)
                                        <img src="{{ asset('storage/' . $property->image) }}" 
                                             class="img-fluid rounded mb-3" 
                                             alt="{{ $property->title }}">
                                    @endif
                                    <p><strong>City:</strong> {{ $property->city }}</p>
                                    <p><strong>Type:</strong> {{ $property->type }}</p>
                                    <p><strong>Price:</strong> ${{ number_format($property->price, 2) }}</p>
                                    <p><strong>Description:</strong> {{ $property->description }}</p>
                                    <p class="text-muted"><strong>Agent:</strong> {{ $property->agent->name ?? 'Unknown' }}</p>
                                    <p class="text-muted"><strong>Email:</strong> {{ $property->agent->email ?? 'Unknown' }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Extra CSS -->
    <style>
        .property-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .property-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        form input:focus {
            box-shadow: none;
        }
    </style>
</x-layout>
