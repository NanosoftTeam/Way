@extends('layouts.app')

@section('javascript2')
function myFunction(id1, name) {
    let czy = prompt("Usunąć film tak/nie? nazwa: " + name);

    if (czy == "tak") {
        $.ajax({
            method: "GET",
            url: "{{ config('app.url', 'Laravel') }}/films/d/" + id1,
        data: { id: id1}
        })
        .done(function( msg ) {
            window.location.href = "{{ route('films.index') }}";
            
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection

@section('content')
<?php
$channel  = array("Infast", "Infast Animations");
$type  = array("Film", "Odcinek kursu", "Short");
$course  = array("Kurs 1", "Kurs 2", "Kurs3");
$person = array("Infast Team", "Jan Kowalski", "Jan Malinowski");
$status  = array("Pomysł", "Wstrzymany", "Do zrealizowania", "Plan", "Scenariusz", "Nagrywanie", "Montaż", "Uploadowanie", "Oczekuje na publikację", "Opublikowany", "Koniec");
$color = array("secondary", "secondary", "primary", "warning", "warning", "danger", "danger", "success", "success", "success", "success");
?>

<div class="container">
        <div id="film-info">
            @include('films.show-load')
        </div>
</div>



<div class="modal fade bd-example-modal-lg" id="edit_film" tabindex="-2" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="overflow-y: auto !important;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Film</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <table class="table table-sm" id="table-film-info">

                    <thead>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="title">Tytuł</td>
                            <td id="t-title"><input name="title" id="title2" type="text" class="form-control form-control2" required></td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Początek prac</td>
                            <td id="t-start"><input name="start" id="start2" type="date" class="form-control form-control2"></td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Publikacja</td>
                            <td id="t-end"><input name="end" id="end2" type="date" class="form-control form-control2"></td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Status</td>
                            <td >
                                <select id="status2" class="form-control form-control2" name="status" value="" required autocomplete="status">
                                    <option class="form-control form-control2 bg-secondary text-white" value="0">Pomysł</option>
                                    <option class="form-control form-control2 bg-secondary text-white" value="1">Wstrzymany</option>
                                    <option class="form-control form-control2 bg-primary text-white" value="2">Do zrealizowania</option>
                                    <option class="form-control form-control2 bg-warning text-dark" value="3">Plan</option>
                                    <option class="form-control form-control2 bg-warning text-dark" value="4">Scenariusz</option>
                                    <option class="form-control form-control2 bg-danger text-white" value="5">Nagrywanie</option>
                                    <option class="form-control form-control2 bg-danger text-white" value="6">Montaż</option>
                                    <option class="form-control form-control2 bg-success text-white" value="7">Uploadowanie</option>
                                    <option class="form-control form-control2 bg-success text-white" value="8">Oczekuje na publikację</option>
                                    <option class="form-control form-control2 bg-success text-white" value="9">Opublikowany</option>
                                    <option class="form-control form-control2 bg-success text-white" value="10">Koniec</option>
                                </select>
                            </td>
                        </tr>  
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Kanał</td>
                            <td >
                                <select id="channel2" class="form-control form-control2" name="channel" value="" required autocomplete="channel">
                                    <option class="form-control form-control2" value="0">Infast</option>
                                    <option class="form-control form-control2" value="1">Infast Animations</option>
                                </select>
                            </td>
                        </tr>  
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Rodzaj</td>
                            <td >
                                <select id="type2" class="form-control form-control2" name="type" value="" required autocomplete="type">
                                    <option class="form-control form-control2" value="0">Film</option>
                                    <option class="form-control form-control2" value="1">Odcinek kursu</option>
                                    <option class="form-control form-control2" value="2">Short</option>
                                </select>
                            </td>
                        </tr>  
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Kurs</td>
                            <td id="t-course">
                                <select id="course2" class="form-control form-control2" name="course" value="" required autocomplete="course">
                                    @foreach($courses as $course)
                                        <option class="form-control form-control2" value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>  
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Opiekun</td>
                            <td >
                                <select id="person2" class="form-control form-control2" name="person" value="" required autocomplete="person">
                                    <option class="form-control form-control2" value="0">Infast Team</option>
                                    @foreach($users as $user)
                                        <option class="form-control form-control2" value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Opis</td>
                            <td ><textarea id="descript2" class="form-control form-control2" rows="4"></textarea></td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Status opisowy</td>
                            <td ><textarea id="longstatus2" class="form-control form-control2" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Link YT</td>
                            <td >
                                <input name="yt" id="yt2" type="text" class="form-control form-control2">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Link scenariusz</td>
                            <td >
                                <input name="scenario" id="scenario2" type="text" class="form-control form-control2">
                            </td>
                        </tr>        
                    </tbody>
                </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit2" data-id="" >Zapisz</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    

    $( document ).ready(function() {
        
        $(document).on('click', '.edit', function() {
            $('#show_film').modal('hide');
            $('#edit_film').modal('show');
            $.ajax({
                method: "POST",
                url: "{{ config('app.url', 'Laravel') }}/films/edit/" + $(this).data("id"),
                data: { id: $(this).data("id")},
                
                success:function(response)
                {
                    //alert(response);
                    obj = JSON.parse(JSON.stringify(response))
                    //alert(obj.title);

                    //document.getElementById("submit2").data("id") = "{{ config('app.url', 'Laravel') }}/films/update/" + obj.id;
                    $('#submit2').attr('data-id' , obj.id);

                    document.getElementById('title2').value = obj.title;
                    document.getElementById('end2').value = obj.end;
                    document.getElementById('start2').value = obj.start;
                    document.getElementById('status2').value = obj.status;
                    document.getElementById('channel2').value = obj.channel;
                    document.getElementById('type2').value = obj.type;
                    document.getElementById('course2').value = obj.course_id;
                    document.getElementById('descript2').value = obj.description;
                    document.getElementById('longstatus2').value = obj.longstatus;
                    document.getElementById('yt2').value = obj.yt;
                    document.getElementById('scenario2').value = obj.scenario;
                    document.getElementById('person2').value = obj.person;
                    
                }
            })
        })

        var status = ["Pomysł", "Do zrealizowania", "Plan", "Scenariusz", "Nagrywanie", "Montaż", "Koniec"];

        $(document).on('click', '#submit2', function() { 
            $('#edit_film').modal('hide');
            
            var id11 = $('#submit2').attr('data-id')

            document.getElementById('b-edit').innerHTML = "Aktualizowanie...";
            //document.getElementById('e' + id11).innerHTML = '<span class="badge badge-pill badge-success">' + document.getElementById('end2').value + '</span>';
            //document.getElementById('s' + id11).innerHTML = '<span class="badge badge-pill badge-warning">' + status[document.getElementById('status2').value] + '</span>';


            $.ajax({
                method: "POST",
                url: "{{ config('app.url', 'Laravel') }}/films/update/" + id11,
                data: {
                    id: id11,
                    title: document.getElementById('title2').value,
                    status: document.getElementById('status2').value,
                    start: document.getElementById('start2').value,
                    end: document.getElementById('end2').value,
                    channel: document.getElementById('channel2').value,
                    type: document.getElementById('type2').value,
                    course_id: document.getElementById('course2').value,
                    description: document.getElementById('descript2').value,
                    longstatus: document.getElementById('longstatus2').value,
                    scenario: document.getElementById('scenario2').value,
                    yt: document.getElementById('yt2').value,
                    person: document.getElementById('person2').value,
                    },
                
                success:function(response)
                {
                    getArticles(window.location.href);
                    
                    
                }
            })

            $('#submit2').attr('data-id' , "");
           
        })
            
    });

    function getArticles(url) {
        $.ajax({
            url : '{{ route('films.tab_info', $film->id) }}'
        }).done(function (data) {
            $('#n-info').html(data);
        }).fail(function () {
            alert('Films could not be loaded.');
        });

        $.ajax({
            url : '{{ route('films.tab_tasks', $film->id) }}'
        }).done(function (data) {
            $('#nav-tasks').html(data);
        }).fail(function () {
            alert('Films could not be loaded.');
        });
    }

    setInterval(function(){
        getArticles(window.location.href)
    }, 30000);
@endsection