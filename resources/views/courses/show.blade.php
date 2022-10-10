@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

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
            window.location.href = "{{ route('courses.index') }}";
            
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection

@section('content')
<?php
$status  = array("Pomysł", "Oczekuje", "Otwarty", "Zamknięty");
$color = array("secondary", "primary", "success", "danger");
$channel  = array("Infast", "Infast Animations");
$category  = array("Mine-imator", "MCreator", "MC Animation");
?>

<div class="container">
        <div id="course-info">
            @include('courses.show-load')
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

        $(document).on('click', '#submit2', function() { 
            $('#edit_course').modal('hide');
            
            var id11 = $('#submit2').attr('data-id')
            var status22 = document.getElementById('status2').value;

            document.getElementById('b-edit').innerHTML = "Aktualizowanie...";


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
                    url : '{{ route('courses.tab_info', $course->id) }}'
                }).done(function (data) {
                    $('#n-info').html(data);
                }).fail(function () {
                    alert('Course could not be loaded.');
                });

                $.ajax({
                    url : '{{ route('courses.tab_films', $course->id) }}'
                }).done(function (data) {
                    $('#nav-films').html(data);
                }).fail(function () {
                    alert('Films could not be loaded.');
                });
            }

            setInterval(function(){
                getArticles(window.location.href)
            }, 30000);
@endsection
