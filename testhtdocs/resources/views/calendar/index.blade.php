@extends('layouts.app2')

@section('inhead')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
<link rel="stylesheet" href="{{ asset('assets/fullcalendar/fullcalendar.css') }}">

<style>
    .fc-today {
        background: #d4e7f7 !important;
    }
</style>

@endsection
 
@section('content')
<div class="container">
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
    eventDurationEditable: false,
    themeSystem: 'bootstrap4',
    firstDay: 1,
    header:{
        left:'prev,next today',
        center:'title',
        right:'month,agendaWeek,agendaDay'
    },
    events:'{{ route('calendar.index') }}',
    selectable:true,
    selectHelper: true,

    eventRender: function (event, element, view) {
        event.allDay = false;
    },
    select:function(start, end, allDay)
    {
        var title = prompt('Event Title:');

        if(title)
        {
            var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

            var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

            

            $.ajax({
                url:"{{ route('calendar.action') }}",
                type:"POST",
                data:{
                    name: title,
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


        var title = event.name;
        var id = event.id;
        $.ajax({
            url:"{{ route('calendar.action') }}",
            type:"POST",
            data:{
                title: title,
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
        var title = event.name;
        var id = event.id2;
        $.ajax({
            url:"{{ route('calendar.action') }}",
            type:"POST",
            data:{
                title: title,
                start: start,
                end: end,
                id: id,
                type: 'update',
                event_type: event.type
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
      var id = event.id2;
      if(event.type == 1){
        window.location.href = "{{ config('app.url', 'Laravel') }}/deadlines/" + id;
      }
      else{
          window.location.href = "{{ config('app.url', 'Laravel')}}/tasks/" + id;
      }
      
        
    }
});

});


@endsection