@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('javascript2')
function delete1(id1, name) {
    let czy = prompt("Usunąć team tak/nie? nazwa: " + name);
    if (czy == "tak") {

        $.ajax({
            method: "DELETE",
            url: "{{ config('app.url', 'Laravel') }}/teams/" + id1,
        data: { id: id1}
        })
        .done(function( msg ) {
            window.location.reload();

        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection

@section('template_title')
    Team
@endsection

@section('content')
    <div class="container">
        <div class="alert alert-primary" role="alert">
            Tutaj możesz przełączać się między zespołową, a prywatną przestrzenią roboczą.
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="list-group">
                    <li class="list-group-item disabled">Twoje zespoły:</li>
                    <a href="{{ route('team.exit') }}" class="list-group-item list-group-item-action flex-column align-items-start @if($actual_team == 0) active @endif">
                        <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">WayApp Personal</h5>
                        <small>@if($actual_team == 0)<b>Aktualna przestrzeń robocza</b>@endif</small>
                        </div>
                        <p class="mb-1">Twoja prywatna przestrzeń robocza</p>
                    </a>
                    @if(Auth::user()->team_id != NULL)
                        <a href="{{ route('team.enter') }}" class="list-group-item list-group-item-action flex-column align-items-start @if($actual_team != 0) active @endif">
                            <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $team->name }}</h5>
                            <small>@if($actual_team != 0) <b>Aktualna przestrzeń robocza</b> @endif</small>
                            </div>
                            <p class="mb-1">{{ $team->description }}</p>
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-sm  align-self-center text-center">
                <button type="button" class="btn btn-primary"><a class="text-dark" href="{{ route('teams.index') }}"><i class="fa-solid fa-pen"></i> Twórz i zarządzaj zespołami</a></button>
            </div>
        </div>
    </div>
@endsection
