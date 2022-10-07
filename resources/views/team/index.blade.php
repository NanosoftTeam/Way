@extends('layouts.app')

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
                                {{ __('Team') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('teams.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
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
                                    @foreach ($teams as $team)
                                        <tr>
											<td>{{ $team->name }}</td>
											<td>{{ $team->description }}</td>

                                            <td>
                                                <form action="{{ route('teams.destroy',$team->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('teams.show',$team->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('teams.edit',$team->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="delete1({{ $team->id}}, '{{$team->name}}')" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $teams->links() !!}
            </div>
        </div>
    </div>
@endsection
