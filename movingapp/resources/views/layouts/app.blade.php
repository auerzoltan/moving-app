// resources/views/layouts/app.blade.php
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Költözési Segéd</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style>
        .progress-bar-danger {
            background-color: #dc3545;
        }
        .box-container {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        .box-container:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .object-item {
            border-left: 3px solid #007bff;
            padding-left: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-box-open"></i> {{ config('app.name', 'Laravel') }} - Költözési Segéd
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Bal oldali menü -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('boxes.index') }}"><i class="fas fa-boxes"></i> Dobozok</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('objects.index') }}"><i class="fas fa-cubes"></i> Tárgyak</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('search.index') }}"><i class="fas fa-search"></i> Keresés</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('statistics.index') }}"><i class="fas fa-chart-bar"></i> Statisztika</a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Jobb oldali menü -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Hitelesítési linkek -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Bejelentkezés') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Regisztráció') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Kijelentkezés') }}
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

        <main class="py-4">
            <div class="container">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('warning') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
        
        <footer class="bg-light py-3 mt-5">
            <div class="container text-center">
                <p class="mb-0">Költözési Segéd &copy; {{ date('Y') }}</p>
            </div>
        </footer>
    </div>
</body>
</html>