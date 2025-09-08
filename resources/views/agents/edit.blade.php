<x-layout title="Edit Agent">
    <div class="container mt-4">
        <h1>Edit Agent</h1>
        <form action="{{ route('agents.update', $agent) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ $agent->name }}" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $agent->email }}" required>
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $agent->phone }}">
            </div>

            <div class="mb-3">
                <label>Photo</label>
                @if($agent->photo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $agent->photo) }}" width="100" style="object-fit: cover;">
                    </div>
                @endif
                <input type="file" name="photo" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</x-layout>
