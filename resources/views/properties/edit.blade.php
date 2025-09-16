<x-layout title="Edit Property">
    <h1 class="mb-4">Edit Property</h1>

    {{-- Validation Errors --}}
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

        {{-- Title --}}
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                class="form-control @error('title') is-invalid @enderror" 
                value="{{ old('title', $property->title) }}" 
                required
            >
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- City --}}
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input 
                type="text" 
                name="city" 
                id="city" 
                class="form-control @error('city') is-invalid @enderror" 
                value="{{ old('city', $property->city) }}" 
                required
            >
            @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Type (Changed to Text Input) --}}
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input 
                type="text" 
                name="type" 
                id="type" 
                class="form-control @error('type') is-invalid @enderror" 
                value="{{ old('type', $property->type) }}" 
                required
            >
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Price --}}
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input 
                type="number" 
                name="price" 
                id="price" 
                class="form-control @error('price') is-invalid @enderror" 
                step="0.01"
                value="{{ old('price', $property->price) }}" 
                required
            >
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea 
                name="description" 
                id="description" 
                class="form-control @error('description') is-invalid @enderror" 
                rows="4" 
                required
            >{{ old('description', $property->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Current Image --}}
        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($property->image)
                <img src="{{ asset('storage/' . $property->image) }}" 
                     alt="Current Property Image" 
                     class="rounded mb-2" 
                     width="120">
            @else
                <p class="text-muted">No image uploaded</p>
            @endif
        </div>

        {{-- Change Image --}}
        <div class="mb-3">
            <label for="image" class="form-label">Change Image</label>
            <input 
                type="file" 
                name="image" 
                id="image" 
                class="form-control @error('image') is-invalid @enderror"
            >
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="d-flex justify-content-between">
            <a href="{{ route('properties.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Property</button>
        </div>
    </form>
</x-layout>
