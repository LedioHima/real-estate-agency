<!-- resources/views/auth/login.blade.php -->
<x-layout title="Login">
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </div>
                </form>

                <!-- Question + Redirect to Register -->
                <div class="text-center mt-3">
                    <p class="mb-0">
                        Don’t have an account? 
                        <a href="{{ route('register.form') }}">Register here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>
