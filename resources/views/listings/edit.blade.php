<x-layout title="Edit Property">
    <h2 class="mb-4">Edit Property</h2>
    <form>
        <div class="mb-3">
            <label class="form-label">Property Title</label>
            <input type="text" class="form-control" value="Modern Apartment in City Center">
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="text" class="form-control" value="$250,000">
        </div>
        <div class="mb-3">
            <label class="form-label">Beds</label>
            <input type="number" class="form-control" value="2">
        </div>
        <div class="mb-3">
            <label class="form-label">Baths</label>
            <input type="number" class="form-control" value="2">
        </div>
        <div class="mb-3">
            <label class="form-label">Area (sqft)</label>
            <input type="number" class="form-control" value="1200">
        </div>
        <div class="mb-3">
            <label class="form-label">Image URL</label>
            <input type="text" class="form-control" value="https://via.placeholder.com/400x250">
        </div>
        <button type="submit" class="btn btn-primary">Update Property</button>
    </form>
</x-layout>
