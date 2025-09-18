<x-layout title="Admin Dashboard">
  <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary mb-0">
            <i class="bi bi-speedometer2 me-2"></i> Admin Dashboard
        </h1>
    </div>
</div>

        
     <!-- Search Form -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('dashboard') }}" class="d-flex gap-2">
                    <input 
                        type="text" 
                        name="search" 
                        class="form-control rounded-pill" 
                        placeholder="🔍 Search by title or city..." 
                        value="{{ request('search') }}"
                    >
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-search"></i> Search
                    </button>
                </form>
            </div>
        </div>

    <!-- Statistics Section -->
    <div class="row g-4 my-4">
        <!-- Total Properties -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-4">
                <i class="bi bi-building text-primary" style="font-size:2rem;"></i>
                <h5 class="mt-3 mb-1">Total Properties</h5>
                <h3 class="fw-bold">{{ $totalProperties }}</h3>
            </div>
        </div>

        <!-- Total Agents -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-4">
                <i class="bi bi-person-badge text-success" style="font-size:2rem;"></i>
                <h5 class="mt-3 mb-1">Total Agents</h5>
                <h3 class="fw-bold">{{ $totalAgents }}</h3>
            </div>
        </div>

        <!-- Total Users -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-4">
                <i class="bi bi-people text-warning" style="font-size:2rem;"></i>
                <h5 class="mt-3 mb-1">Total Users</h5>
                <h3 class="fw-bold">{{ $totalUsers }}</h3>
            </div>
        </div>
    </div>


        <!-- Properties -->
        @if($properties->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                <i class="bi bi-info-circle"></i> No properties available.
            </div>
        @else
            <div class="row g-4">
                @foreach($properties as $property)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm border-0 h-100">
                            <!-- Property Image -->
                            @if($property->image)
                                <img src="{{ asset('storage/' . $property->image) }}" 
                                     class="card-img-top rounded-top" 
                                     alt="{{ $property->title }}" 
                                     style="height:200px; object-fit:cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                                    <span class="text-muted"><i class="bi bi-image"></i> No Image</span>
                                </div>
                            @endif

                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">{{ $property->title }}</h5>
                                <p class="card-text mb-1"><i class="bi bi-geo-alt"></i> <strong>City:</strong> {{ $property->city }}</p>
                                <p class="card-text mb-1"><i class="bi bi-house-door"></i> <strong>Type:</strong> {{ $property->type }}</p>
                                <p class="card-text mb-1"><i class="bi bi-cash-stack"></i> <strong>Price:</strong> ${{ number_format($property->price, 2) }}</p>
                                <p class="card-text text-muted mb-3">
                                    <i class="bi bi-person-badge"></i> <strong>Agent:</strong> {{ $property->agent->name ?? 'Unknown' }}
                                </p>

                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $properties->appends(request()->only('search'))->links() }}
            </div>
        @endif
    </div>

    <!-- Extra CSS for hover/animations -->
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        
    </style>
</x-layout>
