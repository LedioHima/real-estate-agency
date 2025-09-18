<!-- resources/views/auth/login.blade.php -->
<x-layout title="Login">
    <div class="d-flex justify-content-center align-items-center min-vh-90">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-center bg-dark text-white py-4 rounded-top-4">
                    <h3 class="mb-0">
                        <i class="bi bi-box-arrow-in-right"></i> Welcome Back
                    </h3>
                    <p class="small mb-0 text-secondary">Login to continue to your account</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

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

                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small" for="remember">Remember Me</label>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </button>
                        </div>
                    </form>

                    <!-- Extra links -->
                
                        <p class="mt-3 mb-0 small">
                            Don’t have an account? 
                            <a href="{{ route('register.form') }}" class="fw-semibold">Register here</a>
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
        .btn-primary {
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
        }
    </style>
</x-layout>
