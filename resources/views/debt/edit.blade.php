@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('template_title')
    Update Debt
@endsection

@section('content')
    <div class="container">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('debts.index') }}">Pożyczki</a> ><a href="{{ route('debts.show', $debt->id) }}">{{ $debt->name }}</a> > edycja</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('debts.update', $debt->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('debt.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
