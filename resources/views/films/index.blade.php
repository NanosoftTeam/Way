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
            getArticles(window.location.href);
            $('#show_film').modal('hide');
            
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
            <b>Filmy</b> | 
            <button type="button" data-toggle="modal" data-target="#add_film" class="btn btn-primary btn-sm pull-right"><i class="fa-solid fa-plus"></i> Nowy</button>
            <a href="{{ route('courses.index') }}"><button type="button" data-toggle="modal" class="btn btn-secondary btn-sm pull-right"><i class="fa-solid fa-folder"></i> Kursy</button></a>
            <a data-toggle="collapse" href="#collapse-filters" role="button" aria-expanded="false" aria-controls="collapse-filters"><button type="button" class="btn btn-link"><i class="fa-solid fa-filter"></i> Filtry</button></a>
        </div>

        <div class="card-header collapse multi-collapse" id="collapse-filters">
            <div class="form-inline">
                <select class="form-control" id="select-user" style="width: 180px;">
                    <option value="a">Wszystkie osoby</option>
                    <option value="b">Brak osoby</option>
                    @foreach($users as $user)
                        <option class="form-control" value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <select class="form-control float-left" id="select-status" style="width: 180px;">
                    <option value="a">Nieskończone</option>
                    <option value="b">Wszystkie</option>
                    <option value="0">Pomysł</option>
                    <option value="1">Wstrzymany</option>
                    <option value="2">Do zrealizowania</option>
                    <option value="3">Plan</option>
                    <option value="4">Scenariusz</option>
                    <option value="5">Nagrywanie</option>
                    <option value="6">Montaż</option>
                    <option value="7">Uploadowanie</option>
                    <option value="8">Oczekuje na publikację</option>
                    <option value="9">Opublikowany</option>
                    <option value="10">Koniec</option>
                </select>
                <select class="form-control" id="select-course" style="width: 180px;">
                    <option value="a">Wszystkie kursy</option>
                    @foreach($courses as $course)
                        <option class="form-control" value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
                <select class="form-control float-left" id="select-date" style="width: 180px;">
                    <option value="a">Wszystkie daty</option>
                    <option value="1">Do dzisiaj (<=)</option>
                    <option value="2">Bez daty</option>
                    <option value="3">Przeterminowane</option>
                </select>
                <select class="form-control float-left" id="select-channel" style="width: 180px;">
                    <option value="a">Wszystkie kanały</option>
                    <option value="0">Infast</option>
                    <option value="1">Infast Animations</option>
                </select>
            </div>
        </div>

        <div class="card-body">
                <section class="films">
                    @include('films.load')
                </section>
        </div>
    </div>
    
</div>

<div class="modal fade bd-example-modal-lg" id="add_film" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                        <td id="t-title"><input name="title" id="title" type="text" class="form-control form-control2" required></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Początek prac</td>
                        <td id="t-start"><input name="start" id="start" type="date" class="form-control form-control2"></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Publikacja</td>
                        <td id="t-end"><input name="end" id="end" type="date" class="form-control form-control2"></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Status</td>
                        <td >
                            <select id="status" class="form-control form-control2" name="status" value="" required autocomplete="status">
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
                            <select id="channel" class="form-control form-control2" name="channel" value="" required autocomplete="channel">
                                <option class="form-control form-control2" value="0">Infast</option>
                                <option class="form-control form-control2" value="1">Infast Animations</option>
                            </select>
                        </td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Rodzaj</td>
                        <td >
                            <select id="type" class="form-control form-control2" name="type" value="" required autocomplete="type">
                                <option class="form-control form-control2" value="0">Film</option>
                                <option class="form-control form-control2" value="1">Odcinek kursu</option>
                                <option class="form-control form-control2" value="2">Short</option>
                            </select>
                        </td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Kurs</td>
                        <td id="t-course">
                            <select id="course" class="form-control form-control2" name="course" value="" required autocomplete="course">
                                @foreach($courses as $course)
                                    <option class="form-control form-control2" value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Opiekun</td>
                        <td >
                            <select id="person" class="form-control form-control2" name="person" value="" required autocomplete="person">
                                <option class="form-control form-control2" value="0">Infast Team</option>
                                @foreach($users as $user)
                                    <option class="form-control form-control2" value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Opis</td>
                        <td ><textarea id="descript" class="form-control form-control2" rows="4"></textarea></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Status opisowy</td>
                        <td ><textarea id="longstatus" class="form-control form-control2" rows="3"></textarea></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Link YT</td>
                        <td >
                            <input name="yt" id="yt" type="text" class="form-control form-control2">
                        </td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Link scenariusz</td>
                        <td >
                            <input name="scenario" id="scenario" type="text" class="form-control form-control2">
                        </td>
                    </tr>        
                </tbody>
                </table>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit" data-id="" >Zapisz</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                </div>
            </div>
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

    <div class="modal fade bd-example-modal-lg" id="show_film" tabindex="-3" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Film</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-show-film">
                    ...
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

        var interval2;

        $(document).on('click', '.show2', function() { 
            $('#show_film').modal('show');
            $('#modal-show-film').html('<img style="display: block; margin: 0 auto;" src="https://demos.laraget.com/images/loading2.gif" />');

            $.ajax({
                    url : "{{ config('app.url', 'Laravel') }}/films/m/" + $(this).data("id"),
                }).done(function (data) {
                    $('#modal-show-film').html(data);
                }).fail(function () {
                    alert('Modal could not be loaded.');
            });

            var mid = $(this).data("id"); 

            interval2 = setInterval(function(){
                $.ajax({
                    url : "{{ config('app.url', 'Laravel') }}/films/info/" + mid,
                }).done(function (data) {                 
                    $('#nav-info').html(data);
                   
                }).fail(function () {
                    alert('Modal could not be loaded.');
                });

                $.ajax({
                    url : "{{ config('app.url', 'Laravel') }}/films/tasks/" + mid,
                }).done(function (data) {                 
                    $('#nav-tasks').html(data);
                   
                }).fail(function () {
                    alert('Modal could not be loaded.');
                });
            }, 30000);
        })

        $('#show_film').on('hidden.bs.modal', function () {
            clearInterval(interval2);
        });

        var status = ["Pomysł", "Wstrzymany", "Do zrealizowania", "Plan", "Scenariusz", "Nagrywanie", "Montaż", "Uploadowanie", "Oczekuje na publikację", "Opublikowany", "Koniec"];
        var color = ["secondary", "secondary", "primary", "warning", "warning", "danger", "danger", "success", "success", "success", "success"];

        $(document).on('click', '#submit2', function() { 
            $('#edit_film').modal('hide');
            
            var id11 = $('#submit2').attr('data-id');

            var status22 = document.getElementById('status2').value;

            document.getElementById('t' + id11).innerHTML = document.getElementById('title2').value;
            document.getElementById('e' + id11).innerHTML = 'czekaj...';
            document.getElementById('s' + id11).innerHTML = '<span class="badge badge-pill badge-' + color[status22] + '">' + status[status22] + '</span>';


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

       

        $(document).on('click', '#submit', function() { 
            $('#add_film').modal('hide');
            $.ajax({
                method: "POST",
                url: "{{ config('app.url', 'Laravel') }}/films" ,
                data: {
                    title: document.getElementById('title').value,
                    status: document.getElementById('status').value,
                    start: document.getElementById('start').value,
                    end: document.getElementById('end').value,
                    channel: document.getElementById('channel').value,
                    type: document.getElementById('type').value,
                    course_id: document.getElementById('course').value,
                    description: document.getElementById('descript').value,
                    longstatus: document.getElementById('longstatus').value,
                    scenario: document.getElementById('scenario').value,
                    yt: document.getElementById('yt').value,
                    person: document.getElementById('person').value,
                    },
                
                success:function(response)
                {
                    document.getElementById('title').value = "";
                    document.getElementById('end').value = "";
                    document.getElementById('start').value = "";
                    document.getElementById('status').value = "0";
                    document.getElementById('channel').value = "0";
                    document.getElementById('type').value = "0";
                    document.getElementById('course').value = "0";
                    document.getElementById('descript').value = "";
                    document.getElementById('longstatus').value = "";
                    document.getElementById('yt').value = "";
                    document.getElementById('scenario').value = "";
                    document.getElementById('person').value = "0";
                    

                    getArticles(window.location.href);
                }
            })
           
        })

        $('#select-user').change(function(){
            $('#load a').css('color', '#dfecf6');
            $('#load').append('<img style="position: absolute; left: 45%; top: 10%;" src="https://demos.laraget.com/images/loading2.gif" />');
            getArticles(window.location.pathname + "?user=" + $('#select-user option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&course=" + $('#select-course option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&channel=" + $('#select-channel option:selected').val());
            window.history.pushState({}, '', window.location.pathname + "?user=" + $('#select-user option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&course=" + $('#select-course option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&channel=" + $('#select-channel option:selected').val());
            //const queryString = window.location.search;
        });

        $('#select-status').change(function(){
            $('#load a').css('color', '#dfecf6');
            $('#load').append('<img style="position: absolute; left: 45%; top: 10%;" src="https://demos.laraget.com/images/loading2.gif" />');
            getArticles(window.location.pathname + "?user=" + $('#select-user option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&course=" + $('#select-course option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&channel=" + $('#select-channel option:selected').val());
            window.history.pushState({}, '', window.location.pathname + "?user=" + $('#select-user option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&course=" + $('#select-course option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&channel=" + $('#select-channel option:selected').val());
            //const queryString = window.location.search;
        });

        $('#select-course').change(function(){
            $('#load a').css('color', '#dfecf6');
            $('#load').append('<img style="position: absolute; left: 45%; top: 10%;" src="https://demos.laraget.com/images/loading2.gif" />');
            getArticles(window.location.pathname + "?user=" + $('#select-user option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&course=" + $('#select-course option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&channel=" + $('#select-channel option:selected').val());
            window.history.pushState({}, '', window.location.pathname + "?user=" + $('#select-user option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&course=" + $('#select-course option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&channel=" + $('#select-channel option:selected').val());
            //const queryString = window.location.search;
        });

        $('#select-date').change(function(){
            $('#load a').css('color', '#dfecf6');
            $('#load').append('<img style="position: absolute; left: 45%; top: 10%;" src="https://demos.laraget.com/images/loading2.gif" />');
            getArticles(window.location.pathname + "?user=" + $('#select-user option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&course=" + $('#select-course option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&channel=" + $('#select-channel option:selected').val());
            window.history.pushState({}, '', window.location.pathname + "?user=" + $('#select-user option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&course=" + $('#select-course option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&channel=" + $('#select-channel option:selected').val());
            //const queryString = window.location.search;
        });

        $('#select-channel').change(function(){
            $('#load a').css('color', '#dfecf6');
            $('#load').append('<img style="position: absolute; left: 45%; top: 10%;" src="https://demos.laraget.com/images/loading2.gif" />');
            getArticles(window.location.pathname + "?user=" + $('#select-user option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&course=" + $('#select-course option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&channel=" + $('#select-channel option:selected').val());
            window.history.pushState({}, '', window.location.pathname + "?user=" + $('#select-user option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&course=" + $('#select-course option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&channel=" + $('#select-channel option:selected').val());
            //const queryString = window.location.search;
        });
            

        @if(isset($_GET['user'])) document.getElementById('select-user').value = '{{ $_GET['user'] }}'; @endif
        @if(isset($_GET['status'])) document.getElementById('select-status').value = '{{ $_GET['status'] }}'; @endif
        @if(isset($_GET['course'])) document.getElementById('select-course').value = '{{ $_GET['course'] }}'; @endif
        @if(isset($_GET['date'])) document.getElementById('select-date').value = '{{ $_GET['date'] }}';
        
        $('#collapse-filters').collapse('show');
        @endif
        @if(isset($_GET['channel'])) document.getElementById('select-channel').value = '{{ $_GET['channel'] }}'; @endif
            
    });


            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                $('#load a').css('color', '#dfecf6');
                $('#load').append('<img style="position: absolute; left: 45%; top: 10%;" src="https://demos.laraget.com/images/loading2.gif" />');

                var url = $(this).attr('href');
                getArticles(url);
                window.history.pushState("", "", url);
            });

            function getArticles(url) {
                $.ajax({
                    url : url
                }).done(function (data) {
                    $('.films').html(data);
                }).fail(function () {
                    alert('Films could not be loaded.');
                });
            }

            setInterval(function(){
                getArticles(window.location.href)
            }, 30000);
@endsection