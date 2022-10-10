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
            window.location.href = "{{ route('debts.index') }}";
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection

@section('template_title')
    {{ $debt->name ?? 'Show Debt' }}
@endsection

@section('content')
<?php
$status  = array("Oczekuje", "Opłacony", "Inne");
$color = array("warning", "success", "primary");

?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('debts.index') }}">Pożyczki</a> > {{ $debt->name }}
                            <a class="btn btn-sm btn-success" href="{{ route('debts.edit',$debt->id) }}" style="margin-left: 5px;"><i class="fa fa-fw fa-edit"></i> Edit</a>
                            <button type="button" onclick="delete1({{ $debt->id}}, '{{$debt->name}}')" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                        </span>
                    </div>

                    <div class="card-body">

                        <table class="table table-sm" id="table-film-info">

                        <thead>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Nazwa</td>
                                <td id="t-name"><b>{{ $debt->name }}</b></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Osoba</td>
                                <td id="t-name"><b><a href="{{route('contacts.show', $debt->contact_id)}}">{{ $debt->contact->name }}</a></b></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Kwota</td>
                                <td id="t-name"><b>{{ $debt->amount }}</b></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Data</td>
                                <td id="t-name"><b>{{ $debt->date }}</b></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Status</td>
                                <td id="t-name"><span class="badge badge-pill badge-{{ $color[$debt->status] }}">{{ $status[$debt->status] }}</span></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Opis</td>
                                <td id="t-name"><b>{{ $debt->description }}</b></td>
                            </tr>
                            
                        </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
