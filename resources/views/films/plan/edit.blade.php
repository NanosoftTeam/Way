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
        <div class="row border-bottom">
            <h4>Planowanie filmu - zmień szczegóły</h4>

        </div>
        <br />
        <form name="add_name" id="add_name" method="POST" action="{{ route('films.plan.update', $film->id) }}">
                <table class="table table-sm" id="table-film-info">

                    <thead>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="title">Tytuł</td>
                            <td id="t-title"><input name="title" id="title2" value="{{ $film->title }}" type="text" class="form-control form-control2" required></td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Początek prac</td>
                            <td id="t-start"><input name="start" id="start2" value="{{ $film->start }}" type="date" class="form-control form-control2"></td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Publikacja</td>
                            <td id="t-end"><input name="end" id="end2" value="{{ $film->end }}" type="date" class="form-control form-control2"></td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Status</td>
                            <td >
                                <select id="status2" class="form-control form-control2" name="status" value="" required autocomplete="status" value="{{ $film->status }}">
                                    <option class="form-control form-control2" value="0" @if($film->status == 0) selected @endif>Pomysł</option>
                                    <option class="form-control form-control2" value="1" @if($film->status == 1) selected @endif>Wstrzymany</option>
                                    <option class="form-control form-control2" value="2" @if($film->status == 2) selected @endif>Do zrealizowania</option>
                                    <option class="form-control form-control2" value="3" @if($film->status == 3) selected @endif>Plan</option>
                                    <option class="form-control form-control2" value="4" @if($film->status == 4) selected @endif>Scenariusz</option>
                                    <option class="form-control form-control2" value="5" @if($film->status == 5) selected @endif>Nagrywanie</option>
                                    <option class="form-control form-control2" value="6" @if($film->status == 6) selected @endif>Montaż</option>
                                    <option class="form-control form-control2" value="7" @if($film->status == 7) selected @endif>Uploadowanie</option>
                                    <option class="form-control form-control2" value="8" @if($film->status == 8) selected @endif>Oczekuje na publikację</option>
                                    <option class="form-control form-control2" value="9" @if($film->status == 9) selected @endif>Opublikowany</option>
                                    <option class="form-control form-control2" value="10" @if($film->status == 10) selected @endif>Koniec</option>
                                </select>
                            </td>
                        </tr>  
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Kanał</td>
                            <td >
                                <select id="channel2" class="form-control form-control2" name="channel" value="" required autocomplete="channel" value="{{ $film->channel }}">
                                    <option class="form-control form-control2" value="0" @if($film->channel == 0) selected @endif>Infast</option>
                                    <option class="form-control form-control2" value="1" @if($film->channel == 1) selected @endif>Infast Animations</option>
                                </select>
                            </td>
                        </tr>  
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Rodzaj</td>
                            <td >
                                <select id="type2" class="form-control form-control2" name="type" value="" required autocomplete="type" value="{{ $film->type }}">
                                    <option class="form-control form-control2" value="0" @if($film->type == 0) selected @endif>Film</option>
                                    <option class="form-control form-control2" value="1" @if($film->type == 1) selected @endif>Odcinek kursu</option>
                                    <option class="form-control form-control2" value="2" @if($film->type == 2) selected @endif>Short</option>
                                </select>
                            </td>
                        </tr>  
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Kurs</td>
                            <td id="t-course">
                                <select id="course2" class="form-control form-control2" name="course_id" required autocomplete="course" value="{{ $film->course }}">
                                    @foreach($courses as $course)
                                        <option class="form-control form-control2" value="{{ $course->id }}" @if($film->course_id == $course->id) selected @endif>{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>  
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Opiekun</td>
                            <td >
                                <select id="person2" class="form-control form-control2" name="person" value="" required autocomplete="person" value="{{ $film->person }}">
                                    <option class="form-control form-control2" value="0">User</option>
                                    @foreach($users as $user)
                                        <option class="form-control form-control2" value="{{ $user->id }}" @if($film->person == $user->id) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Opis</td>
                            <td ><textarea id="description" name="description" class="form-control form-control2" rows="4">{{ $film->description }}</textarea></td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Status opisowy</td>
                            <td ><textarea id="longstatus2" name="longstatus" class="form-control form-control2" rows="3" >{{ $film->longstatus }}</textarea></td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Link YT</td>
                            <td >
                                <input name="yt" id="yt2" type="text" class="form-control form-control2" value="{{ $film->yt }}">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Link scenariusz</td>
                            <td >
                                <input name="scenario" id="scenario2" type="text" class="form-control form-control2" value="{{ $film->scenario }}">
                            </td>
                        </tr>        
                    </tbody>
                </table>

                <br />
        <div class="row border-bottom">
            <h4>Dodaj zadania</h4>
        </div>
        <br />
        <div class="form-group">
            
          

            <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
            </div>

            <div class="alert alert-success print-success-msg" style="display:none">
            <ul></ul>
            </div>

                <table class="table table-sm table-bordered table-hover" id="dynamic_field"> 
                    <tr>
                        <div id="copy">
                        <td><textarea id="n_task_n" placeholder="Enter task" name="n_task_n" class="form-control form-control2 name_list" rows="1"></textarea>
                        </div>
                        <td><button type="button" name="add" id="add" class="btn btn-sm btn-success"><i class="fa-solid fa-plus"></i> Dodaj</button></td>  
                    </tr>  
                </table>

        </div>

        <div class="row border-bottom">
            <h4>Edytuj zadania</h4>
        </div>
        <br />
        <div class="form-group">
            
          

            <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
            </div>

            <div class="alert alert-success print-success-msg" style="display:none">
            <ul></ul>
            </div>

                <table class="table table-sm table-bordered table-hover" id="dynamic_field">
                    @foreach($tasks as $task)
                        <tr class="dynamic-added">
                            <td><input type="text" name="tasks[{{ $task->id }}][name]" placeholder="Enter task" class="form-control form-control2 name_list" value="{{ $task->name }}"></td>
                            <td>
                                <select id="user_id" class="form-control form-control2" name="tasks[{{ $task->id }}][user_id]" autocomplete="user_id" value="0">
                                    <option class="form-control form-control2" value="" @if($task->user_id == NULL) selected @endif>Brak osoby</option>
                                    @foreach($users as $user)
                                        <option class="form-control form-control2" value="{{ $user->id }}" @if($task->user_id == $user->id) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="">
                                <select id="status2" class="form-control form-control2 @if($task->status == 0) text-success  @endif" name="tasks[{{ $task->id }}][status]" value="" autocomplete="status" value="{{ $task->status }}">
                                    <option class="form-control form-control2 bg-secondary text-white" value="0" @if($task->status == 0) selected @endif>Pomysł</option>
                                    <option class="form-control form-control2 bg-danger text-white" value="1" @if($task->status == 1) selected @endif>Do zrobienia</option>
                                    <option class="form-control form-control2 bg-warning text-dark" value="2" @if($task->status == 2) selected @endif>W trakcie</option>
                                    <option class="form-control form-control2 bg-primary text-white" value="3" @if($task->status == 3) selected @endif>Testy</option>
                                    <option class="form-control form-control2 bg-success text-white" value="4" @if($task->status == 4) selected @endif>Gotowe</option>
                                </select>
                            </td>
                            <td>
                                <input name="tasks[{{ $task->id }}][end]" type="date" value="{{ $task->end }}" class="form-control form-control2 @if($task->end == NULL and $task->status > 0 and $task->status != 4) text-primary @endif">
                            </td>
                            <td><label class="text-danger"><input type="checkbox" name="tasks[{{ $task->id }}][delete]"> <i class="fa-solid fa-trash-can"></i>Usuń</label></td>
                        </tr>
                    @endforeach
                </table>
        <p class="text-primary">*Bez daty deadline, status zaplanowany, nieskośczony</p>
        <p class="text-success">*Status pomysł/niezaplanowane</p>
        </div>

        <div class="row border-bottom">
            <h4>Zapisz</h4>
        </div>
        <br />
            <label>Przypisz deadline do zadań bez niego (<b class="text-primary">tych</b>):<input name="date" id="date" type="date" class="form-control form-control2 float-left"></label>
            <br /><br />    
            <button type="submit" class="btn btn-info" name="action" value="save1">Zapisz</button>
            <button type="submit" class="btn btn-info" name="action" value="save2">Zapisz i zobacz film</button>
            <button type="submit" class="btn btn-info" name="action" value="save3">Zapisz i rozplanuj zadania</button>
        </form>  
</div>



    

@endsection
@section('javascript')
$(document).ready(function(){      
      var url = "AA";
      var i=1;  
      
      $('#add').click(function(){  
        var task = $("#n_task_n").val();
        

        var todo = '';
        /*if($('#todo').is(":checked")) {
            var todo = 'checked';
        }
        else{
            var todo = '';
        }*/


        
        var rows = task.split("\n");
        //console.log(rows);

        for (var a1 of rows) {
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="tasksn[' + i + '][name]" placeholder="wpisz nazwę" class="form-control form-control2 name_list" value="'+a1+'" /></td>'
                + '<td>'
                           + '<select id="user_id" class="form-control form-control2" name="tasksn[' + i + '][user_id]" autocomplete="user_id" value="{{ $film->person }}">'
                        +    '<option class="form-control form-control2" value="">Brak osoby</option>'
                         +       '@foreach($users as $user)<option class="form-control form-control2" value="{{ $user->id }}">{{ $user->name }}</option>@endforeach'
                          +  '</select>'
                       + '</td>'
                    + '<td><label><input type="checkbox" name="tasksn[' + i + '][todo]"> Zaplanowane</label></td>'
                    + '<td><input name="tasksn[' + i + '][end]" type="date" class="form-control form-control2 text-primary"></td>'
                    + '<td><button type="button" name="remove" id="'+i+'" class="btn btn-sm btn-danger btn_remove">X</button></td></tr>'); 
        }
        
         
      });  

      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  

      /*$.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });*/

      /*$('#submit').click(function(){            
           $.ajax({  
                url:url,  
                method:"POST",  
                data:$('#add_name').serialize(),
                type:'json',
                success:function(data)  
                {
                    if(data.error){
                        error_message_showing(data.error);
                    }else{
                        i=1;
                        $('.dynamic-added').remove();
                        $('#add_name')[0].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display','block');
                        $(".print-error-msg").css('display','none');
                        $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                  }
              }  
        });  
    });*/  

    function error_message_showing(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $(".print-success-msg").css('display','none');
        $.each( msg, function( key, value ) {
          $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
      }
    });  
@endsection