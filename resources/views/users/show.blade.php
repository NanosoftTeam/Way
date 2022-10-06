@extends('layouts.app')

@section('content')
<?php
$status  = array("Pomysł", "Do zrealizowania", "Plan", "Scenariusz", "Nagrywanie", "Montaż", "Koniec");
$channel  = array("Infast", "Infast Animations");
$type  = array("Film", "Odcinek kursu", "Short");
$course  = array("Kurs 1", "Kurs 2", "Kurs3");
$person = array("User", "Jan Kowalski", "Jan Malinowski");
$role = array("Zablokowany", "Tylko wyświetlanie (niedostępne)", "User zwykły (niedostępne)", "User", "Admin");
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{ route('users.index') }}">Użytkownicy</a> > {{ $user->name }} <a href="{{ route('users.edit', $user->id) }}">
                    <button class="btn btn-primary btn-sm">Edytuj</button></a></div>

                <div class="card-body">
                    <ul class="list-group full-width">
                        <li class="list-group-item">Nazwa: <b>{{ $user->name }}</b></li>
                        <li class="list-group-item">E-mail: <b>{{ $user->email }}</b></li>
                        <li class="list-group-item">Rola: <b>{{ $role[$user->role] }}</b></li>
                        <li class="list-group-item">ID: <b>{{ $user->id }}</b></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
