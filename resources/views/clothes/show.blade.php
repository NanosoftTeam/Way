@extends('layouts.app')

@section('template_title')
    {{ $clothes->name ?? 'Show Clothes' }}
@endsection

@section('content')
<?php
$status  = array("Na miejscu", "Na sobie", "Spakowane", "W praniu", "Oczekuje na położenie na miejscu", "Zaginione", "Oddane", "Inny");
$color = array("success", "success", "success", "primary", "warning", "danger", "secondary", "primary");

?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('clothes.index') }}">Ubrania</a> > {{ $clothes->id }}
                    </div>

                    <div class="card-body">
                    <table class="table table-sm" id="table-film-info">

                    <thead>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="name">ID</td>
                            <td>{{ $clothes->id }}</td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="type">Typ</td>
                            <td>{{ $clothes->type }}</td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="description">Podtyp</td>
                            <td>{{ $clothes->subtype }}</td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="url">Status</td>
                            <td><span class="badge badge-pill badge-{{ $color[$clothes->status] }}">{{ $status[$clothes->status] }}</span> (Ostatnia zmiana {{ $clothes->last_status_changed." (".\Carbon\Carbon::parse($clothes->last_status_changed)->diffForHumans().")" }})</td>
                        </tr> 
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="url">Miejsce</td>
                            <td>{{ $clothes->place }}</td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="url">Notatki</td>
                            <td>{{ $clothes->notes }}</td>
                        </tr> 
                    </tbody>
                    </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
