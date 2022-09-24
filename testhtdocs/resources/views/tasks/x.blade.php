@extends('layouts.app')

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