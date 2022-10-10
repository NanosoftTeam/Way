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
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Twoje zespoły
                            </span>

                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="alert alert-primary" role="alert">
                            Tutaj możesz przełączać się między zespołową, a prywatną przestrzenią roboczą.
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
										<th>Name</th>
										<th>Description</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr class="@if($actual_team == 0) table-success @endif">
											<td>@if($actual_team == 0) <span class="badge badge-success">Aktualna przestrzeń robocza</span> @endif WayApp Personal</td>
											<td></td>

                                            <td>
                                                @if($actual_team != 0) <a class="btn btn-sm btn-primary " href="{{ route('team.exit') }}"><i class="fa-solid fa-arrow-right"></i> Wejdź</a>@endif
                                            </td>
                                        </tr>
                                        <tr class="@if($actual_team != 0) table-success @endif">
											<td>@if($actual_team != 0) <span class="badge badge-success">Aktualna przestrzeń robocza</span> @endif {{ $team->name }}</td>
											<td>{{ $team->description }}</td>

                                            <td>
                                                @if($actual_team == 0)<a class="btn btn-sm btn-primary " href="{{ route('team.enter') }}"><i class="fa-solid fa-arrow-right"></i> Wejdź</a> @endif
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
