{{-- resources/views/agent/dashboard.blade.php --}}
<x-layout title="Agent Dashboard">
    <div class="container py-4">
        <!-- Welcome Header -->
        <div class="card border-0 shadow-sm mb-4 bg-success text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-1">Welcome back, {{ $user->name }} 👋</h2>
                    <p class="mb-0">Manage your properties and track your listings here.</p>
                </div>
                <i class="bi bi-building-check display-4 opacity-75"></i>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 text-center h-100 stat-card">
                    <div class="card-body">
                        <i class="bi bi-houses text-success display-6"></i>
                        <h5 class="mt-2 mb-1 fw-bold">{{ $properties->total() }}</h5>
                        <p class="text-muted small mb-0">Total Properties</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 text-center h-100 stat-card">
                    <div class="card-body">
                        <i class="bi bi-cash-coin text-success display-6"></i>
                        <h5 class="mt-2 mb-1 fw-bold">
                            ${{ number_format($properties->avg('price') ?? 0, 2) }}
                        </h5>
                        <p class="text-muted small mb-0">Average Price</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 text-center h-100 stat-card">
                    <div class="card-body">
                        <i class="bi bi-calendar-event text-success display-6"></i>
                        <h5 class="mt-2 mb-1 fw-bold">
                            {{ optional($properties->sortByDesc('created_at')->first())->created_at?->format('M d, Y') ?? '-' }}
                        </h5>
                        <p class="text-muted small mb-0">Latest Listing</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Properties Section -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold text-success mb-0">
                <i class="bi bi-houses me-2"></i> My Properties 
                
            </h4>
        </div>

        <!-- Search -->
        <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
            <div class="input-group shadow-sm" style="max-width: 500px;">
                <span class="input-group-text bg-white text-success">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" 
                       name="search" 
                       class="form-control border-start-0" 
                       placeholder="Search my properties by title or city..." 
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">Search</button>
            </div>
        </form>

        <!-- Properties Grid -->
        @if($properties->isEmpty())
            <div class="alert alert-light border text-muted shadow-sm">
                <i class="bi bi-info-circle me-2"></i>
                You don’t have any properties listed yet.
            </div>
        @else
            <div class="row g-4">
                @foreach($properties as $property)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100 border-0 rounded-3 overflow-hidden property-card">
                            @if($property->image)
                                <img src="{{ asset('storage/' . $property->image) }}" 
                                    class="card-img-top" 
                                    style="height:200px; object-fit:cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                                    <i class="bi bi-image text-muted display-6"></i>
                                </div>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title fw-bold text-success">{{ $property->title }}</h5>
                                
                                <div class="mb-2">
                                    <span class="badge bg-light text-dark border me-2">
                                        <i class="bi bi-geo-alt-fill text-danger"></i> {{ $property->city }}
                                    </span>
                                    <span class="badge bg-success-subtle text-success border">
                                        <i class="bi bi-cash-coin"></i> ${{ number_format($property->price, 2) }}
                                    </span>
                                </div>

                                <p class="text-muted small mb-0">Listed on {{ $property->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $properties->appends(request()->only('search'))->links() }}
            </div>
        @endif
    </div>

    <!-- Hover Effect Style -->
    <style>
        /* Property Card Hover */
        .property-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        /* Stats Card Hover */
        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
    </style>
</x-layout>
