<x-layout title="Add New Agent">
    <div class="container mt-4">
        <h1>Add Agent</h1>
        
        {{-- Show global error message --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('agents.store') }}" method="POST">
            @csrf

            {{-- Name Field --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input 
                    type="text" 
                    id="name"
                    name="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name') }}" 
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email Field --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                    type="email" 
                    id="email"
                    name="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    value="{{ old('email') }}" 
                    required
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password Field --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    required
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Buttons --}}
            <button type="submit" class="btn btn-primary">Create Agent</button>
            <a href="{{ route('agents.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-layout>
