@extends('layouts.app')

@section('template_title')
    Update Lesson
@endsection

@section('content')
    <div class="container">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('lessons.index') }}">Lekcje</a> ><a href="{{ route('lessons.show', $lesson->id) }}">{{ $lesson->name }}</a> > edycja</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('lessons.update', $lesson->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('lesson.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
