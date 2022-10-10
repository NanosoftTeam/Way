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
            url: "{{ config('app.url', 'Laravel') }}/deadlines/" + id1,
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
    Deadline
@endsection

@section('content')
    <div class="container">
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
                                {{ __('Deadline') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('deadlines.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th></th>
										<th>Nazwa</th>
										<th>Typ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $colors = array("table-danger", "table-info", "table-warning", "table-success", "table-secondary");
                                    ?>
                                    @foreach ($deadlines as $deadline)
                                        <?php
                                            $weekMap = [
                                                0 => 'Niedz',
                                                1 => 'Pon',
                                                2 => 'Wt',
                                                3 => 'Śr',
                                                4 => 'Cz',
                                                5 => 'Pt',
                                                6 => 'Sob',
                                            ];
                                            $dayOfTheWeek = \Carbon\Carbon::parse($deadline->date)->dayOfWeek;
                                            $weekday = $weekMap[$dayOfTheWeek];
                                        ?>
                                        <tr class="{{ $colors[$deadline->priority] }}">
                                            <td><b>{{ $weekday }}</b> {{ $deadline->date }} <p class="font-italic text-secondary">{{ \Carbon\Carbon::parse($deadline->date." 23:59:59")->diffForHumans()  }}</p></td>
											<td>@if($deadline->is_planned == 0) ❌ @endif {{ $deadline->name }}</td>
											<td>{{ $deadline->type }}</td>

                                            <td>
                                                <form action="{{ route('deadlines.destroy',$deadline->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('deadlines.show',$deadline->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('deadlines.edit',$deadline->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    <button type="button" onclick="delete1({{ $deadline->id}}, '{{$deadline->name}}')" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $deadlines->links() !!}
            </div>
        </div>
    </div>
@endsection
