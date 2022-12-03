@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('template_title')
    Update Clothes
@endsection

@section('content')
    <div class="container">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <a href="{{ route('clothes.index') }}">Ubrania</a> > <a href="{{ route('clothes.edit', $clothes->id) }}">{{ $clothes->id }}</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('clothes.update', $clothes->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('clothes.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
