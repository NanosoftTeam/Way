@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('template_title')
    Create Clothes
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <a href="{{ route('clothes.index') }}">Ubrania</a> > Nowe
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('clothes.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('clothes.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
