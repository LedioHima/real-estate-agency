<x-layout title="Properties">

    <!-- Hero Section with Slideshow Background -->
    <section class="hero-section position-relative text-center text-white mb-5">

        {{-- Dynamic Slideshow --}}
        @if(isset($slideshowProperties) && $slideshowProperties->isNotEmpty())
            <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    @foreach($slideshowProperties as $index => $property)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $property->image) }}"
                                 class="d-block w-100"
                                 alt="{{ $property->title }}"
                                 style="object-fit: cover; height: 500px;">
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            {{-- Fallback if no slideshow --}}
            <img src="{{ asset('images/hero.jpg') }}" 
                 class="w-100" 
                 alt="Hero Background"
                 style="height: 500px; object-fit: cover;">
        @endif

        <!-- Dark Overlay -->
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50"></div>

        <!-- Content inside hero -->
        <div class="hero-content position-absolute top-50 start-50 translate-middle w-75">
            <h1 class="fw-bold display-4 mb-3 fancy-title">🏡 Available <span class="text-primary">Properties</span></h1>
            <p class="fs-5 fst-italic mb-0">Find your dream home with our latest listings</p>
        </div>
    </section>

    <!-- Search & Filter Bar (moved below hero) -->
    <div class="container mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form method="GET" action="{{ route('home') }}" class="row g-3">
                    <!-- Search -->
                    <div class="col-md-4">
                        <input type="text" 
                               name="search" 
                               class="form-control form-control-lg" 
                               placeholder="Search by title, city, or type..." 
                               value="{{ request('search') }}">
                    </div>

                    <!-- Min Price -->
                    <div class="col-md-2">
                        <input type="number" 
                               name="min_price" 
                               class="form-control" 
                               placeholder="Min Price" 
                               value="{{ request('min_price') }}">
                    </div>

                    <!-- Max Price -->
                    <div class="col-md-2">
                        <input type="number" 
                               name="max_price" 
                               class="form-control" 
                               placeholder="Max Price" 
                               value="{{ request('max_price') }}">
                    </div>

                    <!-- Sort Dropdown -->
                    <div class="col-md-2">
                        <select name="sort" class="form-select">
                            <option value="">Sort By</option>
                            <option value="low-high" {{ request('sort') == 'low-high' ? 'selected' : '' }}>Price: Low → High</option>
                            <option value="high-low" {{ request('sort') == 'high-low' ? 'selected' : '' }}>Price: High → Low</option>
                        </select>
                    </div>

                    <!-- Submit -->
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Apply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Property Listings -->
    @if($properties->isEmpty())
        <p class="text-center text-muted">No properties available.</p>
    @else
        <div class="row g-4">
            @foreach($properties as $property)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100 property-card">
                        
                        <!-- Property Image -->
                        @if($property->image)
                            <img src="{{ asset('storage/' . $property->image) }}" 
                                 class="card-img-top rounded-top" 
                                 alt="{{ $property->title }}" 
                                 style="height:220px; object-fit:cover;">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <!-- Title -->
                            <h5 class="card-title fw-bold text-primary">{{ $property->title }}</h5>

                            <!-- City, Type, Price -->
                            <p class="card-text mb-1"><i class="bi bi-geo-alt"></i> {{ $property->city }}</p>
                            <p class="card-text mb-1"><strong>Type:</strong> {{ $property->type }}</p>
                            <p class="card-text fw-bold text-success mb-3">
                                ${{ number_format($property->price, 2) }}
                            </p>

                            <!-- Actions -->
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <!-- Show More -->
                                <button type="button" 
                                        class="btn btn-outline-primary btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#propertyModal-{{ $property->id }}">
                                    Show More
                                </button>

                                <!-- Favorite -->
                                @auth
                                    @php
                                        $isFav = Auth::user()->favorites->contains('property_id', $property->id);
                                    @endphp
                                    <form action="{{ route('favorites.toggle', $property->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0" aria-label="Toggle favorite">
                                            <i class="bi {{ $isFav ? 'bi-heart-fill text-danger' : 'bi-heart' }}" style="font-size:1.25rem;"></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login.form') }}" class="btn btn-link p-0">
                                        <i class="bi bi-heart"></i>
                                    </a>
                                @endauth
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

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $properties->appends(request()->only('search', 'min_price', 'max_price', 'sort'))->links() }}
        </div>
    @endif

</x-layout>

<!-- Extra CSS -->
<style>
    .hero-section {
        height: 500px;
        overflow: hidden;
    }
    .hero-overlay {
        background: rgba(0, 0, 0, 0.55);
    }
    .hero-content {
        z-index: 2;
    }
    .property-card:hover {
        transform: translateY(-5px);
        transition: 0.3s ease-in-out;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
</style>
