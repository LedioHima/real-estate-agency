<x-layout title="All Properties">
    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($properties as $property)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ $property['image'] }}" class="card-img-top" alt="{{ $property['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $property['title'] }}</h5>
                            <p class="card-text">City: {{ $property['city'] }}</p>
                            <p class="card-text">Price: ${{ $property['price'] }}</p>
                            
                            {{-- Display Agent Name --}}
                            <p class="card-text">
                                <strong>Agent:</strong> {{ $property->agent->name ?? 'N/A' }}
                            </p>

                            {{-- Link to view details --}}
                            <a href="{{ route('properties.show', $property['id']) }}" class="btn btn-primary">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
