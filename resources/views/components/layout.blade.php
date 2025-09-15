@props(['title' => 'MyApp']) {{-- default title --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Real Estate</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item"><a class="nav-link" href="{{ route('agents.index') }}">Manage Agents</a></li>
                        @endif
                        
                        @if(auth()->user()->isAgent())
                             <li class="nav-item"><a class="nav-link" href="{{ route('properties.index') }}">Manage Properties</a></li>  
                        @endif
                        
                        @if(auth()->user()->isGuestUser())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('favorites.index') }}">
                                    ❤️ Favorites
                                </a>
                            </li>
                        @endif

                        <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}">Profile</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login.form') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register.form') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        {{ $slot }} {{-- must be here to render the page content --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
