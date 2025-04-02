<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Open Graph meta tags -->
    <meta property="og:title" content="{{ $settings->site_name }}">
    <meta property="og:description" content="{{ $settings->site_tagline }}">
    <meta property="og:image" content="{{ asset("uploads/logos/$settings->og_image") }}">

    <title>{{ $settings->site_name }} | {{ $settings->site_tagline }}</title>
    <link rel="icon" href="{{ asset("uploads/logos/$settings->favicon") }}" type="image/png" />
    <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/font-awsome-6.2.1-pro/css/all.css') }}" rel="stylesheet">
    <style>
        :root {
            --rh-primary-color: {{ $settings->site_primary_color }};
            --rh-accent-color: {{ $settings->site_accent_color }};
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .main-content {
            flex: 1 0 auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .main-content-wrapper {
            justify-content: center;
            min-width: 100%;
        }

        footer {
            flex-shrink: 0;
            padding: 1.5rem 0;
        }

        .brand-color {
            background-color: var(--rh-primary-color) !important;
            color: white !important;
        }

        .brand-btn {
            background-color: var(--rh-primary-color) !important;
            border-color: var(--rh-primary-color) !important;
            color: #fff;
            transition: all 0.3s ease;
        }

        .brand-btn:hover {
            background-color: var(--rh-accent-color) !important;
            border-color: var(--rh-accent-color) !important;
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .navbar-nav {
            gap: 5px;
        }

        .navbar-brand {
            font-weight: 600;
        }

        .nav-logo {
            width: 100%;
            height: 50px;
            object-fit: contain;
        }

        .nav-link {
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            color: var(--rh-primary-color) !important;
        }

        .auth-btn {
            border-radius: 20px;
            padding: 0.375rem 1.25rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .card {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .limited-text {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            word-break: break-word;
        }
    </style>
    @stack('styles')
</head>

<body class="d-flex flex-column h-100">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img class="nav-logo" src="{{ asset("uploads/logos/$settings->logo") }}"
                    alt="{{ $settings->site_name }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @guest
                        <li class="nav-item">
                            <a class="btn btn-outline-secondary auth-btn" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn brand-btn auth-btn" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-regular fa-user me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('dashboard.index') }}">
                                        <i class="fa-regular fa-gauge-high me-1"></i> Dashboard</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa-regular fa-arrow-right-from-bracket me-1"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container main-content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="text-center text-muted mt-auto py-3">
        <div class="container">
            <p class="mb-0">{{ $settings->site_name }} &copy; {{ date('Y') }} | All Rights Reserved</p>
        </div>
    </footer>

    <script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/clipboard.js/clipboard.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
