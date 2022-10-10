@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('content')
<div class="container">
<div class="row">
    
    <div class="col-sm">
        @can('isAdmin')
            <h4>Administracja</h4>
        <p>
            
            Narzędzia dla administratorów
        </p>
        <ul class="categories">
            <li>
                
                <a href="{{ route('users.index') }}"><i class="fa-solid fa-users"></i> Użytkownicy</a>
            </li>
            <li>
                
                <a href="{{ route('settings2.edit') }}"><i class="fa-solid fa-gear"></i> Ustawienia systemu</a>
            </li>
            <li>
                
                <a href="{{ route('changes.index') }}"><i class="fa-solid fa-pen"></i> Wszystkie zmiany</a>
            </li>
            <li>
                
                <a href="{{ route('messages.files') }}"><i class="fa-solid fa-file"></i> Załączniki wiadomości</a>
            </li>
            
                
        </ul>
        <br>
        @endcan

            <h4>Więcej opcji</h4>
        <p>
            
            Dodatkowe opcje systemu
        </p>
        <ul class="categories">
            <li>
                
                <a href="{{ route('importants.index') }}"><i class="fa-solid fa-circle-exclamation"></i> Przypięcia</a>
            </li>
            <li>
                
                <a href="{{ route('clothes.index') }}"><i class="fa-solid fa-circle-exclamation"></i> Ubrania</a>
            </li>
            <li>
                
                <a href="{{ route('contacts.index') }}"><i class="fa-solid fa-address-card"></i> Kontakty</a>
            </li>
            <li>
                
                <a href="{{ route('debts.index') }}"><i class="fa-solid fa-money-bill"></i> Pożyczki</a>
            </li>
            <li>
                
                <a href="{{ route('wordlists.index') }}"><i class="fa-solid fa-file-word"></i> Listy słówek</a>
            </li>
            <li>
                
                <a href="{{ route('lessons.index') }}"><i class="fa-solid fa-file-word"></i> Lekcje</a>
            </li>
                
        </ul>
        <br>
            <h4>Podstawowe narzędzia</h4>
        <p>
            
            Nieużywane
        </p>
        <ul class="categories">
            <li>
                <a href="{{ route('messages.index') }}">Wiadomości @if(Auth::user()->unread_messages) <span class="badge badge-pill badge-danger">{{ Auth::user()->unread_messages }}</span>@endif </a>
            </li>

            <li>
                <a href="{{ route('notes.index') }}">Notatki</a>
            </li>

                
        </ul>
        <p>
            
            Wszystko co w zakładkach
        </p>
        <ul class="categories">
            <li>
                <a href="{{ route('tasks.index') }}">Zadania</a>
            </li>
            <li><a href="{{ route('goals.index') }}">Cele</a></li>
            <li><a href="{{ route('tasks.index') }}">Bazy</a></li>
            <li><a href="{{ route('calendar.index') }}">Kalendarz</a></li>
            <li><a href="{{ route('deadlines.index') }}">Deadliney</a></li>

                
        </ul>
        <br>
    
    </div>

    <div class="col-sm">
        <h4>Twoje zadania</h4>
        <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col">Nazwa</th>
                <th scope="col">Deadline</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $status  = array("Pomysł", "Do zrobienia", "W trakcie", "Testy", "Gotowe");
                    $color = array("secondary", "danger", "warning", "primary", "success");
                ?>
                @foreach($tasks as $task)
                    <tr>
                        <td><span class="badge badge-pill badge-{{ $color[$task->status] }}">{{ $status[$task->status] }}</span> <a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a></td>
                        <td><span class="badge @if(\Carbon\Carbon::parse($task->end.' 23:59:59') < date('Y-m-d H:i:s')) badge-danger @else badge-light @endif">@isset($task->end) {{ \Carbon\Carbon::parse($task->end." 23:59:59")->diffForHumans()  }} @endisset</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('tasks.index') }}?user={{ Auth::id() }}&status=a&film=a&date=a">Pokaż wszystkie</a>
    </div>

</div>
  
</div>
@endsection
