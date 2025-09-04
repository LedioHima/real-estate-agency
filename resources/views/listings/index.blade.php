<x-layout title="Welcome to RealEstatePro">
    <h1 class="mb-4 text-center fw-bold">Featured Properties</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @php
            $properties = [
                ['title'=>'Modern Apartment in City Center','description'=>'$250,000 · 2 Beds · 2 Baths · 1200 sqft','image'=>'https://via.placeholder.com/400x250'],
                ['title'=>'Luxury Villa with Pool','description'=>'$1,200,000 · 5 Beds · 4 Baths · 5000 sqft','image'=>'https://via.placeholder.com/400x250'],
                ['title'=>'Cozy Suburban House','description'=>'$350,000 · 3 Beds · 2 Baths · 1800 sqft','image'=>'https://via.placeholder.com/400x250']
            ];
        @endphp

        @foreach($properties as $property)
            <x-listing-card :property="$property" />
        @endforeach
    </div>
</x-layout>
