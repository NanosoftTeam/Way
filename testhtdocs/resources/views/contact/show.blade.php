@extends('layouts.app')

@section('javascript2')
function delete1(id1, name) {
    let czy = prompt("Usunąć kontakt tak/nie? nazwa: " + name);
    if (czy == "tak") {
        
        $.ajax({
            method: "DELETE",
            url: "{{ config('app.url', 'Laravel') }}/contacts/" + id1,
            data: { id: id1}
        })
        .done(function( msg ) {
            window.location.href = "{{ route('contacts.index') }}";
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection

@section('template_title')
    {{ $contact->name ?? 'Show Contact' }}
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
                        <span class="card-title"><a href="{{ route('contacts.index') }}">Kontakty</a> > {{ $contact->name }}
                            <a class="btn btn-sm btn-success" href="{{ route('contacts.edit',$contact->id) }}" style="margin-left: 5px;"><i class="fa fa-fw fa-edit"></i> Edit</a>
                            <button type="button" onclick="delete1({{ $contact->id}}, '{{$contact->name}}')" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                        </span>
                    </div>

                    <div class="card-body">
                    <table class="table table-sm" id="table-film-info">

                        <thead>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="type">Imię</td>
                                <td>{{ $contact->name }}</td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="type">Nazwisko</td>
                                <td>{{ $contact->surname }}</td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="type">E-mail</td>
                                <td>{{ $contact->email }}</td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="type">Telefon</td>
                                <td>{{ $contact->phone }}</td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="type">Nr konta</td>
                                <td>{{ $contact->account }}</td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="type">Opis</td>
                                <td>{{ $contact->description }}</td>
                            </tr>
                        </tbody>
                        </table>
                        

                    </div>
                </div>

                
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Pożyczki NIEOPŁACONE | <a href="{{ route('contacts.show2', $contact->id) }}">Wszystkie pożyczki tego użytkownika</a> | <a href="{{ route('debts.index') }}">Wszystkie pożyczki</a> | <a href="{{ route('contacts.show3', $contact->id)}}">Tryb eksportu</a>
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <p style="font-size: 15px;">Saldo: <b style="font-size: 20px;" class="@if($debts_all_sum > 0) text-success @else text-danger @endif">{{ $debts_all_sum }}</b></p>
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

                
            </div>
        </div>

        
</div>
@endsection
