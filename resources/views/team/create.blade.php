@extends('layouts.app3')

@section('template_title')
    Create Team
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('teams.index') }}">Teamy</a> > nowy</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('teams.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('team.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
