@props(['title' => 'RealEstatePro'])
<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel Project') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">MyApp</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    @auth
                        {{-- Common links for all users --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>

                        {{-- Admin links --}}
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item"><a class="nav-link" href="{{route('agents.index')}}">Manage Agents</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Site Settings</a></li>
                        @endif

                        {{-- Agent links --}}
                        @if(auth()->user()->isAgent())
                            <li class="nav-item"><a class="nav-link" href="#">Add Property</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">My Properties</a></li>
                        @endif

                        {{-- Guest links --}}
                        @if(auth()->user()->isGuestUser())
                            <li class="nav-item"><a class="nav-link" href="#">Browse Properties</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">My Favorites</a></li>
                        @endif

                        {{-- Logout --}}
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit">Logout</button>
                            </form>
                        </li>

                    @else
                        {{-- Links for visitors not logged in --}}
                        <li class="nav-item"><a class="nav-link" href="{{ route('login.form') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register.form') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
