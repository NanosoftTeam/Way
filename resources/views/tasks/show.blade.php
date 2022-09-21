@extends('layouts.app')

@section('javascript2')
function myFunction(id1, name) {
    let czy = prompt("Usunąć kurs tak/nie? nazwa: " + name);

    if (czy == "tak") {
        $.ajax({
            method: "GET",
            url: "{{ config('app.url', 'Laravel') }}/tasks/d/" + id1,
        data: { id: id1}
        })
        .done(function( msg ) {
            window.location.href = "{{ route('tasks.index') }}";
            
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection

@section('content')
<?php
$status  = array("Pomysł", "Do zrobienia", "W trakcie", "Testy", "Gotowe");
$color = array("secondary", "danger", "warning", "primary", "success");
$channel  = array("Infast", "Infast Animations");
$category  = array("Mine-imator", "MCreator", "MC Animation");
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" id="task-info">
            @include('tasks.show-load')
            
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="edit_task" tabindex="-2" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="overflow-y: auto !important;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Zadanie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form  action="#" id="form-edit-task">
                <table class="table table-sm" id="table-deadline-info">

                <thead>
                    
                </thead>
                <tbody>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%" data-field="name">Name</td>
                        <td id="t-name"><input name="name" id="name2" type="text" class="form-control form-control2" required></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Status</td>
                        <td id="t-status">
                            <select id="status2" class="form-control form-control2" name="status" value="" required autocomplete="status">
                                <option class="form-control form-control2 bg-secondary text-white" value="0">Pomysł</option>
                                <option class="form-control form-control2 bg-danger text-white" value="1">Do zrobienia</option>
                                <option class="form-control form-control2 bg-warning text-dark" value="2">W trakcie</option>
                                <option class="form-control form-control2 bg-primary text-white" value="3">Testy</option>
                                <option class="form-control form-control2 bg-success text-white" value="4">Gotowe</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Cel</td>
                        <td id="t-end">
                            <select id="goal_id2" class="form-control form-control2" name="goal_id" value="" required autocomplete="goal_id">
                                <option class="form-control form-control2" value="">Brak</option>
                                @foreach($goals as $goal)
                                    <option class="form-control form-control2" value="{{ $goal->id }}">{{ $goal->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Deadline</td>
                        <td >
                            <select id="deadline_id2" class="form-control form-control2" name="deadline_id" value="" required autocomplete="deadline_id">
                                <option class="form-control form-control2" value="">Brak</option>
                                @foreach($deadlines as $deadline)
                                    <option class="form-control form-control2" value="{{ $deadline->id }}">{{ $deadline->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Opis</td>
                        <td ><textarea id="description2" name="description" class="form-control form-control2" rows="4"></textarea></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%" data-field="duration">Czas</td>
                        <td><input name="duration" placeholder="w minutach" id="duration2" type="number" class="form-control form-control2" required></td>
                    </tr> 
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Deadline</td>
                        <td ><input name="end" id="end2" type="date" class="form-control form-control2"></td>
                    </tr>      
                </tbody>
                </table>           
                </form>
                    
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
            $('#show_task').modal('hide');
            $('#edit_task').modal('show');
            $.ajax({
                method: "POST",
                url: "{{ config('app.url', 'Laravel') }}/tasks/edit/" + $(this).data("id"),
                data: { id: $(this).data("id")},
                
                success:function(response)
                {
                    //alert(response);
                    obj = JSON.parse(JSON.stringify(response))
                    //alert(obj.name);

                    //document.getElementById("submit2").data("id") = "{{ config('app.url', 'Laravel') }}/tasks/update/" + obj.id;
                    $('#submit2').attr('data-id' , obj.id);

                    document.getElementById('name2').value = obj.name;
                    document.getElementById('status2').value = obj.status;
                    document.getElementById('goal_id2').value = obj.goal_id;
                    document.getElementById('deadline_id2').value = obj.deadline_id;
                    document.getElementById('description2').value = obj.description;
                    document.getElementById('duration2').value = obj.duration;
                    document.getElementById('end2').value = obj.end;
                    
                }
            })
        })

        $(document).on('click', '#submit2', function() { 
            $('#edit_task').modal('hide');
            
            var id11 = $('#submit2').attr('data-id')
            var status22 = document.getElementById('status2').value;

            document.getElementById('b-edit').innerHTML = "Aktualizowanie...";


            $.ajax({
                method: "POST",
                url: "{{ config('app.url', 'Laravel') }}/tasks/update/" + id11,
                data: $("#form-edit-task").serialize(),
                
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
                    url : url
                }).done(function (data) {
                    $('#task-info').html(data);
                }).fail(function () {
                    alert('tasks could not be loaded.');
                });
            }

            setInterval(function(){
                getArticles(window.location.href)
            }, 30000);
@endsection
