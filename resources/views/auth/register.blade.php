<x-layout title="Register">
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Register as Guest</div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Name Field --}}
                    <div class="mb-3">
                        <input 
                            type="text" 
                            name="name" 
                            class="form-control @error('name') is-invalid @enderror" 
                            placeholder="Name" 
                            value="{{ old('name') }}" 
                            required
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email Field --}}
                    <div class="mb-3">
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            placeholder="Email" 
                            value="{{ old('email') }}" 
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password Field --}}
                    <div class="mb-3">
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            placeholder="Password" 
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Confirm Password Field --}}
                    <div class="mb-3">
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            class="form-control" 
                            placeholder="Confirm Password" 
                            required
                        >
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>

                
                <div class="text-center mt-3">
                    <p class="mb-0">
                        Do have an account? 
                        <a href="{{ route('login.form') }}">Log in here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>