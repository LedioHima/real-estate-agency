<x-layout title="My Properties">
    <h1 class="mb-4">Manage Properties</h1>

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
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th> {{-- New column --}}
                </tr>
            </thead>
            <tbody>
                @foreach($properties as $property)
                    <tr>
                        <td>{{ $property->title }}</td>
                        <td>{{ $property->city }}</td>
                        <td>{{ $property->type }}</td>
                        <td>${{ number_format($property->price, 2) }}</td>
                        <td>{{ $property->description }}</td>
                        <td>
                            @if($property->image)
                                <img src="{{ asset('storage/' . $property->image) }}" alt="Property Image" width="80">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            
                            <form action="{{ route('properties.destroy', $property->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this property?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-layout>
