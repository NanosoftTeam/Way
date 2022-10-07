@extends('layouts.app')

@section('javascript2')
function delete1(id1, name) {
    let czy = prompt("Usunąć listę tak/nie? nazwa: " + name);
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
                    <b>Nauka: </b>
                    <a class="btn btn-success btn-sm" style="margin-right: 3px;" href="{{ route('words.learn', $wordlist->id) }}">Ucz się</a>
                    <a class="btn btn-success btn-sm" style="margin-right: 3px;" href="{{ route('words.learn2', $wordlist->id) }}">Ucz się (powtórki data)</a>
                    <a class="btn btn-success btn-sm" style="margin-right: 3px;" href="{{ route('words.learn3', $wordlist->id) }}">Ucz się nowych</a>
                    </div>
                </div>
                <br />
                <div class="card">
                <div class="card-header">
                        Słowa z listy <button class="btn btn-primary btn-sm float-right" style="margin-left: 3px;" href="#" disabled>Nowe słowo</buton>
                        <button class="btn btn-primary btn-sm float-right" disabled>Importuj</button>
                        <button class="btn btn-success btn-sm float-right" style="margin-right: 3px;" href="#" disabled>Eksportuj</button>
                    </div>

                    <div class="card-body">
                        

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('wordlists.show', $wordlist->id) }}">Lista słów</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('words.progress', $wordlist->id) }}">Postępy</a>
                        </li>
                    </ul>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                <th scope="col">Słowo</th>
                                <th scope="col">PL</th>
                                <th scope="col">Poprawna odp</th>
                                <th scope="col">Poprawnych(+) nie(-)</th>
                                <th scope="col">Tagi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($words as $word)
                                <tr id="w{{ $word->id }}">
                                    <th><a href="{{ route('words.edit', $word->id) }}">{{ $word->name }}</a></th>
                                    <td>{{ $word->translation }}</td>
                                    <td>{{ $word->last_correct_answer }}</td>
                                    <td class="@if($word->correct_answers > 0) text-success @elseif($word->correct_answers < 0) text-danger @endif">{{ $word->correct_answers }}</td>
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
    @endsection
