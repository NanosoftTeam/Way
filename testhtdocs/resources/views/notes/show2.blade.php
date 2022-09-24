<?php
$status  = array("Pomysł", "Do zrobienia", "W trakcie", "Testy", "Gotowe");
$color = array("secondary", "danger", "warning", "primary", "success");
$channel  = array("Infast", "Infast Animations");
$category  = array("Mine-imator", "MCreator", "MC Animation");
?>

<div class="container">
        <button class="btn btn-danger btn-sm float-right delete" style="margin: 5px;" onclick="myFunction({{ $note->id}}, '{{$note->name}}')"><i class="fa-solid fa-trash"></i> Usuń</button>
            <button class="btn btn-primary btn-sm float-right edit" id="b-edit" style="margin: 5px;" data-id="{{ $note->id }}"><i class="fa-solid fa-pen"></i> Edytuj</button>
        
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