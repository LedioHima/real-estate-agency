<x-layout title="Add Property">
    <h2 class="mb-4">Add New Property</h2>
    <form>
        <div class="mb-3">
            <label class="form-label">Property Title</label>
            <input type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Beds</label>
            <input type="number" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Baths</label>
            <input type="number" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Area (sqft)</label>
            <input type="number" class="form-control">
        </div>

        {{-- We need a img file upload --}}

        
        <button type="submit" class="btn btn-success">Add Property</button>
    </form>
</x-layout>
