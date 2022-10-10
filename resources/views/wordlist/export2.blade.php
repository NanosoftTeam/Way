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
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('wordlists.export', $wordlist->id) }}">Wszystkie dane</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('wordlists.export2', $wordlist->id) }}">Proste (do excela)</a>
                            </li>
                        </ul>
                        <button class="btn btn-success btn-sm float-right" onclick="Skopiuj()">Skopiuj</button>
                        <textarea class="form-control" name="export" id="export" rows="15">@foreach ($wordlist->words as $word){{ $word->name."\t"."$word->translation"."\r\n" }}@endforeach</textarea>
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
