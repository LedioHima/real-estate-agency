<x-layout title="Edit Agent">
    <div class="container mt-4">
        <h1>Edit Agent</h1>
        <form action="{{ route('agents.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

    

            <div class="mb-3">
                <label>Password (leave blank to keep current)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('agents.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-layout>
