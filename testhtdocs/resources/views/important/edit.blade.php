@extends('layouts.app')

@section('template_title')
    Update Important
@endsection

@section('content')
    <div class="container">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('importants.index') }}">Important</a> > {{ $important->name }}</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('importants.update', $important->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('important.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
