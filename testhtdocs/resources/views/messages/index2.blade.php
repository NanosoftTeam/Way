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
    <div class="card">
        <div class="card-header">
            <a href="{{ route('messages.index') }}"><button type="button" data-toggle="modal" class="btn btn-secondary btn-sm pull-right"><i class="fa-solid fa-arrow-left"></i> Odebrane</button></a>
            <b>Wysłane wiadomości</b> | 
            <a href="{{ route('messages.create') }}"><button type="button" data-toggle="modal" class="btn btn-primary btn-sm pull-right"><i class="fa-solid fa-plus"></i> Nowa</button>
            <a data-toggle="collapse" href="#collapse-application" role="button" aria-expanded="false" aria-controls="collapse-application"><button type="button" class="btn btn-link"><i class="fa-solid fa-filter"></i> Filtry</button></a>
        </div>
        <div class="card-header collapse multi-collapse" id="collapse-application"><i>chwilowo brak filtrów</i></div>

        <div class="card-body">
            
                    <section class="messages">

                        <div id="load" style="position: relative;">
                        <table class="table table-sm table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Tytuł</th>    
                                    <th scope="col">Do</th>
                                    <th scope="col">Wysłano</th>
                                    <th scope="col" style="width:10px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $message)
                                        <tr style="">
                                            @if ($message->isread == 0)
                                                <td class="show2"><span class="badge badge-pill @if($message->parent_message_id == -2) badge-light @else badge-warning @endif" style="margin-right: 3px;">@if($message->parent_message_id == -2) <i class="fa-solid fa-user-group"></i> Do wszystkich @else Wysłana @endif</span><a href="{{ route('messages.show', $message->id) }}">{{ $message->title }}</a></td>
                                                <td class="show2"><a href="{{ route('messages.show', $message->id) }}">@if($message->to == NULL) <i class="fa-solid fa-user-group"></i> [Do wszystkich] @else <i class="fa-solid fa-user"></i> {{ $message->to->name }}@endif</a></td>
                                                <td class="show2"><a href="{{ route('messages.show', $message->id) }}"><i class="fa-solid fa-clock"></i> {{ $message->created_at }}</a></td>
                                            @else
                                                <td class="show2"><span class="badge badge-pill badge-success" style="margin-right: 3px;"><i class="fa-solid fa-check"></i> Przeczytana</span><a href="{{ route('messages.show', $message->id) }}">{{ $message->title }}</a></td>
                                                <td class="show2"><a href="{{ route('messages.show', $message->id) }}">@if($message->parent_message_id == -2) <i class="fa-solid fa-user-group"></i> [Do wszystkich] @else <i class="fa-solid fa-user"></i> {{ $message->to->name }}@endif</a></td>
                                                <td class="show2"><a href="{{ route('messages.show', $message->id) }}"><i class="fa-solid fa-clock"></i> {{ $message->created_at }}</a></td>
                                            @endif
                                            <td>
                                            <div class="btn-group">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{ route('messages.show', $message->id) }}" class="dropdown-item"><i class="fa-solid fa-eye"></i> Zobacz</a>
                                                    <a href="#" class="dropdown-item delete" onclick="myFunction({{ $message->id}}, '{{$message->title}}')"><i class="fa-solid fa-xmark"></i> Anuluj</a>
                                                </div>
                                            </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>



                        </div>
                        {{ $messages->links() }}
                    </section>
        </div>
    </div>
    
</div>
        
@endsection
@section('javascript')

@endsection