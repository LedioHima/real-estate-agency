<x-layout title="Edit Property">
    <h1 class="mb-4">Edit Property</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" 
                   value="{{ old('title', $property->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" name="city" id="city" class="form-control" 
                   value="{{ old('city', $property->city) }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" class="form-select" required>
                <option value="Apartment" {{ old('type', $property->type) == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                <option value="House" {{ old('type', $property->type) == 'House' ? 'selected' : '' }}>House</option>
                <option value="Villa" {{ old('type', $property->type) == 'Villa' ? 'selected' : '' }}>Villa</option>
                <option value="Land" {{ old('type', $property->type) == 'Land' ? 'selected' : '' }}>Land</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01"
                   value="{{ old('price', $property->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $property->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($property->image)
                <img src="{{ asset('storage/' . $property->image) }}" alt="Current Property Image" class="rounded mb-2" width="120">
            @else
                <p class="text-muted">No image uploaded</p>
            @endif
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Change Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('properties.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Property</button>
        </div>
    </form>
</x-layout>
