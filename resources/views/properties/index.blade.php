<x-layout title="My Properties">
    <h1 class="mb-4">My Properties</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('properties.create') }}" class="btn btn-success mb-3">Add New Property</a>

    @if($properties->isEmpty())
        <p>No properties found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>City</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach($properties as $property)
                    <tr>
                        <td>{{ $property->title }}</td>
                        <td>{{ $property->city }}</td>
                        <td>{{ $property->type }}</td>
                        <td>${{ number_format($property->price, 2) }}</td>
                        <td>
                            @if($property->image)
                                <img src="{{ asset('storage/' . $property->image) }}" alt="Property Image" width="80">
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-layout>
