@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

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
                        <span class="card-title"><a href="{{ route('wordlists.index') }}">Listy słówek</a> > {{ $wordlist->name }} > Edytuj</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('wordlists.update', $wordlist->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('wordlist.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
