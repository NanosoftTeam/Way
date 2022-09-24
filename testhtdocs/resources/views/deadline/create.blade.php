@extends('layouts.app')

@section('template_title')
    Create Deadline
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('deadlines.index') }}">Deadliney</a> > Create Deadline</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('deadlines.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('deadline.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
