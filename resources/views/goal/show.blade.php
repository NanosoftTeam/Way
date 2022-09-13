@extends('layouts.app')

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
            window.location.href = "{{ route('goals.index') }}";
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection

@section('template_title')
    {{ $goal->name ?? 'Show Goal' }}
@endsection

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                        <span class="card-title"><a href="{{ route('goals.index') }}">Cele</a> > {{ $goal->name }}
                            <a class="btn btn-sm btn-success" href="{{ route('goals.edit',$goal->id) }}" style="margin-left: 5px;"><i class="fa fa-fw fa-edit"></i> Edit</a>
                            <button type="button" onclick="delete1({{ $goal->id}}, '{{$goal->name}}')" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                        </span>
                    </div>

                    <div class="card-body">
                        
                    <table class="table table-sm" id="table-film-info">

                        <thead>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Name</td>
                                <td id="t-name"><b>{{ $goal->name }}</b></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%">Opis</td>
                                <td >{!!nl2br($goal->description)!!}</td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Deadline</td>
                                <td id="t-name">@if(isset($goal->deadline_id))<b><a href="{{ route('deadlines.show', $goal->deadline_id) }}">{{ $goal->deadline->name ?? "[błąd]" }}</a></b>@endif</td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Type</td>
                                <td id="t-name"><b>{{ $goal->type }}</b></td>
                            </tr>
                            
                        </tbody>
                        </table>
                        Priotytet: {{ $goal->priority }}
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
