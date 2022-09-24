@extends('layouts.app')

@section('javascript2')
function myFunction(id1, name) {
    let czy = prompt("Anulować wiadomość tak/nie? nazwa: " + name);

    if (czy == "tak") {
        $.ajax({
            method: "GET",
            url: "{{ config('app.url', 'Laravel') }}/messages/d/" + id1,
        data: { id: id1}
        })
        .done(function( msg ) {
            location.reload();
            
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($sent_view == true)
                    <div class="card-header"><a href="{{ route('messages.index2') }}"><i class="fa-solid fa-message"></i> Wiadomości wysłane</a> > {{ $message->title }}
                        <button class="btn btn-danger btn-sm" onclick="myFunction({{ $message->id}}, '{{$message->title}}')">Anuluj</button></a>
                    </div>

                @elseif ($message->archived == 1)
                    <div class="card-header"><a href="{{ route('messages.index3') }}"><i class="fa-solid fa-box-archive"></i> Wiadomości zarchiwizowane</a> > {{ $message->title }} <a href="{{ route('messages.re', $message->id) }}">
                        <button class="btn btn-primary btn-sm"><i class="fa-solid fa-reply"></i> Odpowiedz</button></a>
                    </div>
                @else
                    <div class="card-header"><a href="{{ route('messages.index') }}"><i class="fa-solid fa-inbox"></i> Wiadomości</a> > {{ $message->title }} <a href="{{ route('messages.re', $message->id) }}">
                        <button class="btn btn-primary btn-sm"><i class="fa-solid fa-reply"></i> Odpowiedz</button></a>
                    </div>
                @endif
                

                    <div class="card-body">
                    <table class="table table-sm" id="table-message-info">

                        <thead>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Tytuł</td>
                                <td id="t-name"><b>{{ $message->title }} @if($message->parent_message_id != 0) <span class="badge badge-pill badge-light" style="margin-right: 3px;">Do wszystkich</span> @endif</b></td>
                            </tr>
                            @if ($sent_view == false)
                                <tr>
                                    <td class="table-active text-secondary" style="width: 20%">Od</td>
                                    <td id="t-status"><i class="fa-solid fa-user"></i> {{ $message->from->name }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="table-active text-secondary" style="width: 20%">Do</td>
                                    <td id="t-end">@if($message->parent_message_id != -2) <i class="fa-solid fa-user"></i> {{ $message->to->name }} @else <span class="badge badge-pill badge-light" style="margin-right: 3px;">Do wszystkich</span> @endif</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%">Wysłano</td>
                                <td ><i class="fa-solid fa-clock"></i> {{ $message->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <ul class="list-group full-width">
                        <li class="list-group-item">{!!nl2br($message->content)!!}</li>
                    </ul>
                    <br />
                    
                    @if($if_file == true and $message->file_path != "admin_usuna")
                        <b>Załączniki:</b><br />
                        <ul>
                            <li><a href="{{ route('messages.download', $message->id) }}"><i class="fa-solid fa-file"></i> {{ $message->file_name }}</a></li>
                        </ul>
                    @elseif($message->file_path == "admin_usuna")
                        <b>Załączniki:</b><br />
                        <ul>
                            <li><i class="fa-solid fa-file-circle-question"></i> {{ $message->file_name }} [usunięty z serwera]</li>
                        </ul>
                    @endif

                    @if($message->parent_message_id != -2)
                        @if ($message->isread == 0)
                            <span class="text-danger"><i class="fa-solid fa-xmark"></i> [Nieprzeczytana przez {{ $message->to->name }}]</span>
                        @else
                            <span class="text-success"><i class="fa-solid fa-check"></i> [Przeczytana przez {{ $message->to->name }}]</span>
                        @endif
                    @else
                        <b>Adresaci:</b><br />
                        @foreach($messages2 as $m)
                            @if ($m->isread == 0)
                                <span class="text-danger"><b><i class="fa-solid fa-xmark"></i>{{ $m->to->name }}</b> [nieprzeczytana]</span><br />
                            @else
                                <span class="text-success"><b><i class="fa-solid fa-check"></i>{{ $m->to->name }}</b> [przeczytana]</span><br />
                            @endif
                        @endforeach
                    @endif

                    
                </div>
                
            </div>
            
            
        </div>
    </div>
</div>
@endsection
