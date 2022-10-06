@extends('layouts.app')

@section('template_title')
    {{ $team->name ?? 'Show Team' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Team</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('teams.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $team->name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $team->description }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
