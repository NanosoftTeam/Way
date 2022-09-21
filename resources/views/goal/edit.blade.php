@extends('layouts.app')

@section('template_title')
    Update Goal
@endsection

@section('content')
    <div class="container">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('goals.index') }}">Cele</a> ><a href="{{ route('goals.show', $goal->id) }}">{{ $goal->name }}</a> > {{ $goal->name }}</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('goals.update', $goal->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('goal.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
