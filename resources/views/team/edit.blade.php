@extends('layouts.app3')

@section('template_title')
    Update Team
@endsection

@section('content')
    <div class="container">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('teams.index') }}">Teamy</a> > <a href="{{ route('teams.show', $team->id) }}">{{ $team->name }}</a> > Edytuj</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('teams.update', $team->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('team.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
