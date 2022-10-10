@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{ route('messages.index') }}"><i class="fa-solid fa-inbox"></i> Wiadomości</a> > <a href="{{ route('messages.show', $message->id) }}">{{ $message->title }}</a> > Odpowiedź</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('messages.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tytuł:</label>
                            <input name="title" id="title" type="text" class="form-control" value="Re: {{ $message->title }}">
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Adresat:</label>
                            <select class="selectpicker form-control" data-live-search="true" name="user_to" id="user_to">
                                <option value="{{ $message->from->id }}">{{ $message->from->name }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="recipient-name">Treść:</label>
                            <textarea name="content" id="content" class="form-control" rows="6" value=""></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Wyślij
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
