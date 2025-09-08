<x-layout title="{{ $property['title'] }}">
    <div class="container mt-5">
        <div class="row">
            {{-- Property Image --}}
            <div class="col-md-6">
                <img src="{{ $property['image'] }}" class="img-fluid" alt="{{ $property['title'] }}">
            </div>

            {{-- Property Info --}}
            <div class="col-md-6">
                <h2>{{ $property['title'] }}</h2>
                <p>{{ $property['description'] }}</p>

                <p><strong>City:</strong> {{ $property['city'] }}</p>
                <p><strong>Type:</strong> {{ $property['type'] }}</p>
                <p><strong>Price:</strong> ${{ $property['price'] }}</p>

                <hr>

                {{-- Agent Info --}}
                <h4>Agent Information</h4>
                <p><strong>Name:</strong> {{ $property->agent->name ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $property->agent->email ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $property->agent->phone ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</x-layout>
