@extends('layouts.app')

@section('javascript2')
function myFunction(id1, name) {
    let czy = prompt("Usunąć kurs tak/nie? nazwa: " + name);

    if (czy == "tak") {
        $.ajax({
            method: "GET",
            url: "{{ config('app.url', 'Laravel') }}/courses/d/" + id1,
        data: { id: id1}
        })
        .done(function( msg ) {
            getArticles(window.location.href);
            $('#show_course').modal('hide');
            
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
            <b>Kursy</b> | 
            <button type="button" data-toggle="modal" data-target="#add_course" class="btn btn-primary btn-sm pull-right">Nowy</button>
            <a href="{{ route('films.index') }}"><button type="button" data-toggle="modal" class="btn btn-secondary btn-sm pull-right">Filmy</button></a>
        </div>

        <div class="card-body">
            <section class="courses">
                @include('courses.load')
            </section>
        </div>
    </div>
    
</div>

<div class="modal fade bd-example-modal-lg" id="add_course" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kurs</h5>
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
                        <td class="table-active text-secondary" style="width: 20%">Nazwa</td>
                        <td id="t-name"><input name="name" id="name" type="text" class="form-control form-control2" required></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Kanał</td>
                        <td id="t-channel">
                            <select id="channel" class="form-control form-control2" name="channel" value="" required autocomplete="channel">
                                <option class="form-control form-control2" value="0">Infast</option>
                                <option class="form-control form-control2" value="1">Infast Animations</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Kategoria</td>
                        <td id="t-category"><input name="category" id="category" type="text" class="form-control form-control2"></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Opis</td>
                        <td ><textarea id="description" class="form-control form-control2" rows="4"></textarea></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Odcinki (planowane)</td>
                        <td ><input name="p_episodes" id="p_episodes" type="number" class="form-control form-control2" required></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Status opisowy</td>
                        <td ><textarea id="longstatus" class="form-control form-control2" rows="3"></textarea></td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Cel</td>
                        <td ><textarea id="goal" class="form-control form-control2" rows="4"></textarea></td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Status</td>
                        <td >
                            <select id="status" class="form-control form-control2" name="status" value="" required autocomplete="status">
                                <option class="form-control form-control2" value="0">Pomysł</option>
                                <option class="form-control form-control2" value="1">Oczekuje</option>
                                <option class="form-control form-control2" value="2">Otwarty</option>
                                <option class="form-control form-control2" value="3">Zamknięty</option>
                            </select>
                        </td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Link YT</td>
                        <td ><input name="yt" id="yt" type="text" class="form-control form-control2"></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Link Scenariusz</td>
                        <td ><input name="scenario" id="scenario" type="text" class="form-control form-control2"></td>
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

    <div class="modal fade bd-example-modal-lg" id="edit_course" tabindex="-2" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="overflow-y: auto !important;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kurs</h5>
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
                        <td class="table-active text-secondary" style="width: 20%">Nazwa</td>
                        <td id="t-name"><input name="name" id="name2" type="text" class="form-control form-control2" required></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Kanał</td>
                        <td id="t-channel">
                            <select id="channel2" class="form-control form-control2" name="channel" value="" required autocomplete="channel">
                                <option class="form-control form-control2" value="0">Infast</option>
                                <option class="form-control form-control2" value="1">Infast Animations</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Kategoria</td>
                        <td id="t-category"><input name="category" id="category2" type="text" class="form-control form-control2"></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Opis</td>
                        <td ><textarea id="description2" class="form-control form-control2" rows="4"></textarea></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Odcinki (planowane)</td>
                        <td ><input name="p_episodes" id="p_episodes2" type="number" class="form-control form-control2" required></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Status opisowy</td>
                        <td ><textarea id="longstatus2" class="form-control form-control2" rows="3"></textarea></td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Cel</td>
                        <td ><textarea id="goal2" class="form-control form-control2" rows="4"></textarea></td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Status</td>
                        <td >
                            <select id="status2" class="form-control form-control2" name="status" value="" required autocomplete="status">
                                <option class="form-control form-control2" value="0">Pomysł</option>
                                <option class="form-control form-control2" value="1">Oczekuje</option>
                                <option class="form-control form-control2" value="2">Otwarty</option>
                                <option class="form-control form-control2" value="3">Zamknięty</option>
                            </select>
                        </td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Link YT</td>
                        <td ><input name="yt" id="yt2" type="text" class="form-control form-control2"></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Link Scenariusz</td>
                        <td ><input name="scenario" id="scenario2" type="text" class="form-control form-control2"></td>
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

    <div class="modal fade bd-example-modal-lg" id="show_course" tabindex="-3" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kurs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-show-course">
                    ...
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    

    $( document ).ready(function() {
        
        $(document).on('click', '.edit', function() {
            $('#show_course').modal('hide');
            $('#edit_course').modal('show');
            $.ajax({
                method: "POST",
                url: "{{ config('app.url', 'Laravel') }}/courses/edit/" + $(this).data("id"),
                data: { id: $(this).data("id")},
                
                success:function(response)
                {
                    //alert(response);
                    obj = JSON.parse(JSON.stringify(response))
                    //alert(obj.name);

                    //document.getElementById("submit2").data("id") = "{{ config('app.url', 'Laravel') }}/courses/update/" + obj.id;
                    $('#submit2').attr('data-id' , obj.id);

                    document.getElementById('name2').value = obj.name;
                    document.getElementById('channel2').value = obj.channel;
                    document.getElementById('category2').value = obj.category;
                    document.getElementById('p_episodes2').value = obj.p_episodes;
                    document.getElementById('yt2').value = obj.yt;
                    document.getElementById('scenario2').value = obj.scenario;
                    document.getElementById('status2').value = obj.status;
                    document.getElementById('description2').value = obj.description;
                    document.getElementById('goal2').value = obj.goal;
                    document.getElementById('longstatus2').value = obj.longstatus;
                    
                }
            })
        })

        var interval2;

        $(document).on('click', '.show2', function() { 
            $('#show_course').modal('show');
            $('#modal-show-course').html('<img style="display: block; margin: 0 auto;" src="https://demos.laraget.com/images/loading2.gif" />');

            $.ajax({
                    url : "{{ config('app.url', 'Laravel') }}/courses/m/" + $(this).data("id"),
                }).done(function (data) {
                    $('#modal-show-course').html(data);
                }).fail(function () {
                    alert('Modal could not be loaded.');
            });

            var mid = $(this).data("id"); 

            interval2 = setInterval(function(){
                $.ajax({
                    url : "{{ config('app.url', 'Laravel') }}/courses/info/" + mid,
                }).done(function (data) {                 
                    $('#nav-info').html(data);
                   
                }).fail(function () {
                    alert('Modal could not be loaded.');
                });

                $.ajax({
                    url : "{{ config('app.url', 'Laravel') }}/courses/films/" + mid,
                }).done(function (data) {                 
                    $('#nav-films').html(data);
                   
                }).fail(function () {
                    alert('Modal could not be loaded.');
                });
            }, 30000);
        })

        $('#show_course').on('hidden.bs.modal', function () {
            clearInterval(interval2);
        });

        var status  = ["Pomysł", "Oczekuje", "Otwarty", "Zamknięty"];
        var color = ["secondary", "primary", "success", "danger"];

        $(document).on('click', '#submit2', function() { 
            $('#edit_course').modal('hide');
            
            var id11 = $('#submit2').attr('data-id')
            var status22 = document.getElementById('status2').value;

            document.getElementById('t' + id11).innerHTML = document.getElementById('name2').value;
            document.getElementById('s' + id11).innerHTML = '<span class="badge badge-pill badge-' + color[status22] + '">' + status[status22] + '</span>';
            document.getElementById('e' + id11).innerHTML = "czekaj...";


            $.ajax({
                method: "POST",
                url: "{{ config('app.url', 'Laravel') }}/courses/update/" + id11,
                data: {
                    id: id11,
                    name: document.getElementById('name2').value,
                    channel: document.getElementById('channel2').value,
                    category: document.getElementById('category2').value,
                    p_episodes: document.getElementById('p_episodes2').value,
                    yt: document.getElementById('yt2').value,
                    scenario: document.getElementById('scenario2').value,
                    status: document.getElementById('status2').value,
                    description: document.getElementById('description2').value,
                    goal: document.getElementById('goal2').value,
                    longstatus: document.getElementById('longstatus2').value,
                    },
                
                success:function(response)
                {
                    getArticles(window.location.href);
                    
                    
                }
            })

            $('#submit2').attr('data-id' , "");
           
        })

       

        $(document).on('click', '#submit', function() { 
            $('#add_course').modal('hide');
            $.ajax({
                method: "POST",
                url: "{{ config('app.url', 'Laravel') }}/courses" ,
                data: {
                    name: document.getElementById('name').value,
                    channel: document.getElementById('channel').value,
                    category: document.getElementById('category').value,
                    p_episodes: document.getElementById('p_episodes').value,
                    yt: document.getElementById('yt').value,
                    scenario: document.getElementById('scenario').value,
                    status: document.getElementById('status').value,
                    description: document.getElementById('description').value,
                    goal: document.getElementById('goal').value,
                    longstatus: document.getElementById('longstatus').value,
                    },
                
                success:function(response)
                {
                    document.getElementById('name').value = "";
                    document.getElementById('channel').value = "0";
                    document.getElementById('category').value = "";
                    document.getElementById('p_episodes').value = "";
                    document.getElementById('yt').value = "";
                    document.getElementById('scenario').value = "";
                    document.getElementById('status').value = "0";
                    document.getElementById('description').value = "";
                    document.getElementById('goal').value = "";
                    document.getElementById('longstatus').value = "";
                    

                    getArticles(window.location.href);
                }
            })
           
        })

        
            
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
                    $('.courses').html(data);
                }).fail(function () {
                    alert('courses could not be loaded.');
                });
            }

            setInterval(function(){
                getArticles(window.location.href)
            }, 30000);
@endsection