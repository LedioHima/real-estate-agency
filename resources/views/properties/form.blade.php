{{-- resources/views/properties/form.blade.php --}}

{{-- Title --}}
<div class="mb-3">
    <label class="form-label">Title</label>
    <input 
        type="text" 
        name="title" 
        class="form-control @error('title') is-invalid @enderror" 
        value="{{ old('title', isset($property) ? $property->title : '') }}" 
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
        value="{{ old('city', isset($property) ? $property->city : '') }}" 
        required
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
        value="{{ old('type', isset($property) ? $property->type : '') }}" 
        required
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
        step="0.01"
        value="{{ old('price', isset($property) ? $property->price : '') }}" 
        required
    >
    @error('price')
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
        required
    >{{ old('description', isset($property) ? $property->description : '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Image --}}
<div class="mb-3">
    <label class="form-label">Image</label>
    
    {{-- Show preview only when editing --}}
    @if(isset($property) && !empty($property->image))
        <div class="mb-2">
            <img src="{{ asset('storage/' . $property->image) }}" 
                 alt="Property Image" 
                 class="rounded border shadow-sm" 
                 width="150">
        </div>
    @endif

    <input 
        type="file" 
        name="image" 
        class="form-control @error('image') is-invalid @enderror"
    >
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
