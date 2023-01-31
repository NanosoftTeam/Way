@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('javascript2')
function delete1(id1, name) {
    let czy = prompt("Usunąć obiekt tak/nie? nazwa: " + name);
    if (czy == "tak") {
        
        $.ajax({
            method: "DELETE",
            url: "{{ config('app.url', 'Laravel') }}/goals/" + id1,
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
    Goal
@endsection

@section('content')
    <div class="container">
        <div class="alert alert-primary" role="alert">
            Wróć do <a href="{{ route('tasks.index2') }}" class="alert-link">widoku połączonego</a> zadań, deadlineów i celów
        </div>
        <div class="row">
            <div class="col-sm-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Goal') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('goals.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    <i class="fa-solid fa-plus"></i> Nowy
                                </a>
                              </div>
                        </div>
                    </div>
                    

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
										<th>Name</th>
										<th>Deadline</th>
										<th>Type</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($goals as $goal)
                                        <tr>
											<td>{{ $goal->name }}</td>
											<td>@if($goal->deadline_id != NULL)<a href="{{ route('deadlines.show', $goal->deadline_id) }}">{{ $goal->deadline->name ?? "[błąd]" }}</a>@endif</td>
											<td>{{ $goal->type }}</td>

                                            <td>
                                                <form action="{{ route('goals.destroy',$goal->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('goals.show',$goal->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('goals.edit',$goal->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    <button type="button" onclick="delete1({{ $goal->id}}, '{{$goal->name}}')" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $goals->links() !!}
            </div>
        </div>
    </div>
@endsection
