@extends('layouts.app')

@section('template_title')
    Create Word
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Listy słówek > <a href="{{ route('wordlists.show', $wordlist->id) }}">{{ $wordlist->name }}</a> > nowe słowo</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('words.store', $wordlist->id) }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('word.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
