@extends('layouts.app')

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
        <form  action="{{ route('task.update2', $task->id) }}" method="post" id="form-edit-task">
                    <table class="table table-sm" id="table-deadline-info">

                    <thead>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="name">Name</td>
                            <td id="t-name"><input name="name" id="name2" type="text" class="form-control form-control2" value="{{ $task->name }}" required></td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Status</td>
                            <td id="t-status">
                                <select id="status2" class="form-control form-control2" name="status" value="" required autocomplete="status">
                                    <option class="form-control form-control2 bg-secondary text-white" value="0" @if($task->status == 0) selected @endif>Pomysł</option>
                                    <option class="form-control form-control2 bg-danger text-white" value="1" @if($task->status == 1) selected @endif>Do zrobienia</option>
                                    <option class="form-control form-control2 bg-warning text-dark" value="2" @if($task->status == 2) selected @endif>W trakcie</option>
                                    <option class="form-control form-control2 bg-primary text-white" value="3" @if($task->status == 3) selected @endif>Testy</option>
                                    <option class="form-control form-control2 bg-success text-white" value="4" @if($task->status == 4) selected @endif>Gotowe</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="duration">Czas</td>
                            <td><input name="duration" id="duration2" type="number" class="form-control form-control2" value="{{ $task->duration }}"></td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%">Deadline</td>
                            <td ><input name="end" id="end2" type="date" class="form-control form-control2" value="{{ $task->end }}"></td>
                        </tr>      
                    </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Zapisz</button>
                    </div>
                </form>
            
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection
