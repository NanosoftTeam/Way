<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Brak uprawnień!</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container mt-5 pt-5">
        <div class="alert alert-danger text-center">
            <h2 class="display-3">403</h2>
            <p class="display-5">Brak uprawnień do tej strony lub jesteś zablokowany. Skontaktuj się z administracją.</p><br />
            <a href="{{ route('home') }}" class="display-5">Dashboard</a> | <a href="#" class="display-5" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                Wyloguj się</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</body>

</html>