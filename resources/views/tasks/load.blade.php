<?php
$status  = array("Pomysł", "Do zrobienia", "W trakcie", "Testy", "Gotowe");
$color = array("secondary", "danger", "warning", "primary", "success");

?>

<div id="load" style="position: relative;">
<?php


if(isset($tasks) and $tasks->count() > 0){
    if($parent != "x"){
        foreach($tasks as $task){
            $d_parent = $task->parent;
            break;
        }

        if($d_parent->parent_id != NULL){
            
            $data_last = $d_parent->parent_id;
            
        }
        else{
            $data_last = 0;
        }
        $d_parent_name = $d_parent->name;
    }
    else{
        $data_last = 0;
    }
}
else{
    $data_last = 0;
}

?>
<button type="button" data-last="{{ $data_last }}"  style="@if($parent == 'x') display: none; @endif margin-top: 8px;" class="btn btn-primary btn-sm pull-right b-last"><- @isset($d_parent_name) Folder: {{ $d_parent_name }} @endisset</button> 
<table class="table table-sm table-hover" style="margin-top: 8px;">
        <thead>
        
        <tr>
            
            <th scope="col">Nazwa</th>
            <th scope="col">Status</th>
            <th scope="col">@if(Session::get('team_id') != 0) Osoba @else Czas @endif</th>
            <th scope="col" style="width:10px"></th>
        </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <?php $username = $task->user->name ?? ""; ?>
                <tr style="cursor: pointer;">
                    <td id="t{{ $task->id }}" class="show2" data-id="{{ $task->id }}" data-child="@if($task->count_children > 0) 1 @else 0 @endif">@if($task->count_children > 0) <i class="fa-solid fa-folder"></i> @endif {{ $task->name }} @if($task->description != NULL and $task->description != "") <i class="fa-solid fa-circle-info" title="Posiada opis"></i> @endif @if($task->end < date('Y-m-d') and $task->status != 4 and $task->end != NULL) <span class="badge badge-pill badge-danger">termin!</span> @endif @if($task->end == date('Y-m-d') and $task->status < 2) <span class="badge badge-pill badge-warning">dziś!</span> @endif</td>
                    <td id="s{{ $task->id }}" class="show2" data-id="{{ $task->id }}" data-child="@if($task->count_children > 0) 1 @else 0 @endif"><span class="badge badge-pill badge-{{ $color[$task->status] }}">{{ $status[$task->status] }}</span></td>
                    <td id="e{{ $task->id }}" class="show2" data-id="{{ $task->id }}" data-child="@if($task->count_children > 0) 1 @else 0 @endif">@if(Session::get('team_id') != 0) @if($username != "") {!! "<i class='fa-solid fa-user'></i>$username" ?? "brak osoby" !!} @endif @else {{ $task->duration }} min @endif</td>
                    <td>
                    <div class="btn-group">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item show2" data-id="{{ $task->id }}"><i class="fa-solid fa-eye"></i> Podgląd</button>
                            <a href="{{ route('tasks.show', $task->id) }}" class="dropdown-item"><i class="fa-solid fa-eye"></i> Zobacz</a>
                            <button class="dropdown-item edit" data-id="{{ $task->id }}"><i class="fa-solid fa-pen-to-square"></i> Edytuj</button>
                            <button class="dropdown-item delete" onclick="myFunction({{ $task->id}}, '{{$task->name}}')"><i class="fa-solid fa-trash"></i> Usuń</button>
                        </div>
                    </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



</div>
{{ $tasks->links() }}