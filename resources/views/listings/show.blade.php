<x-layout title="Property Details">
    @php
        $property = ['title'=>'Modern Apartment in City Center','description'=>'$250,000 · 2 Beds · 2 Baths · 1200 sqft','image'=>'https://via.placeholder.com/400x250'];
    @endphp

    <div class="card mb-4">
        <img src="{{ $property['image'] }}" class="card-img-top" alt="{{ $property['title'] }}">
        <div class="card-body">
            <h3 class="card-title">{{ $property['title'] }}</h3>
            <p class="card-text">{{ $property['description'] }}</p>
        </div>
    </div>
    <a href="#" class="btn btn-secondary">Back to Listings</a>
</x-layout>
