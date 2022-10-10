@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('template_title')
    Update Wordlist
@endsection

@section('javascript2')
function delete1(id1, name) {
    let czy = prompt("Usunąć słowo tak/nie? nazwa: " + name);
    if (czy == "tak") {
        
        $.ajax({
            method: "DELETE",
            url: "{{ config('app.url', 'Laravel') }}/words/" + id1,
        data: { id: id1}
        })
        .done(function( msg ) {
            window.location.href = "{{ route('wordlists.show', $word->wordlist_id) }}";
            
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection

@section('content')
    <div class="container">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('wordlists.show', $word->wordlist_id) }}">{{ $word->wordlist->name }}</a> > {{ $word->name }} > Edytuj</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('words.update', $word->id) }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('word.form')

                        </form>
                        <button class="btn btn-danger float-right" onclick="delete1({{ $word->id}}, '{{$word->name}}')">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
