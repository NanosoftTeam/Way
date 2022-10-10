@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('javascript2')
function delete1(id1, name) {
    let czy = prompt("Usunąć pożyczkę tak/nie? nazwa: " + name);
    if (czy == "tak") {
        
        $.ajax({
            method: "DELETE",
            url: "{{ config('app.url', 'Laravel') }}/debts/" + id1,
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
    Debt
@endsection

@section('content')
<?php
$status  = array("Oczekuje", "Opłacony", "Inne");
$color = array("warning", "success", "primary");

?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Pożyczki WSZYSTKIE <a href="{{ route('debts.index') }}"><- Nieopłacone</a>
                            </span>

                             <div class="float-right">
                                <a href="{{ route('debts.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>Amount</th>
										<th>Name</th>
										<th>Contact Id</th>
										<th>Date</th>
										<th>Status</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($debts as $debt)
                                        <tr>
                                            <td style="font-size: 16px;" class="@if($debt->amount > 0) text-success @else text-danger @endif"><b>{{ $debt->amount }}</b></td>
											<td>{{ $debt->name }}</td>
											<td><a href="{{route('contacts.show', $debt->contact_id)}}">{{ $debt->contact->name }}</a></td>
											<td>{{ $debt->date }}</td>
											<td><span class="badge badge-pill badge-{{ $color[$debt->status] }}">{{ $status[$debt->status] }}</span></td>

                                            <td>
                                                <form action="{{ route('debts.destroy',$debt->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('debts.show',$debt->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('debts.edit',$debt->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    <button type="button" onclick="delete1({{ $debt->id}}, '{{$debt->name}}')" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $debts->links() !!}
            </div>
        </div>
    </div>
@endsection
