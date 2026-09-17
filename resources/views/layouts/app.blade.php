<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Portal') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1, #a855f7);
            --glass-bg: rgba(255, 255, 255, 0.85);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(168, 85, 247, 0.05) 0px, transparent 50%);
            min-height: 100vh;
        }

        /* Floating Modern Navbar */
        .navbar {
            background: var(--glass-bg) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.8rem 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: -0.5px;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.5rem;
        }

        .nav-link {
            font-weight: 600;
            color: #475569 !important;
            padding: 0.5rem 1.2rem !important;
            border-radius: 50px;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #6366f1 !important;
            background: rgba(99, 102, 241, 0.05);
        }

        /* User Dropdown Style */
        .user-dropdown-toggle {
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 5px 15px !important;
            border-radius: 50px !important;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-radius: 15px;
            padding: 10px;
            margin-top: 10px;
        }

        .dropdown-item {
            border-radius: 10px;
            padding: 8px 15px;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background-color: #f1f5f9;
            color: #6366f1;
        }

        .main-wrapper {
            padding-top: 2rem;
            padding-bottom: 4rem;
        }

        /* Footer */
        footer {
            margin-top: auto;
            color: #94a3b8;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-graduation-cap me-2"></i>{{ config('app.name', 'LMS') }}
                </a>
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard"><i class="fas fa-home me-1"></i> Dashboard</a>
                            </li>
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item ms-md-2">
                                    <a class="nav-link bg-primary text-white rounded-pill px-4" href="{{ route('register') }}">{{ __('Get Started') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link user-dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center text-white me-2" style="width: 25px; height: 25px; font-size: 0.7rem;">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down ms-2 small opacity-50"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end animate-zoom-in">
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main-wrapper">
            @yield('content')
        </main>

        <footer class="text-center py-4">
            <div class="container">
                <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>