<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Scripts -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/superhero.min.css') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('cooladmin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet"/>
    <style>
        .stretched-link::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1;
            pointer-events: auto;
            content: "";
            background-color: rgba(0, 0, 0, 0);
        }

        .center-cropped {
            object-fit: cover;
            object-position: center;
            height: 400px;
            width: 100%;
        }

        body {
            padding-bottom: 150px;
        }

        .hand:hover {
            cursor: pointer;
        }
    </style>
</head>
<body>
<div id="app">
    {{--    <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm">--}}
    {{--        <div class="container">--}}
    {{--            <a class="navbar-brand" href="{{ url('/') }}">--}}
    {{--                <img src="{{ asset('logo.png') }}" alt="Bebras logo" height="40">--}}
    {{--            </a>--}}
    {{--            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"--}}
    {{--                    aria-controls="navbarSupportedContent" aria-expanded="false"--}}
    {{--                    aria-label="{{ __('Toggle navigation') }}">--}}
    {{--                <span class="navbar-toggler-icon"></span>--}}
    {{--            </button>--}}

    {{--            <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
    {{--                <!-- Left Side Of Navbar -->--}}
    {{--                <ul class="navbar-nav mr-auto">--}}
    {{--                    <form class="form-inline my-2 my-lg-2">--}}
    {{--                        <div class="input-group mb-3">--}}
    {{--                            <input type="text" class="form-control" placeholder=""--}}
    {{--                                   aria-label="Example text with button addon" aria-describedby="button-addon1">--}}
    {{--                            <div class="input-group-append">--}}
    {{--                                <button class="btn btn-outline-secondary" type="button" id="button-addon1"><span class="fa fa-search"></span>--}}
    {{--                                </button>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </form>--}}
    {{--                </ul>--}}

    {{--                <!-- Right Side Of Navbar -->--}}
    {{--                <ul class="navbar-nav ml-auto">--}}
    {{--                    <!-- Authentication Links -->--}}
    {{--                    <li class="nav-item dropdown">--}}
    {{--                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"--}}
    {{--                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
    {{--                            Username <span class="caret"></span>--}}
    {{--                        </a>--}}

    {{--                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
    {{--                            <a class="dropdown-item" href="{{ route('logout') }}"--}}
    {{--                               onclick="event.preventDefault();--}}
    {{--                                                     document.getElementById('logout-form').submit();">--}}
    {{--                                {{ __('Logout') }}--}}
    {{--                            </a>--}}

    {{--                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
    {{--                                @csrf--}}
    {{--                            </form>--}}
    {{--                        </div>--}}
    {{--                    </li>--}}
    {{--                </ul>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </nav>--}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('auth.home') }}"><img src="{{ asset('logo.png') }}"
                                                                         alt="Bebras logo"
                                                                         height="40"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
                    aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor02">
                {{--                left side of navbar--}}
                <ul class="navbar-nav mr-auto">
                    @if(Auth::check())
                        <li class="nav-item {{ Request::route()->getName() == 'auth.home'? 'active':'' }}">
                            <a class="nav-link" href="{{ route('auth.home') }}">Home <span
                                        class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown {{ Request::route()->getName() == 'auth.profile.index'? 'active':'' }}">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->profile->name?:Auth::user()->username }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('auth.profile.index') }}">Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Keluar') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
                {{--                end of left side navbar--}}
                @if(Auth::check())
                    <form class="form-inline my-2 my-lg-0">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Cari modul">
                        </div>
                    </form>
                @endif
                @guest
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</div>
<script src="{{ asset('cooladmin/vendor/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/lozad.min.js') }}"></script>
<script>
    let happies = ["🤩", "🥳", "🤗", "😊", "😍", "😍", "😎"];
    let sads = ["🥺", "😫", "😩", "😔", "😣", "😖"]
    $(document).ready(function () {
        let observer = lozad()
        observer.observe()
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@yield('js')
</body>
</html>
