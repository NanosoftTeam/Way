@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('javascript2')

@endsection

@section('content')

<div class="container">
    x
    
</div>


@endsection
@section('javascript')


    $( document ).ready(function() {
        function message_broadcast(message)
        {
            localStorage.setItem('message',JSON.stringify(message));
            localStorage.removeItem('message');
        }
        
        message_broadcast({'command':'refresh'});
        
        window.close();
        
        
            
    });
@endsection