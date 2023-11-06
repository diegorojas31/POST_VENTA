<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">

    <!-- Bootstrap Dropify CSS -->
    <link href="{{ asset('Template/vendors/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- select2 CSS -->
    <link href="{{ asset('Template/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- CSS -->
    <link href="{{ asset('Template/dist/css/style.css') }}" rel="stylesheet" type="text/css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
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
                        <li class="nav-item dropdown" id="userDropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                        
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); logout();">
                                    {{ __('Cerrar') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <script>
                            function logout() {
                                document.getElementById('logout-form').submit();
                            }
                        
                            document.getElementById('userDropdown').addEventListener('click', function(event) {
                                event.stopPropagation();
                                let dropdownMenu = this.querySelector('.dropdown-menu');
                                dropdownMenu.style.display = (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') ? 'block' : 'none';
                            });
                        
                            document.addEventListener('click', function() {
                                let dropdownMenu = document.querySelector('.dropdown-menu');
                                dropdownMenu.style.display = 'none';
                            });
                        </script>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('Template/vendors/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('Template/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- FeatherIcons JS -->
    <script src="{{ asset('Template/dist/js/feather.min.js') }}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{ asset('Template/dist/js/dropdown-bootstrap-extended.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('Template/vendors/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Select2 JS -->
    <script src="{{ asset('Template/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="dist/js/select2-data.js"></script>

    <!-- Dropify JS -->
    <script src="{{ asset('Template/vendors/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('Template/dist/js/dropify-data.js') }}"></script>

    <!-- Init JS -->
    <script src="{{ asset('Template/dist/js/init.js') }}"></script>
    <script src="{{ asset('Template/dist/js/contact-data.js') }}"></script>
    <script src="{{ asset('Template/dist/js/chips-init.js') }}"></script>
</body>

</html>
