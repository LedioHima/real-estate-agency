<!-- resources/views/auth/register.blade.php -->
<x-layout title="Register">
    <div class="d-flex justify-content-center align-items-center min-vh-90">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-center bg-dark text-white py-4 rounded-top-4">
                    <h3 class="mb-0">
                        <i class="bi bi-person-plus"></i> Create an Account
                    </h3>
                    <p class="small mb-0 text-secondary">Register as a guest to get started</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input 
                                    type="text" 
                                    id="name"
                                    name="name" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    placeholder="Enter your name" 
                                    value="{{ old('name') }}" 
                                    required
                                >
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input 
                                    type="email" 
                                    id="email"
                                    name="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    placeholder="Enter your email" 
                                    value="{{ old('email') }}" 
                                    required
                                >
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input 
                                    type="password" 
                                    id="password"
                                    name="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    placeholder="Enter your password" 
                                    required
                                >
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                <input 
                                    type="password" 
                                    id="password_confirmation"
                                    name="password_confirmation" 
                                    class="form-control" 
                                    placeholder="Re-enter your password" 
                                    required
                                >
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success fw-bold">
                                <i class="bi bi-check-circle"></i> Register
                            </button>
                        </div>
                    </form>

                    <!-- Extra links -->
                    <div class="text-center mt-4">
                        <p class="small mb-0">
                            Already have an account? 
                            <a href="{{ route('login.form') }}" class="fw-semibold">Login here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background: linear-gradient(135deg, #e6f2ff, #f9fcff, #f0f8ff);
        }
        .card {
            overflow: hidden;
        }
        .input-group-text {
            background-color: #f8f9fa;
        }
        .btn-success {
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
        }
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
        }
    </style>
</x-layout>
