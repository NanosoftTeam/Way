@extends('layouts.app3')

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
            window.location.href = "{{ route('teams.index') }}";
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
    alert(<?php \Illuminate\Support\Facades\Session::get("team_id") ?>);
@endsection

@section('template_title')
    {{ $team->name ?? 'Show Team' }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('teams.index') }}">Teamy</a> > {{ $team->name }}
                            <a class="btn btn-sm btn-success" href="{{ route('teams.edit',$team->id) }}" style="margin-left: 5px;"><i class="fa fa-fw fa-edit"></i> Edit</a>
                            <button type="button" onclick="delete1({{ $team->id}}, '{{$team->name}}')" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                        </span>
                    </div>

                    <div class="card-body">

                    <table class="table table-sm" id="table-film-info">

                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="name">Nazwa</td>
                            <td id="t-name">{{ $team->name }}</td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="type">Opis</td>
                            <td id="t-type">{{ $team->description }}</td>
                        </tr>
                    </tbody>
                    </table>

                    <h4>Skład</h4>
                    <table class="table table-sm table-hover">
                        <thead>
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col" style="width:10px"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($team->users as $user)
                                <tr style="">
                                    <td class="show2"><i class="fa-solid fa-user"></i> {{ $user->name }}</td>
                                    <td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
