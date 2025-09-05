<x-layout>
    <div class="container mt-5">
        <div class="row">
            @foreach ($properties as $property)
                <div class="col-md-4 mb-4">
                    <a href="{{ route('properties.show', $property->id) }}" class="text-decoration-none text-dark">
                        <div class="card shadow-sm h-100">
                            <img src="{{ $property->image }}" class="card-img-top" alt="{{ $property->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $property->title }}</h5>
                                <p class="card-text text-muted">
                                    {{ $property->city }} – ${{ number_format($property->price, 2) }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
