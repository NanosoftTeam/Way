@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

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
                        <span class="card-title">Pożyczki - {{ $contact->name }} - <a href="{{ route('contacts.show', $contact->id) }}">TRYB EKSPORTOWY [wyjdź]</a></span>
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

                        <b class="text-danger">TRYB EKSPORTOWY!</b>
                        

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
                                Pożyczki NIEOPŁACONE
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <p style="font-size: 15px;">Saldo: <b style="font-size: 20px;" class="@if($debts_all_sum * -1 > 0) text-success @else text-danger @endif">{{ $debts_all_sum * -1 }}</b> (Z PUNKTU WIDZENIA {{ $contact->name }})</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Amount</th>
										<th>Name</th>
										<th>Contact Id</th>
										<th>Date</th>
										<th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($debts as $debt)
                                        <tr>
                                            <td style="font-size: 16px;" class="@if($debt->amount * -1 > 0) text-success @else text-danger @endif"><b>{{ $debt->amount * -1 }}</b></td>
											<td>{{ $debt->name }}</td>
											<td><a href="{{route('contacts.show', $debt->contact_id)}}">{{ $debt->contact->name }}</a></td>
											<td>{{ $debt->date }}</td>
											<td><span class="badge badge-pill badge-{{ $color[$debt->status] }}">{{ $status[$debt->status] }}</span></td>
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
