<x-layout title="Admin Dashboard">
    <h3 class="mt-4 mb-3">All Properties</h3>

    <!-- Search Form -->
    <form method="GET" action="{{ route('dashboard') }}" class="mb-4 d-flex gap-2">
    <input type="text" 
           name="search" 
           class="form-control" 
           placeholder="Search by title or city..." 
           value="{{ request('search') }}">
    <button type="submit" class="btn btn-primary">Search</button>
</form>


    @if($properties->isEmpty())
        <p>No properties available.</p>
    @else
        <div class="row g-4">
            @foreach($properties as $property)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        {{-- Property Image --}}
                        @if($property->image)
                            <img src="{{ asset('storage/' . $property->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $property->title }}" 
                                 style="height:200px; object-fit:cover;">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $property->title }}</h5>
                            <p class="card-text mb-1"><strong>City:</strong> {{ $property->city }}</p>
                            <p class="card-text mb-1"><strong>Type:</strong> {{ $property->type }}</p>
                            <p class="card-text mb-1"><strong>Price:</strong> ${{ number_format($property->price, 2) }}</p>
                            <p class="card-text text-muted mb-2">
                                <strong>Agent:</strong> {{ $property->agent->name ?? 'Unknown' }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="mt-4">
                 {{ $properties->appends(request()->only('search'))->links() }}
             </div>

        </div>
    @endif
</x-layout>
