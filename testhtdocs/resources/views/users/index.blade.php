@extends('layouts.app')

@section('content')

<?php
$role = array("Zablokowany", "Tylko wyświetlanie (niedostępne)", "Infast Team", "Infast Team+", "Admin");
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <b>Użytkownicy</b> | 
            <a href="{{ route('users.create') }}"><button type="button" data-toggle="modal" data-target="#add_user" class="btn btn-primary btn-sm pull-right"><i class="fa-solid fa-plus"></i> Nowy</button>
            <a data-toggle="collapse" href="#collapse-application" role="button" aria-expanded="false" aria-controls="collapse-application"><i class="fa-solid fa-filter"></i> Filtry</a>
        </div>
        <div class="card-header collapse multi-collapse" id="collapse-application"><i>chwilowo brak filtrów</i></div>

        <div class="card-body">
            
                    <section class="users">
                        <?php
                            $status  = array("Pomysł", "Do zrealizowania", "Plan", "Scenariusz", "Nagrywanie", "Montaż", "Koniec");
                        ?>

                        <div id="load" style="position: relative;">
                        <table class="table table-sm table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>    
                                    <th scope="col">Nazwa</th>
                                    <th scope="col">Rola</th>
                                    <th scope="col" style="width:10px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr style="">
                                            <td class="show2">{{ $user->id }}</td>
                                            <td class="show2"><a href="{{ route('users.show', $user->id) }}"><i class="fa-solid fa-user"></i> {{ $user->name }}</a></td>
                                            <td class="show2"><i class="fa-solid fa-user-group"></i> {{ $role[$user->role] }}</td>
                                            <td>
                                            <div class="btn-group">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{ route('users.show', $user->id) }}" class="dropdown-item"><i class="fa-solid fa-eye"></i> Zobacz</a>
                                                    <a href="{{ route('users.edit', $user->id) }}" class="dropdown-item"><i class="fa-solid fa-user-pen"></i> Edytuj</a>
                                                    <a href="" class="dropdown-item delete" data-id="{{ $user->id }}" data-name="{{ $user->name }}"><i class="fa-solid fa-trash"></i> Usuń</a>
                                                </div>
                                            </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>



                        </div>
                        {{ $users->links() }}
                    </section>
        </div>
    </div>
    
</div>
        
@endsection
@section('javascript')
$( document ).ready(function() {
        $('.delete').click(function(){
            let czy = prompt("Czy na pewno chcesz usunąć użytkownika tak/nie? nazwa: " + $(this).data("name"));

            if (czy == "tak") {
                $.ajax({
                    method: "GET",
                    url: "{{ config('app.url', 'Laravel') }}/users/d/" + $(this).data("id"),
                data: { id: $(this).data("id")}
                })
                .done(function( msg ) {
                    window.location.reload();
                })
                .fail(function( msg ) {
                    alert("error");
                });
            }

            
        })
    });
@endsection