@props(['title' => 'MyApp']) {{-- default title --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} | Real Estate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* full height */
        }
        main {
            flex: 1; /* pushes footer to bottom */
        }
        footer {
            background: #212529;
            color: #adb5bd;
            padding: 20px 0;
        }
        footer a {
            color: #adb5bd;
            text-decoration: none;
        }
        footer a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-building"></i> Real Estate
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="bi bi-house-door-fill"></i> Dashboard
                            </a>
                        </li>


                        <!-- Manage Agents (Admin Only) -->
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('agents.index') }}">
                                    <i class="bi bi-people-fill"></i> Manage Agents
                                </a>
                            </li>
                        @endif

                        <!-- Manage Properties (Agent Only) -->
                        @if(auth()->user()->isAgent())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('properties.index') }}">
                                    <i class="bi bi-house-door-fill"></i> Manage Properties
                                </a>
                            </li>
                        @endif

                        <!-- Favorites (Guest User Only) -->
                        @if(auth()->user()->isGuestUser())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('favorites.index') }}">
                                    <i class="bi bi-heart-fill text-danger"></i> Favorites
                                </a>
                            </li>
                        @endif

                        <!-- Profile -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}">
                                <i class="bi bi-person-circle"></i> Profile
                            </a>
                        </li>

                        <!-- Logout -->
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <!-- Guest: Login & Register -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.form') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.form') }}">
                                <i class="bi bi-pencil-square"></i> Register
                            </a>
                        </li>
                    @endauth
                </ul>

            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="container my-4">
        {{ $slot }} {{-- must be here to render the page content --}}
    </main>

    {{-- Footer --}}
<footer>
    <div class="container text-center text-md-start">
        <div class="row">
            {{-- Branding --}}
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold text-white"><i class="bi bi-building"></i> Real Estate</h5>
                <p class="small">Your trusted platform for buying, selling, and renting properties with ease.</p>
            </div>

            {{-- Quick Links (Dynamic based on navbar) --}}
            <div class="col-md-4 mb-3">
                <h6 class="text-white">Quick Links</h6>
                <ul class="list-unstyled">

                    @auth
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>

                        @if(auth()->user()->isAdmin())
                            <li><a href="{{ route('agents.index') }}">Manage Agents</a></li>
                        @endif

                        @if(auth()->user()->isAgent())
                            <li><a href="{{ route('properties.index') }}">Manage Properties</a></li>
                        @endif

                        @if(auth()->user()->isGuestUser())
                            <li><a href="{{ route('favorites.index') }}">Favorites</a></li>
                        @endif

                        <li><a href="{{ route('profile') }}">Profile</a></li>
                        
                    @else
                        <li><a href="{{ route('login.form') }}">Login</a></li>
                        <li><a href="{{ route('register.form') }}">Register</a></li>
                    @endauth
                </ul>
            </div>

            {{-- Contact --}}
            <div class="col-md-4 mb-3">
                <h6 class="text-white">Contact</h6>
                <p class="small mb-1"><i class="bi bi-envelope"></i> support@realestate.com</p>
                <p class="small mb-1"><i class="bi bi-telephone"></i> +1 (555) 123-4567</p>
                <div>
                    <a href="#"><i class="bi bi-facebook me-2"></i></a>
                    <a href="#"><i class="bi bi-twitter me-2"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
        <hr class="border-secondary">
        <p class="text-center small mb-0">© {{ date('Y') }} Real Estate. All rights reserved.</p>
    </div>
</footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
