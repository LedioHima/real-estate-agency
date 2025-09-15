<x-layout title="My Favorites">
    <h1 class="mb-4 text-center">My Favorite Properties</h1>

    @if($favorites->isEmpty())
        <p class="text-center">You don’t have any favorites yet.</p>
    @else
        <div class="row g-4">
            @foreach($favorites as $favorite)
                @php $property = $favorite->property; @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        {{-- Property Image --}}
                        @if($property->image)
                            <img src="{{ asset('storage/' . $property->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $property->title }}" 
                                 style="height:200px; object-fit:cover;">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $property->title }}</h5>
                            <p class="card-text mb-1"><strong>City:</strong> {{ $property->city }}</p>
                            <p class="card-text mb-1"><strong>Type:</strong> {{ $property->type }}</p>
                            <p class="card-text mb-3"><strong>Price:</strong> ${{ number_format($property->price, 2) }}</p>

                            {{-- Heart Toggle Button --}}
                            <form action="{{ route('favorites.toggle', $property->id) }}" method="POST" class="mt-auto">
                                @csrf
                                <button type="submit" class="btn btn-light w-100">
                                    <i class="bi bi-heart-fill text-danger"></i> Remove from Favorites
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-layout>
