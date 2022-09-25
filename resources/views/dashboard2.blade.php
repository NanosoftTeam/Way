@extends('layouts.app')

@section('content')
<style type="text/css">
.figure-img {
    margin: 5px;
    margin-right: 10px;
    padding: 0.75em;
}
</style>
<div class="container">

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Produktywność</h5>
        <a href="{{ route('calendar.index') }}">
            <figure class="figure" >
                <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-calendar"></i></h1>
                <figcaption class="figure-caption text-center">Kalendarz</figcaption>
            </figure>
        </a>
        
        <a href="{{ route('tasks.index') }}">
            <figure class="figure" >
                <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-list-check"></i></h1>
                <figcaption class="figure-caption text-center">Zadania</figcaption>
            </figure>
        </a>

        <a href="{{ route('deadlines.index') }}">
            <figure class="figure">
                <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-regular fa-calendar-check"></i></h1>
                <figcaption class="figure-caption text-center">Deadliney</figcaption>
            </figure>
        </a>

        <a href="{{ route('goals.index') }}">
            <figure class="figure">
                <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-trophy"></i></h1>
                <figcaption class="figure-caption text-center">Cele</figcaption>
            </figure>
        </a>

        <a href="{{ route('importants.index') }}">
            <figure class="figure">
                <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-thumbtack"></i></h1>
                <figcaption class="figure-caption text-center">Przypięcia</figcaption>
            </figure>
        </a>

        <a href="{{ route('notes.index') }}">
            <figure class="figure">
                <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-note-sticky"></i></h1>
                <figcaption class="figure-caption text-center">Notatki</figcaption>
            </figure>
        </a>
  </div>
  
</div>

<div class="card">
  <div class="card-body">
            <h5 class="card-title">Szkoła</h5>
            <a href="{{ route('wordlists.index') }}">
                <figure class="figure" >
                    <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-list"></i></h1>
                    <figcaption class="figure-caption text-center">Listy słówek</figcaption>
                </figure>
            </a>
            
            <a href="{{ route('clothes.index') }}">
                <figure class="figure" >
                    <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-table-columns"></i></h1>
                    <figcaption class="figure-caption text-center">Plan lekcji</figcaption>
                </figure>
            </a>

            <a href="{{ route('gradebook.index') }}">
                <figure class="figure" >
                    <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-5"></i></h1>
                    <figcaption class="figure-caption text-center">Oceny</figcaption>
                </figure>
            </a>
    </div>
</div>

<div class="card">
  <div class="card-body">
            <h5 class="card-title">Finanse</h5>
            <a href="{{ route('debts.index') }}">
                <figure class="figure" >
                    <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-money-bill"></i></h1>
                    <figcaption class="figure-caption text-center">Pożyczki</figcaption>
                </figure>
            </a>
            
            <a href="{{ route('clothes.index') }}">
                <figure class="figure" >
                    <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-address-book"></i></h1>
                    <figcaption class="figure-caption text-center">Osoby</figcaption>
                </figure>
            </a>
    </div>
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Administracja systemem</h5>
    <a href="{{ route('users.index') }}">
                <figure class="figure" >
                    <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-user"></i></h1>
                    <figcaption class="figure-caption text-center">Użytkownicy</figcaption>
                </figure>
            </a>
            
            <a href="{{ route('settings2.edit') }}">
                <figure class="figure" >
                    <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-gear"></i></h1>
                    <figcaption class="figure-caption text-center">Ustawienia systemu</figcaption>
                </figure>
            </a>

            <a href="{{ route('changes.index') }}">
                <figure class="figure">
                    <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-pen-to-square"></i></h1>
                    <figcaption class="figure-caption text-center">Wszystkie zmiany</figcaption>
                </figure>
            </a>

            <a href="{{ route('messages.files') }}">
                <figure class="figure">
                    <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-trophy"></i></h1>
                    <figcaption class="figure-caption text-center">Pliki/załączniki</figcaption>
                </figure>
            </a>
  </div>
  
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Nieużywane</h5>
        Moduły do przerobienia na coś innego <br />
        <a href="#">
                <figure class="figure" >
                    <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-ellipsis"></i></h1>
                    <figcaption class="figure-caption text-center">Filmy</figcaption>
                </figure>
            </a>
            
            <a href="{{ route('clothes.index') }}">
                <figure class="figure" >
                    <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-ellipsis"></i></h1>
                    <figcaption class="figure-caption text-center">Ubrania</figcaption>
                </figure>
            </a>

            <a href="{{ route('messages.index') }}">
                <figure class="figure" >
                    <h1 class="text-center display-4 figure-img img-fluid rounded bg-secondary text-light"><i class="fa-solid fa-ellipsis"></i></h1>
                    <figcaption class="figure-caption text-center">Wiadomości</figcaption>
                </figure>
            </a>
  </div>
  
</div>




  
</div>
@endsection
