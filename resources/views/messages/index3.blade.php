@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('messages.index') }}"><button type="button" data-toggle="modal" class="btn btn-secondary btn-sm pull-right"><i class="fa-solid fa-arrow-left"></i> Odebrane</button></a>
            <b>Zarchwizowane wiadomości</b> | 
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
                                    <th scope="col">Od</th>
                                    <th scope="col">Wysłano</th>
                                    <th scope="col" style="width:10px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $message)
                                        <tr style="">
                                            @if ($message->isread == 0)
                                                <td class="show2"><span class="badge badge-pill badge-info" style="margin-right: 3px;"><i class="fa-solid fa-box"></i></span><span class="badge badge-pill badge-danger" style="margin-right: 3px;">Nowa </span><a href="{{ route('messages.show', $message->id) }}">{{ $message->title }}</a></td>
                                                <td class="show2"><a href="{{ route('messages.show', $message->id) }}"><i class="fa-solid fa-user"></i>{{ $message->from->name }}</a></td>
                                                <td class="show2"><a href="{{ route('messages.show', $message->id) }}"><i class="fa-solid fa-clock"></i>{{ $message->created_at }}</a></td>
                                            @else
                                                <td class="show2"><span class="badge badge-pill badge-info" style="margin-right: 3px;"><i class="fa-solid fa-box"></i></span><a href="{{ route('messages.show', $message->id) }}">{{ $message->title }}</a></td>
                                                <td class="show2"><a href="{{ route('messages.show', $message->id) }}"><i class="fa-solid fa-user"></i>{{ $message->from->name }}</a></td>
                                                <td class="show2"><a href="{{ route('messages.show', $message->id) }}"><i class="fa-solid fa-clock"></i>{{ $message->created_at }}</a></td>
                                            @endif
                                            <td>
                                            <div class="btn-group">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{ route('messages.show', $message->id) }}" class="dropdown-item"><i class="fa-solid fa-eye"></i> Zobacz</a>
                                                    <a href="#" class="dropdown-item archived" data-id="{{ $message->id }}"><i class="fa-solid fa-arrow-left"></i> Odarchiwizuj</a>
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
$(document).on('click', '.archived', function() {
        $.ajax({
            method: "POST",
            url: "{{ config('app.url', 'Laravel') }}/messages/archive/" + $(this).data("id"),
            data: { id: $(this).data("id")},
            
            success:function(response)
            {
                location.reload();
            }
        })
    })
@endsection