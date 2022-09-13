@extends('layouts.app')

@section('template_title')
    Update Deadline
@endsection

@section('content')
    <div class="container">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('deadlines.index') }}">Deadliney</a> > <a href="{{ route('deadlines.show', $deadline->id) }}">{{ $deadline->name }}</a> > Update Deadline</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('deadlines.update', $deadline->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('deadline.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
