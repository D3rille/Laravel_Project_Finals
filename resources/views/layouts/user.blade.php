<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
        * {
            font-family: 'Poppins', sans-serif;
        }
        .bg-custom {
            background-color: #2E603A;
            color: #fff;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-nav .nav-link:hover {
            color: white;
        }

        #app {
            background-color: '#F6F6F6';
        }
        .navbar {
            background-color: #2E603A;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 10px;
        }

        .navbar-toggler-icon {
            background-color: #fff;
        }

        .nav-link {
            color: #fff;
        }

        .nav-link:hover {
            color: #286652;
            border-radius: 10px;
        }

        .sidebar {
            background-color: #F6F6F6;
            color: #286652;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: start;
            height: 100vh;
        }

        .sidebar-container {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 120%;
            height: 100%;
        }

        .nav-link {
            color: #286652;
            transition: background-color 0.3s;
            text-align: center;
            padding: 10px 0;
        }

        .nav-link:hover {
            background-color: #286652;
            color: white;
        }

        .nav-link i {
            margin-right: 8px;
        }
    </style>
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-dark navbar-expand-md bg-custom">
            <div class="container">
                <img src="{{ asset('./img/logo-only.png') }}" alt="Logo" width="60px">
                <a class="navbar-brand" href="{{ url('/') }}">
                    CropWatch
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <div class="row">
            <div class="col-2 sidebar">
                <div class="p-4 sidebar-container">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-left" href="{{ route('salesTracker') }}">
                                <i class="fas fa-chart-line"></i> Crop Sales Tracker
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-left" href="{{ route('salesStatistics') }}">
                                <i class="fas fa-chart-bar"></i> Crop Sales Statistics
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <main class="py-4 col-10">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
