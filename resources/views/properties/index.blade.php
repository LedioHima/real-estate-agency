<x-layout title="Featured Properties">
    <h1 class="mb-4 text-center fw-bold">Featured Properties</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($properties as $property)
            <div class="col">
                <div class="card h-100">
                    <img src="{{ $property['image'] }}" class="card-img-top" alt="{{ $property['title'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $property['title'] }}</h5>
                        <p class="card-text">{{ $property['description'] }}</p>
                        <p class="fw-bold">Price: ${{ number_format($property['price'], 2) }}</p>
                        <small class="text-muted">{{ $property['city'] }} - {{ $property['type'] }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
