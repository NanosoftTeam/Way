@extends('layouts.app')

@section('template_title')
    Update Wordlist
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
