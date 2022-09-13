@extends('layouts.app2')

@section('inhead')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
<link rel="stylesheet" href="{{ asset('assets/fullcalendar/fullcalendar.css') }}">
@endsection
 
@section('content')
<div class="container">
<div class="row border-bottom">
        <div class="col-6">
            <h4>Zadania do filmu: <b>{{ $film->title }}</b></h4>
            <select id="setting" class="form-control form-control2" style="width: 50%;" name="setting">
                <option class="form-control form-control2" value="0">Kliknięcie - zobacz</option>
                <option class="form-control form-control2" value="1">Kliknięcie - zobacz w nowej karcie</option>
                <option class="form-control form-control2" value="2">Kliknięcie usuwa datę</option>
            </select>
        </div>
        <div class="col-6">
            
            <a href="{{ route('films.show', $film->id) }}"><button class="btn btn-primary float-right" style="margin-right: 3px;" data-id="{{ $film->id }}">Koniec pracy</button></a>
        </div>
    </div>
    <br />
    <div id="calendar"></div>
</div>
@endsection


   
@section('javascript')

$(document).ready(function () {

$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
});

var calendar = $('#calendar').fullCalendar({
    editable:true,
    themeSystem: 'bootstrap4',
    firstDay: 1,
    header:{
        left:'prev,next today',
        center:'title',
        right:'month,agendaWeek,agendaDay'
    },
    events:'{{ route('films.plan.calendar', $film->id) }}',
    selectable:true,
    selectHelper: true,
    eventRender: function (event, element, view) {
        event.allDay = false;
    },
    select:function(start, end, allDay)
    {
        var name = prompt('Event Name:');

        if(name)
        {
            var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

            var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

            

            $.ajax({
                url:"{{ route('films.action') }}",
                type:"POST",
                data:{
                    name: name,
                    start: start,
                    end: end,
                    type: 'add'
                },
                success:function(data)
                {
                    calendar.fullCalendar('refetchEvents');
                    //alert("Event Created Successfully");
                }
            })
        }
    },
    eventResize: function(event, delta)
    {
        var start = $.fullCalendar.formatDate(event.start, 'YYYY-MM-DD');
        var end = $.fullCalendar.formatDate(event.end, 'YYYY-MM-DD HH:mm:ss');


        var name = event.name;
        var id = event.id;
        $.ajax({
            url:"{{ route('films.plan.action') }}",
            type:"POST",
            data:{
                name: name,
                start: start,
                end: end,
                id: id,
                type: 'update'
            },
            success:function(response)
            {
                calendar.fullCalendar('refetchEvents');
                //alert("Event Updated Successfully");
            }
        })
    },
    eventDrop: function(event, delta)
    {
        var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
        var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
        var name = event.name;
        var id = event.id;
        $.ajax({
            url:"{{ route('films.plan.action') }}",
            type:"POST",
            data:{
                name: name,
                start: start,
                end: end,
                id: id,
                type: 'update'
            },
            success:function(response)
            {
                calendar.fullCalendar('refetchEvents');
                //alert("Event Updated Successfully");
            }
        })
    },

    eventClick:function(event)
    {
        var ustawienie = $("#setting").val();
        if(ustawienie == 2){
            if(confirm("Usunąć datę? Zadanie: " + event.title)){
                $.ajax({
                    url:"{{ route('films.plan.action') }}",
                    type:"POST",
                    data:{
                        id: event.id,
                        name: event.name,
                        type: 'del-date'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        //alert("Event Updated Successfully");
                    }
                })
            }
        }
        else if(ustawienie == 0){
            var id = event.id;
            window.location.href = "{{ config('app.url', 'Laravel') }}/tasks/" + id;
        }
        else{
            var id = event.id;
            window.open("{{ config('app.url', 'Laravel') }}/tasks/" + id, '_blank').focus();
        }
      
        
    }
});

});


@endsection