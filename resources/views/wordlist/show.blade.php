@extends('layouts.app')

@section('javascript2')
function delete1(id1, name) {
    let czy = prompt("Usunąć pożyczkę tak/nie? nazwa: " + name);
    if (czy == "tak") {
        
        $.ajax({
            method: "DELETE",
            url: "{{ config('app.url', 'Laravel') }}/wordlists/" + id1,
        data: { id: id1}
        })
        .done(function( msg ) {
            window.location.href = "{{ route('wordlists.index') }}";
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection

@section('template_title')
    {{ $wordlist->name ?? 'Show Wordlist' }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                        <span class="card-title"><a href="{{ route('wordlists.index') }}">Listy słówek</a> > {{ $wordlist->name }}
                            <a class="btn btn-sm btn-success" href="{{ route('wordlists.edit',$wordlist->id) }}" style="margin-left: 5px;"><i class="fa fa-fw fa-edit"></i> Edit</a>
                            <button type="button" onclick="delete1({{ $wordlist->id}}, '{{$wordlist->name}}')" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                        </span>
                    </div>

                    <div class="card-body">
                        
                    <table class="table table-sm" id="table-film-info">

                    <thead>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="name">Nazwa</td>
                            <td id="t-name">{{ $wordlist->name }}</td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="type">Opis</td>
                            <td id="t-type">{{ $wordlist->description }}</td>
                        </tr>
                    </tbody>
                    </table>

                    </div>
                </div>
                <br />
                <div class="card">
                <div class="card-header">
                        Słowa z listy <a class="btn btn-primary btn-sm float-right" style="margin-left: 3px;" href="{{ route('words.create', $wordlist->id) }}">Nowe słowo</a>
                        <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#expor">Importuj</button>
                        <a class="btn btn-success btn-sm float-right" style="margin-right: 3px;" href="{{ route('wordlists.export', $wordlist->id) }}">Eksportuj</a>
                    </div>

                    <div class="card-body">
                        

                    <h3>Słowa z listy</h3>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                <th scope="col">Słowo</th>
                                <th scope="col">PL</th>
                                <th scope="col">Info - nazwa</th>
                                <th scope="col">PL - info</th>
                                <th scope="col">Tagi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wordlist->words as $word)
                                <tr id="w{{ $word->id }}">
                                    <th><a href="{{ route('words.edit', $word->id) }}">{{ $word->name }}</a></th>
                                    <td>{{ $word->translation }}</td>
                                    <td>{{ $word->name_info }}</td>
                                    <td>{{ $word->translation_info }}</td>
                                    <td>@if($word->mw) <span class="badge badge-success">Multisłowo</span> @endif @if($word->iw) <span class="badge badge-primary">Odmiana</span> @endif @if($word->mt) <span class="badge badge-secondary">Multitłumaczenia</span> @endif</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="expor" tabindex="-2" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="overflow-y: auto !important;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Film</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('wordlists.import', $wordlist->id) }}">
                    <textarea class="form-control" name="import" rows="15"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="submit2" data-id="" >Zapisz</button></form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                </div>
            </div>
        </div>
    </div>@endsection
