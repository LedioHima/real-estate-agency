{{-- resources/views/properties/guest_index.blade.php --}}
<x-layout title="Properties">
    <h1 class="mb-4 text-center">Available Properties</h1>

    @if($properties->isEmpty())
        <p class="text-center">No properties available.</p>
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

                        <div class="card-body d-flex flex-column">
                            {{-- Title --}}
                            <h5 class="card-title">{{ $property->title }}</h5>

                            {{-- City, Type, Price --}}
                            <p class="card-text mb-1"><strong>City:</strong> {{ $property->city }}</p>
                            <p class="card-text mb-1"><strong>Type:</strong> {{ $property->type }}</p>
                            <p class="card-text mb-3"><strong>Price:</strong> ${{ number_format($property->price, 2) }}</p>

                            {{-- Actions --}}
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                {{-- Show More (Modal Trigger) --}}
                                <button type="button" 
                                        class="btn btn-sm btn-outline-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#propertyModal-{{ $property->id }}">
                                    Show More
                                </button>

                                {{-- Favorite Heart Icon --}}
                                @auth
                                    @php
                                        // avoid repeated DB queries — this uses the loaded relationship if available
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

                {{-- Modal for Show More --}}
                <div class="modal fade" id="propertyModal-{{ $property->id }}" tabindex="-1" aria-labelledby="propertyModalLabel-{{ $property->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="propertyModalLabel-{{ $property->id }}">
                                    {{ $property->title }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

                                {{-- Show Agent Details --}}
                                <p class="text-muted"><strong>Agent:</strong> {{ $property->agent->name ?? 'Unknown' }}</p>
                                <p class="text-muted"><strong>Email:</strong> {{ $property->agent->email ?? 'Unknown' }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-layout>
