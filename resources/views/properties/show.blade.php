<x-layout>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <img src="{{ $property->image }}" class="card-img-top" alt="{{ $property->title }}">
            <div class="card-body">
                <h2 class="card-title">{{ $property->title }}</h2>
                <p class="text-muted">{{ $property->city }} – {{ $property->type }}</p>
                <h4 class="text-primary">${{ number_format($property->price, 2) }}</h4>
                <p class="mt-3">{{ $property->description }}</p>
                <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Back to Properties</a>
            </div>
        </div>
    </div>
</x-layout>
