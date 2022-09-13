@extends('layouts.app')

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
            <b>Zmień daty zaległych zadań ({{ $tasks_count }}) na:</b>
            <form action="{{ route('task.date') }}" method="post">
                <input name="date" id="date" type="date" class="form-control form-control2" style="width: 50%; float: left;">
                <button type="submit" style="float: left;" class="btn btn-primary btn-sm">Zmień daty</button>
            </form>
            
        </div>
    </div>
</div>

@endsection

@section('javascript')
@endsection
