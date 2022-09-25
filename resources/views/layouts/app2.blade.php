<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script type="text/javascript">
        @yield('javascript2')
    </script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



    <style>
.table-sm td {
  padding-left: 10px;
}

.form-control2{
    height: 30px;
    padding: 3px;
    padding-left: 7px;
}
    </style>

    <!-- Other -->
    @yield('inhead')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-logo" href="{{ route('home') }}">
                    <!== config('app.name', 'Laravel') -->
                    <img src="{{ asset('images/icon.png') }}" alt="WayApp" style="width: 30px; height: 30px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else
                            <a class="dropdown-item text-light" href="{{ route('home') }}">Strona główna</a>
                            @can('isIT')
                                <a class="dropdown-item text-light" href="{{ route('tasks.index') }}">Zadania</a>
                                <a class="dropdown-item text-light" href="{{ route('goals.index') }}">Cele</a>
                                <a class="dropdown-item text-light" href="{{ route('tasks.index') }}">Bazy</a>
                                <a class="dropdown-item text-light" href="{{ route('calendar.index') }}">Kalendarz</a>
                                <a class="dropdown-item text-light" href="{{ route('deadlines.index') }}">Deadliney</a>
                            @endcan
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <a class="dropdown-item text-light" href="{{ route('home') }}">Wyjdź</a>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script type="text/javascript">
        @yield('javascript')
    </script>
</body>
</html>