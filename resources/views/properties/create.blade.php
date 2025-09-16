<x-layout title="Add Property">
    <h1 class="mb-4">Add New Property</h1>

    {{-- Validation Errors (General) --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Title --}}
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input 
                type="text" 
                name="title" 
                class="form-control @error('title') is-invalid @enderror" 
                value="{{ old('title') }}" 
                required
            >
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- City --}}
        <div class="mb-3">
            <label class="form-label">City</label>
            <input 
                type="text" 
                name="city" 
                class="form-control @error('city') is-invalid @enderror" 
                value="{{ old('city') }}"
            >
            @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Type --}}
        <div class="mb-3">
            <label class="form-label">Type</label>
            <input 
                type="text" 
                name="type" 
                class="form-control @error('type') is-invalid @enderror" 
                value="{{ old('type') }}"
            >
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Price --}}
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input 
                type="number" 
                name="price" 
                class="form-control @error('price') is-invalid @enderror" 
                value="{{ old('price') }}"
            >
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Image --}}
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input 
                type="file" 
                name="image" 
                class="form-control @error('image') is-invalid @enderror"
            >
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea 
                name="description" 
                class="form-control @error('description') is-invalid @enderror" 
                rows="4"
            >{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Property</button>
    </form>
</x-layout>
