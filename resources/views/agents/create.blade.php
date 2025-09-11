<x-layout title="Add New Agent">
    <div class="container mt-4">
        <h1>Add Agent</h1>
        <form action="{{ route('agents.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Agent</button>
            <a href="{{ route('agents.index') }}" class="btn btn-secondary">Cancel</a>        
    
        </form>
    </div>
</x-layout>
