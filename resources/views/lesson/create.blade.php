@extends('layouts.app')

@section('template_title')
    Create Lesson
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('lessons.index') }}">Lekcja</a> > nowa</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('lessons.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('lesson.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
