@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{ route('messages.index') }}"><i class="fa-solid fa-inbox"></i> Wiadomości</a> > Nowa</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('messages.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tytuł:</label>
                            <input name="title" id="title" type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Adresat:</label>
                            <select class="selectpicker form-control" data-live-search="true" name="user_to" id="user_to">
                                <option value="{{ Auth::user()->id }}">Ty ({{ Auth::user()->name }})</option>
                                <option value="-1">WSZYSCY</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="recipient-name">Treść:</label>
                            <textarea name="content" id="content" class="form-control" rows="6"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name"><i class="fa-solid fa-file"></i> Załącznik:</label>
                            <input name="file" id="file" type="file" class="">
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
