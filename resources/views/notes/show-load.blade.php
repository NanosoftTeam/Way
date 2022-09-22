<?php
$status  = array("Pomysł", "Do zrobienia", "W trakcie", "Testy", "Gotowe");
$color = array("secondary", "danger", "warning", "primary", "success");
$channel  = array("Infast", "Infast Animations");
$category  = array("Mine-imator", "MCreator", "MC Animation");

$c_note = $note;
$text1 = "";
while($c_note->parent_id != NULL){
    $c_note = $c_note->parent;
    $text1 = '<a href="'.route('notes.show', $c_note->id).'">'.$c_note->name.'</a> > '.$text1;
}

?>

<div class="card">
    <div class="card-header"><a href="{{ route('notes.index') }}">Notatki</a> > {!! $text1 !!}
        <button class="btn btn-danger btn-sm float-right delete" style="margin-right: 3px;" onclick="myFunction({{ $note->id}}, '{{$note->name}}')"><i class="fa-solid fa-trash"></i> Usuń</button>
        <button class="btn btn-primary btn-sm float-right edit" id="b-edit" style="margin-right: 3px;" data-id="{{ $note->id }}"><i class="fa-solid fa-pen"></i> Edytuj</button>
    </div>

    <div class="card-body">
        
    <table class="table table-sm" id="table-note-info">

        <thead>
            
        </thead>
        <tbody>
            <tr>
                <td class="table-active text-secondary" style="width: 20%" data-field="name">Name</td>
                <td id="t-name"><b>{{ $note->name }}</b></td>
            </tr>
        </tbody>
    </table>

    <div class="list-group full-width list-group-item">{!! $note->content !!}</div>
    </div>
</div>

<br />