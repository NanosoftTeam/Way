<?php
$channel  = array("Infast", "Infast Animations");
$type  = array("Film", "Odcinek kursu", "Short");
$course  = array("Kurs 1", "Kurs 2", "Kurs3");
$status  = array("Pomysł", "Wstrzymany", "Do zrealizowania", "Plan", "Scenariusz", "Nagrywanie", "Montaż", "Uploadowanie", "Oczekuje na publikację", "Opublikowany", "Koniec");
$color = array("secondary", "secondary", "primary", "warning", "warning", "danger", "danger", "success", "success", "success", "success");
?>

<div class="container"> 

    <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="true"><i class="fa-solid fa-circle-info"></i> Info</a>
        <a class="nav-item nav-link" id="nav-tasks-tab" data-toggle="tab" href="#nav-tasks" role="tab" aria-controls="nav-tasks" aria-selected="false"><i class="fa-solid fa-list-check"></i> Zadania</a>
        <a class="nav-item nav-link" id="nav-materials-tab" data-toggle="tab" href="#nav-materials" role="tab" aria-controls="nav-materials" aria-selected="false"><i class="fa-solid fa-paperclip"></i> Materiały</a>
        <a class="nav-item nav-link" id="nav-yt-tab" data-toggle="tab" href="#nav-yt" role="tab" aria-controls="nav-yt" aria-selected="false"><i class="fa-brands fa-youtube"></i> YT</a>
        <a class="nav-item nav-link" id="nav-applications-tab" data-toggle="tab" href="#nav-applications" role="tab" aria-controls="nav-applications" aria-selected="false"><i class="fa-solid fa-list"></i> Zgłoszenia</a>
    </div>
</nav>
    <div class="tab-content" id="nav-tabContent">
        
        <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
        @include('films.tabs.info')
    </div>
    <div class="tab-pane fade" id="nav-tasks" role="tabpanel" aria-labelledby="nav-tasks-tab">
        <a href="{{ route('tasks.index').'?user=a&status=a&film='.$film->id.'&date=a' }}" class="float-right"><i class="fa-solid fa-list"></i> Otwórz listę</a>
        <a href="{{ route('tasks.index').'?user=a&status=a&film='.$film->id.'&date=a&search=scena:' }}" class="float-right" style="margin-right: 15px;" ><i class="fa-solid fa-video"></i> Sceny</a>
        <a href="{{ route('films.plan.calendar', $film->id) }}" style="margin-right: 15px;" class="float-right"><i class="fa-solid fa-calendar"></i> Kalendarz</a>
        <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col">Nazwa</th>
                <th scope="col" style="width:10px"></th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $status  = array("Pomysł", "Do zrobienia", "W trakcie", "Testy", "Gotowe");
                    $color = array("secondary", "danger", "warning", "primary", "success");
                ?>
                @foreach($tasks as $task)
                    <tr>
                        <td><a href="{{ route('tasks.show', $task->id) }}"><span class="badge badge-pill badge-{{ $color[$task->status] }}" style="margin-right: 3px;">{{ $status[$task->status] }}</span> @if($task->count_children > 0) <span class="badge badge-pill badge-secondary">Projekt</span> @endif{{ $task->name }} @if($task->end <= date('Y-m-d') and $task->status != 4 and $task->end != NULL)  <i class="fa-solid fa-calendar-days text-danger" title="Po terminie"></i> @endif @if($task->start <= date('Y-m-d') and $task->status < 2 and $task->start != NULL) <i class="fa-solid fa-calendar-days text-warning" title="Spóźniony start!"></i> @endif</a> </td>
                        <td>
                        <div class="btn-group">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" data-id="{{ $task->id }}" href="{{ route('tasks.show', $task->id) }}"><i class="fa-solid fa-eye"></i> Zobacz</a>
                            </div>
                        </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="nav-materials" role="tabpanel" aria-labelledby="nav-materials-tab">...</div>
    <div class="tab-pane fade" id="nav-yt" role="tabpanel" aria-labelledby="nav-yt-tab">
        <br>
        @if($film->yt != '' and $film->yt != NULL)<iframe src="https://www.youtube.com/embed/{{ substr($film->yt, -11) }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
        @else
            <div class="alert alert-primary" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Brak linku!</div>
        @endif     
    </div>
    <div class="tab-pane fade" id="nav-applications" role="tabpanel" aria-labelledby="nav-applications-tab">...</div>
    </div>
    </div>