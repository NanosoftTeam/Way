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
            <b>Załączniki wiadomości</b>
        </div>

        <div class="card-body">
            
                    <section class="changes">

                        <div id="load" style="position: relative;">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">Nazwa</th>
                                <th scope="col" style="width:10px"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                    <tr>
                                        <td><a href="{{ route('messages.download', $message->id) }}"><i class="fa-solid fa-file"></i> {{ $message->file_name }}</a></td>
                                        <td>
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('messages.del_file', $message->id) }}" enabled="false"><i class="fa-solid fa-trash"></i> Usuń</a>
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