<?php
$status  = array("Pomysł", "Do zrobienia", "W trakcie", "Testy", "Gotowe");
$color = array("secondary", "danger", "warning", "primary", "success");

?>

<div id="load" style="position: relative;">
<?php


if(isset($notes) and $notes->count() > 0){
    if($parent != "x"){
        foreach($notes as $note){
            $d_parent = $note->parent;
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
            <th scope="col"></th>
            <th scope="col" style="width:10px"></th>
        </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
                <tr style="cursor: pointer;">
                    <td id="t{{ $note->id }}" class="show2" data-id="{{ $note->id }}" data-child="@if($note->count_children > 0) 1 @else 0 @endif">@if($note->count_children > 0) <i class="fa-solid fa-folder"></i> @endif {{ $note->name }}  @if($note->end <= date('Y-m-d') and $note->status != 4 and $note->end != NULL) <span class="badge badge-pill badge-danger">termin!</span> @endif @if($note->start <= date('Y-m-d') and $note->status < 2 and $note->start != NULL) <span class="badge badge-pill badge-warning">start!</span> @endif</td>
                    <td>@if($note->count_children > 0) <button class="btn btn-primary btn-sm show2" data-id="{{ $note->id }}"><i class="fa-solid fa-eye"></i></button> @endif</td>
                    <td>
                    <div class="btn-group">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item show2" data-id="{{ $note->id }}"><i class="fa-solid fa-eye"></i> Podgląd</button>
                            <a href="{{ route('notes.show', $note->id) }}" class="dropdown-item"><i class="fa-solid fa-eye"></i> Zobacz</a>
                            <button class="dropdown-item edit" data-id="{{ $note->id }}"><i class="fa-solid fa-pen-to-square"></i> Edytuj</button>
                            <button class="dropdown-item delete" onclick="myFunction({{ $note->id}}, '{{$note->name}}')"><i class="fa-solid fa-trash"></i> Usuń</button>
                        </div>
                    </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



</div>
{{ $notes->links() }}