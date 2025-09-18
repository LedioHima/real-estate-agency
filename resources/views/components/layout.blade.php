@props(['title' => 'MyApp']) {{-- default title --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    {{-- Bootstrap & Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            /* Soft gradient background */
            background: linear-gradient(135deg, #f0f8ff, #e6f2ff, #f9fcff);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1; /* Push footer to bottom */
        }

        .fancy-title {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s ease-in-out;
        }

        .fancy-title.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Footer styling */
        footer {
            background-color: #000; /* Same as navbar */
            color: #fff;
            padding: 2rem 0;
        }

        footer a {
            color: #bbb;
            text-decoration: none;
        }
        footer a:hover {
            color: #fff;
            text-decoration: underline;
        }

        footer hr {
            border-color: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-house-heart-fill text-primary"></i> Real Estate
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item"><a class="nav-link" href="{{ route('agents.index') }}">Manage Agents</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('guests.index') }}">Manage Guests</a></li>
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

    {{-- Page Content --}}
    <main class="container py-5">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer>
        <div class="container text-center text-md-start">
            <div class="row">
                {{-- Branding --}}
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold"><i class="bi bi-building"></i> Real Estate</h5>
                    <p class="small">Your trusted platform for buying, selling, and renting properties with ease.</p>
                </div>

                {{-- Quick Links --}}
                <div class="col-md-4 mb-3">
                    <h6 class="fw-bold">Quick Links</h6>
                    <ul class="list-unstyled">
                        @auth
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            @if(auth()->user()->isAdmin())
                                <li><a href="{{ route('agents.index') }}">Manage Agents</a></li>
                                <li><a href="{{ route('guests.index') }}">Manage Guests</a></li>
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
                    <h6 class="fw-bold">Contact</h6>
                    <p class="small mb-1"><i class="bi bi-envelope"></i> support@realestate.com</p>
                    <p class="small mb-1"><i class="bi bi-telephone"></i> +1 (555) 123-4567</p>
                    <div>
                        <a href="#"><i class="bi bi-facebook me-2"></i></a>
                        <a href="#"><i class="bi bi-twitter me-2"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <p class="text-center small mb-0">© {{ date('Y') }} Real Estate. All rights reserved.</p>
        </div>
    </footer>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const fancyTitle = document.querySelector(".fancy-title");
            if (fancyTitle) {
                fancyTitle.classList.add("visible");
            }
        });
    </script>
</body>
</html>
