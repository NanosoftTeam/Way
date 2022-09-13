<?php
$status  = array("Pomysł", "Do zrobienia", "W trakcie", "Testy", "Gotowe");
$color = array("secondary", "danger", "warning", "primary", "success");
$channel  = array("Infast", "Infast Animations");
$category  = array("Mine-imator", "MCreator", "MC Animation");
?>

<div class="container">
        <button class="btn btn-danger btn-sm float-right delete" style="margin: 5px;" onclick="myFunction({{ $task->id}}, '{{$task->name}}')"><i class="fa-solid fa-trash"></i> Usuń</button>
            <button class="btn btn-primary btn-sm float-right edit" id="b-edit" style="margin: 5px;" data-id="{{ $task->id }}"><i class="fa-solid fa-pen"></i> Edytuj</button>
        
        <table class="table table-sm" id="table-deadline-info">

            <thead>
                
            </thead>
            <tbody>
                <tr>
                    <td class="table-active text-secondary" style="width: 20%" data-field="name">Name</td>
                    <td id="t-name"><b>{{ $task->name }}</b></td>
                </tr>
                <tr>
                    <td class="table-active text-secondary" style="width: 20%">Status</td>
                    <td id="t-status"><span class="badge badge-pill badge-{{ $color[$task->status] }}">{{ $status[$task->status] }}</span></td>
                </tr>
                <tr>
                    <td class="table-active text-secondary" style="width: 20%">Cel</td>
                    <td id="t-end">@isset($task->goal_id)<a href="{{ route('goals.show', $task->goal_id) }}">{{ $task->goal->name ?? "[błąd]" }}</a>@endisset</td>
                </tr>
                <tr>
                    <td class="table-active text-secondary" style="width: 20%">deadline</td>
                    <td >@isset($task->deadline_id)<a href="{{ route('deadlines.show', $task->deadline_id) }}">{{ $task->deadline->name ?? "[błąd]" }}</a>@endisset</td>
                </tr>
                <tr>
                    @if($task->description == NULL or $task->description == '')
                        <td class="table-active text-secondary" style="width: 20%"> Opis</td>
                        <td >{!!nl2br($task->description)!!}</td>
                    @else
                        <td class="table-primary text-secondary" style="width: 20%"><i class="fa-solid fa-circle-info"></i> Opis</td>
                        <td class="table-primary">{!!nl2br($task->description)!!}</td>
                    @endif
                </tr>
                <tr>
                    <td class="table-active text-secondary" style="width: 20%">Czas</td>
                    <td >{{ $task->duration }} min</td>
                </tr>  
                <tr>
                    <td class="table-active text-secondary" style="width: 20%">Deadline</td>
                    <td >{{ $task->end }} @if($task->end <= date('Y-m-d') and $task->status != 4 and $task->end != NULL) <span class="badge badge-pill badge-danger">termin!</span> @endif</td>
                </tr>      
            </tbody>
        </table>
</div>