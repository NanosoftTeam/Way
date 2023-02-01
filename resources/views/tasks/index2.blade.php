@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('javascript2')
function myFunction(id1, name) {
    let czy = prompt("Usunąć zadanie tak/nie? nazwa: " + name);

    if (czy == "tak") {
        $.ajax({
            method: "GET",
            url: "{{ config('app.url', 'Laravel') }}/tasks/d/" + id1,
        data: { id: id1}
        })
        .done(function( msg ) {
            getArticles(window.location.href);
            $('#show_task').modal('hide');
            
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-sm-2" style="min-width: 200px; margin-bottom: 10px;">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            Cele i deadliney
                        </span>

                            <div class="float-right">
                            <a href="{{ route('goals.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                <i class="fa-solid fa-plus"></i> Nowy
                            </a>
                            </div>
                    </div>
                </div>
                

                <div class="card-body">
                    @foreach($goals as $goal)
                        <div>
                            <div class="d-flex justify-content-between align-items-center"><a data-toggle="collapse" class="h5 text-dark" href="#goal{{ $goal->id }}" role="button" aria-expanded="false" aria-controls="collapse-application" class="collapsed"><i class="fa-solid fa-caret-down"></i> {{ $goal->name }}</a> <a href="{{ route('goals.edit', $goal->id) }}"><span class="badge badge-light badge-pill"><i class="fa-solid fa-pen"></i></span></a> </div>
                            <div class="multi-collapse collapse @if($goal->id == ($_GET['goal'] ?? '')) show @endif" id="goal{{ $goal->id }}" style="">
                                <ul class="list-group list-group-flush">
                                    @foreach($goal->deadlines as $deadline)
                                        <li class="list-group-item d-flex justify-content-between align-items-center"><a href="{{ route('tasks.index2').'?goal='.$goal->id.'&status=a&deadline='.$deadline->id.'&date=a&parent=0&projects=0&user=a&search=' }}" @if($deadline->id == ($_GET['deadline'] ?? '')) class="font-weight-bold" @endif>{{ $deadline->name }}</a> <a href="{{ route('deadlines.edit', $deadline->id) }}"><span class="badge badge-primary badge-pill"><i class="fa-solid fa-pen"></i></span></a></li>
                                    @endforeach
                                    <li class="list-group-item"><a href="{{ route('deadlines.create2',  $goal->id) }}"><i class="fa-solid fa-plus"></i> Nowy</a></li>
                                </ul>
                            </div>
                        </div>
                        <br />
                    @endforeach
                    @if($deadline_n_g->count() > 0)
                    <div>
                        <a data-toggle="collapse" class="h5 text-dark" href="#goal-other" role="button" aria-expanded="false" aria-controls="collapse-application" class="collapsed"><i class="fa-solid fa-caret-down"></i> Inne</a>
                        <div class="multi-collapse collapse show" id="goal-other" style="">
                            <ul class="list-group list-group-flush">
                            @foreach($deadline_n_g as $deadline)
                                <li class="list-group-item d-flex justify-content-between align-items-center"><a href="{{ route('tasks.index2').'?goal=a&status=a&deadline='.$deadline->id.'&date=a&parent=0&projects=0&user=a&search=' }}">{{ $deadline->name }}</a> <a href="{{ route('deadlines.edit', $deadline->id) }}"><span class="badge badge-primary badge-pill"><i class="fa-solid fa-pen"></i></span></a></li>
                            @endforeach
                            <li class="list-group-item"><a href="{{ route('deadlines.create') }}"><i class="fa-solid fa-plus"></i> Nowy</a></li>
                            </ul>
                        </div>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <b>Zadania</b> | 
                    <button type="button" data-toggle="modal" data-target="#add_task" class="btn btn-primary btn-sm pull-right" id="add-t"><i class="fa-solid fa-plus"></i> Nowe</button>
                    <a href="{{ route('task.editdate') }}"><button type="button" data-toggle="modal" class="btn btn-secondary btn-sm pull-right"> Zmiana dat</button></a>
                    <label class=""><input type="checkbox" name="only-projects" class="select-f" id="only-projects"> Tylko projekty</label>
                    
                    
                    <a data-toggle="collapse" href="#collapse-filters" role="button" aria-expanded="false" aria-controls="collapse-filters"><button type="button" class="btn btn-link"><i class="fa-solid fa-filter"></i> Filtry</button></a>

                </div>
                <div class="card-header collapse multi-collapse" id="collapse-filters">
                    <div class="form-inline">
                        <input name="search" id="search" placeholder="Szukaj" type="text" class="form-control float-left select-f" style="width: 180px;">
                        <select class="form-control select-f" id="select-goal" style="width: 180px;" hidden>
                            <option value="a" class="">Wszystkie cele</option>
                            <option value="b">Brak</option>
                            @foreach($goals as $goal)
                                <option class="form-control" value="{{ $goal->id }}">{{ $goal->name }}</option>
                            @endforeach
                        </select>
                        <select class="form-control float-left select-f" id="select-status" style="width: 180px;">
                            <option value="a">Niewykonane</option>
                            <option value="b">Wszystkie</option>
                            <option value="0">Pomysł</option>
                            <option value="1">Do zrobienia</option>
                            <option value="2">W trakcie</option>
                            <option value="3">Testy</option>
                            <option value="4">Gotowe</option>
                        </select>
                        <select class="form-control select-f" id="select-deadline" style="width: 180px;">
                            <option value="a">Wszystkie deadliney</option>
                            <option value="b">Bez deadlineu</option>
                            @foreach($deadlines as $deadline)
                                <option class="form-control" value="{{ $deadline->id }}">{{ $deadline->name }}</option>
                            @endforeach
                        </select>
                        <select class="form-control float-left select-f" id="select-date" style="width: 180px;">
                            <option value="a">Wszystkie daty</option>
                            <option value="1">Do dzisiaj (<=)</option>
                            <option value="2">Bez daty</option>
                            <option value="3">Przeterminowane</option>
                        </select>
                        <select class="form-control select-f" id="select-user" style="width: 180px;">
                            <option value="a" class="">Wszystkie osoby</option>
                            @if(Session::get('team_id') != 0)
                            <option value="b">Brak osoby</option>
                            @foreach($users as $user)
                                <option class="form-control" value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="card-body" style="padding-top: 0px;">
                
                            <section class="tasks">
                                @include('tasks.load')
                            </section>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="modal fade bd-example-modal-lg" id="add_task" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Zadanie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  action="#" id="form-add-task">
                        <table class="table table-sm" id="table-deadline-info">

                        <thead>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Name</td>
                                <td id="t-name"><input name="name" id="name" type="text" class="form-control form-control2" required></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%">Status</td>
                                <td id="t-status">
                                    <select id="status" class="form-control form-control2" name="status" value="" required autocomplete="status">
                                        <option class="form-control form-control2 bg-secondary text-white" value="0">Pomysł</option>
                                        <option class="form-control form-control2 bg-danger text-white" value="1" selected>Do zrobienia</option>
                                        <option class="form-control form-control2 bg-warning text-dark" value="2">W trakcie</option>
                                        <option class="form-control form-control2 bg-primary text-white" value="3">Testy</option>
                                        <option class="form-control form-control2 bg-success text-white" value="4">Gotowe</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%">Cel</td>
                                <td id="t-end">
                                    <select id="goal_id" class="form-control form-control2" name="goal_id" value="" required autocomplete="goal_id">
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
                                    <select id="deadline_id" class="form-control form-control2" name="deadline_id" value="" required autocomplete="deadline_id">
                                        <option class="form-control form-control2" value="">Brak</option>
                                        @foreach($deadlines as $deadline)
                                            <option class="form-control form-control2" value="{{ $deadline->id }}">{{ $deadline->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%">Opis</td>
                                <td ><textarea id="description" name="description" class="form-control form-control2" rows="4"></textarea></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Czas</td>
                                <td><input name="duration" id="duration" type="number" class="form-control form-control2" required></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%">Deadline</td>
                                <td ><input name="end" id="end" type="date" class="form-control form-control2"></td>
                            </tr>
                            @if(Session::get('team_id') != 0)
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%">User</td>
                                <td >
                                    <select id="user_id" class="form-control form-control2" name="user_id" value="" required autocomplete="user_id">
                                        <option class="form-control form-control2" value="">Brak</option>
                                        @foreach($team_users as $user1)
                                            <option class="form-control form-control2" value="{{ $user1->id }}">{{ $user1->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            @endif  
                        </tbody>
                    </table>



                    </form>
                    @if(Session::get('team_id') != 0)
                    Widoczne dla {{ Auth::user()->team->name }}
                    @else
                    Prywatne
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit" data-id="" >Zapisz</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                </div>
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
                            <td><input name="duration" id="duration2" type="number" class="form-control form-control2" required></td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Deadline</td>
                            <td ><input name="end" id="end2" type="date" class="form-control form-control2"></td>
                        </tr>
                        @if(Session::get('team_id') != 0)
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">User</td>
                            <td >
                                <select id="user_id2" class="form-control form-control2" name="user_id" value="" required autocomplete="user_id">
                                    <option class="form-control form-control2" value="">Brak</option>
                                    @foreach($team_users as $user1)
                                        <option class="form-control form-control2" value="{{ $user1->id }}">{{ $user1->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                    </table>
                    </form>
                    @if(Session::get('team_id') != 0)
                    Widoczne dla {{ Auth::user()->team->name }}
                    @else
                    Prywatne
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit2" data-id="" >Zapisz</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="show_task" tabindex="-3" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Zadanie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-show-task" style="padding-top: 0px;">
                    ...
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    

    $( document ).ready(function() {
        let parent = @if(isset($_GET['parent'])) {{ $_GET['parent'] }} @else 0 @endif;
        let deadline = @if(isset($_GET['deadline'])) '{{ $_GET['deadline'] }}' @else 'a' @endif;
        let goal = @if(isset($_GET['goal'])) '{{ $_GET['goal'] }}' @else 'a' @endif;
        let user1 = @if(isset($_GET['user'])) '{{ $_GET['user'] }}' @else 'a' @endif;
        let l_parent;

        

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
                        @if(Session::get('team_id') != 0)
                            document.getElementById('user_id2').value = obj.user_id;
                        @endif
                    }
                })
            
        })

        var interval2;

        $(document).on('click', '.show2', function() {
            if($(this).data("child") == " 1 "){
                //alert("ma podzadania");
                l_parent = parent;
                parent = $(this).data("id");

                $('#load a').css('color', '#dfecf6');
                $('#load').append('<img style="position: absolute; left: 45%; top: 10%;" src="https://demos.laraget.com/images/loading2.gif" />');
                var only_projects = 0;
                if($("#only-projects").is(":checked")){
                    only_projects = 1;
                }
                getArticles(window.location.pathname + "?goal=" + $('#select-goal option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&deadline=" + $('#select-deadline option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&parent=" + parent + "&projects=" + only_projects + "&search=" + $('#search').val());
                window.history.pushState({}, '', window.location.pathname + "?goal=" + $('#select-goal option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&deadline=" + $('#select-deadline option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&parent=" + parent + "&projects=" + only_projects + "&search=" + $('#search').val());
            }
            else{
                $('#show_task').modal('show');
                $('#modal-show-task').html('<img style="display: block; margin: 0 auto;" src="https://demos.laraget.com/images/loading2.gif" />');

                $.ajax({
                        url : "{{ config('app.url', 'Laravel') }}/tasks/m/" + $(this).data("id"),
                    }).done(function (data) {
                        $('#modal-show-task').html(data);
                    }).fail(function () {
                        alert('Modal could not be loaded.');
                });

                var mid = $(this).data("id"); 

                interval2 = setInterval(function(){
                    $.ajax({
                        url : "{{ config('app.url', 'Laravel') }}/tasks/m/" + mid,
                    }).done(function (data) {
                        $('#modal-show-task').html(data);
                    }).fail(function () {
                        alert('Modal could not be loaded.');
                    });
                }, 30000);
            }
            
        })

        $(document).on('click', '.b-last', function() {
            l_parent = $(this).data("last");
            parent = l_parent;
            
            $('#load a').css('color', '#dfecf6');
            $('#load').append('<img style="position: absolute; left: 45%; top: 10%;" src="https://demos.laraget.com/images/loading2.gif" />');
            var only_projects = 0;
            if($("#only-projects").is(":checked")){
                only_projects = 1;
            }
            getArticles(window.location.pathname + "?goal=" + $('#select-goal option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&deadline=" + $('#select-deadline option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&parent=" + parent + "&projects=" + only_projects + "&search=" + $('#search').val());
            window.history.pushState({}, '', window.location.pathname + "?goal=" + $('#select-goal option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&deadline=" + $('#select-deadline option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&parent=" + parent + "&projects=" + only_projects + "&search=" + $('#search').val());
            
        })

        $('#show_task').on('hidden.bs.modal', function () {
            clearInterval(interval2);
        });

        var status  = ["Pomysł", "Do zrobienia", "W trakcie", "Testy", "Gotowe"];
        var color = ["secondary", "danger", "warning", "primary", "success"];

        $(document).on('click', '#submit2', function() { 
            
            $('#submit2').attr('disabled', true);
            var id11 = $('#submit2').attr('data-id')
            var status22 = document.getElementById('status2').value;

            document.getElementById('t' + id11).innerHTML = document.getElementById('name2').value;
            document.getElementById('s' + id11).innerHTML = '<span class="badge badge-pill badge-' + color[status22] + '">' + status[status22] + '</span>';
            document.getElementById('e' + id11).innerHTML = "czekaj...";
            


            $.ajax({
                method: "POST",
                url: "{{ config('app.url', 'Laravel') }}/tasks/update/" + id11,
                data: $("#form-edit-task").serialize(),
                
                success:function(response)
                {
                    getArticles(window.location.href);
                    $('#edit_task').modal('hide');
                    $('#submit2').attr('disabled', false);
                    
                },
                error: function(response)
                {
                    alert("error");
                    $('#submit2').attr('disabled', false);
                    getArticles(window.location.href);
                    
                }
                
            })

            $('#submit2').attr('data-id' , "");
           
        })

       
        $(document).on('click', '#add-t', function() {
            if(parent != 0){
                document.getElementById("parent_id").value = parent;
                
            }
            if(deadline != 'a'){
                document.getElementById("deadline_id").value = deadline;
                
            }
            else{
                document.getElementById("deadline_id").value = 0;
            }

            if(goal != 'a'){
                document.getElementById("goal_id").value = goal;
                
            }
            else{
                document.getElementById("goal_id").value = 0;
            }

            if(user1 != 'a'){
                document.getElementById("user_id").value = user1;
                
            }
            else{
                document.getElementById("user_id").value = 0;
            }
            
            
           
        })

        
        $(document).on('click', '#submit', function() { 
            
            $('#submit').attr('disabled', true);
            $.ajax({
                method: "POST",
                url: "{{ config('app.url', 'Laravel') }}/tasks/new" ,
                data: $("#form-add-task").serialize(),
                
                success:function(response)
                {
                    document.getElementById("form-add-task").reset();
                    
                    

                    getArticles(window.location.href);
                    $('#add_task').modal('hide');
                    $('#submit').attr('disabled', false);
                },
                error: function(response)
                {
                    alert("error");
                    $('#submit').attr('disabled', false);
                    getArticles(window.location.href);
                    
                }
                
            })
           
        })

        $(document).on('change', '.select-f', function() {
            $('#load a').css('color', '#dfecf6');
            $('#load').append('<img style="position: absolute; left: 45%; top: 10%;" src="https://demos.laraget.com/images/loading2.gif" />');
            var only_projects = 0;
            if($("#only-projects").is(":checked")){
                only_projects = 1;
            }
            getArticles(window.location.pathname + "?goal=" + $('#select-goal option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&deadline=" + $('#select-deadline option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&parent=" + parent + "&projects=" + only_projects + "&user=" + $('#select-user option:selected').val() + "&search=" + $('#search').val());
            window.history.pushState({}, '', window.location.pathname + "?goal=" + $('#select-goal option:selected').val() + "&status=" + $('#select-status option:selected').val() + "&deadline=" + $('#select-deadline option:selected').val() + "&date=" + $('#select-date option:selected').val() + "&parent=" + parent + "&projects=" + only_projects  + "&user=" + $('#select-user option:selected').val() +  "&search=" + $('#search').val());
            //const queryString = window.location.search;
            deadline = $('#select-deadline option:selected').val();
            goal = $('#select-goal option:selected').val();
            user1 = $('#select-user option:selected').val();
        });
            

        @if(isset($_GET['goal'])) document.getElementById('select-goal').value = '{{ $_GET['goal'] }}'; @endif
        @if(isset($_GET['status'])) document.getElementById('select-status').value = '{{ $_GET['status'] }}'; @endif
        @if(isset($_GET['deadline'])) document.getElementById('select-deadline').value = '{{ $_GET['deadline'] }}'; @endif
        @if(isset($_GET['date'])) document.getElementById('select-date').value = '{{ $_GET['date'] }}'; 
        $('#collapse-filters').collapse('show');
        @endif
        @if(isset($_GET['search'])) document.getElementById('search').value = '{{ $_GET['search'] }}'; @endif
        @if(isset($_GET['user'])) document.getElementById('select-user').value = '{{ $_GET['user'] }}'; @endif
        @if(isset($_GET['projects']) and $_GET['projects'] == 1) $("#only-projects").prop('checked', true); @endif
        
            
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
                    $('.tasks').html(data);
                }).fail(function () {
                    alert('tasks could not be loaded.');
                });
            }

            setInterval(function(){
                getArticles(window.location.href)
            }, 30000);
@endsection