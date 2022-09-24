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
                        <span class="card-title"><a href="{{ route('wordlists.index') }}">Listy słówek</a> > <a href="{{ route('wordlists.show', $wordlist->id) }}">{{ $wordlist->name }}</a> > eksport
                        </span>
                    </div>

                    <div class="card-body">
                        <button class="btn btn-success btn-sm float-right" onclick="Skopiuj()">Skopiuj</button>
                        <textarea class="form-control" name="export" id="export" rows="15">@foreach ($wordlist->words as $word){{ $word->name."\t"."$word->translation"."\t".$word->name_info."\t".$word->translation_info."\t".$word->mw."\t".$word->iw."\t".$word->mt."\r\n" }}@endforeach</textarea>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

@endsection

@section('javascript')

function Skopiuj() {
    const input = document.getElementById('export');
    input.focus();
    input.select();
    input.setSelectionRange(0, 99999999);
    document.execCommand('copy');
}

@endsection
