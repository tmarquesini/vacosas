<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.mask.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">Entrar</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">Cadastre-se</a></li>
                        @else
                            <li><a class="btn @if(Route::is("vacosas.create")) btn-secondary @else btn-light @endif" style="margin-right: 10px" href="{{ route('vacosas.create') }}"><i class="fa fa-plus"></i> Iniciar uma vacosa</a></li>
                            <li><a class="btn @if(Route::is("vacosas.index")) btn-secondary @else btn-light @endif"  style="margin-right: 10px" href="{{ route('vacosas.index') }}"><i class="fa fa-money-bill-alt"></i> Vacosas</a></li>
                            <li><a class="btn @if(Route::is("users.*")) btn-secondary @else btn-light @endif" href="{{ route('users.index') }}"><i class="fa fa-users"></i> Usuários</a></li>
                            <li>
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out-alt"></i> Sair
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
@stack("scripts")
</body>
</html>
