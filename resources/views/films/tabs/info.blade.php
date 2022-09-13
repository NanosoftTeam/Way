<?php
$status  = array("Pomysł", "Wstrzymany", "Do zrealizowania", "Plan", "Scenariusz", "Nagrywanie", "Montaż", "Uploadowanie", "Oczekuje na publikację", "Opublikowany", "Koniec");
$channel  = array("Infast", "Infast Animations");
$type  = array("Film", "Odcinek kursu", "Short");
$course  = array("Kurs 1", "Kurs 2", "Kurs3");
$color = array("secondary", "secondary", "primary", "warning", "warning", "danger", "danger", "success", "success", "success", "success");
?>
            <button class="btn btn-danger btn-sm float-right delete" style="margin: 5px;" onclick="myFunction({{ $film->id}}, '{{$film->title}}')"><i class="fa-solid fa-trash-can"></i> Usuń</button>
            <a href="{{ route('films.show', $film->id) }}"><button class="btn btn-primary btn-sm float-right show-film" style="margin: 5px;" data-id="{{ $film->id }}"><i class="fa-solid fa-eye"></i> Zobacz</button></a>
            <a href="{{ route('films.plan.edit', $film->id) }}"><button class="btn btn-primary btn-sm float-right plan" style="margin: 5px;" data-id="{{ $film->id }}"><i class="fa-solid fa-calendar"></i> Planuj</button></a>
            <button class="btn btn-primary btn-sm float-right edit" id="b-edit" style="margin: 5px;" data-id="{{ $film->id }}"><i class="fa-solid fa-pen"></i> Edytuj</button>
            
            <table class="table table-sm" id="table-film-info">
                
                <thead>
                    
                </thead>
                <tbody>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%" data-field="title"><i class="fa-solid fa-font"></i> Tytuł</td>
                        <td id="t-title"><b>{{ $film->title }}</b></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%"><i class="fa-solid fa-calendar"></i> Początek prac</td>
                        <td id="t-start">
                            @if($film->start <= date('Y-m-d') and $film->status < 3 and $film->start != NULL) <span class="badge badge-pill badge-warning">{{ $film->start }}</span>
                            @else
                                <span class="badge badge-pill badge-success">{{ $film->start }}</span>
                            @endif
                            @if($film->start == NULL or $film->start == '') <span class="badge badge-pill badge-secondary">Brak startu</span> @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%"><i class="fa-solid fa-calendar"></i> Publikacja</td>
                        <td id="t-end">
                        <?php
                            $stop_date = date('Y-m-d');
                            $stop_date = date('Y-m-d', strtotime($stop_date . ' +3 day'));
                        ?>
                            @if($film->end != NULL and $film->end <= $stop_date and $film->end >= date('Y-m-d') and $film->status < 9) <span class="badge badge-pill badge-warning">{{ $film->end }}</span>
                            @elseif($film->end <= date('Y-m-d') and $film->status < 9 and $film->end != NULL) <span class="badge badge-pill badge-danger">{{ $film->end }}</span>
                            @else <span class="badge badge-pill badge-success">{{ $film->end }}</span> @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%"><i class="fa-solid fa-check"></i> Status</td>
                        <td ><span class="badge badge-pill badge-{{ $color[$film->status] }}">{{ $status[$film->status] }}</span></td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%"><i class="fa-solid fa-building"></i> Kanał</td>
                        <td >{{ $channel[$film->channel] }}</td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%"><i class="fa-solid fa-video"></i> Rodzaj</td>
                        <td >{{ $type[$film->type] }}</td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%"><i class="fa-solid fa-folder"></i> Kurs</td>
                        <td id="t-course"><a href="{{ route('courses.show', $film->course->id) }}">{{ $film->course->name }}</a></td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%"><i class="fa-solid fa-users"></i> Opiekun</td>
                        <td >{{ $username }}</td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%"><i class="fa-solid fa-align-justify"></i> Opis</td>
                        <td >{!!nl2br($film->description)!!}</td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%"><i class="fa-solid fa-check"></i> Status opisowy</td>
                        <td >{!!nl2br($film->longstatus)!!}</td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%"><i class="fa-solid fa-link"></i> Linki</td>
                        <td >
                            @if($film->yt != '' or $film->scenario != '')
                            @if($film->yt != '')
                                <a href="{{ $film->yt }}" target="_blank"><button type="button" class="btn btn-outline-danger btn-sm">YouTube</button></a>
                            @endif

                            @if($film->scenario != '')
                                <a href="{{ $film->scenario }}" target="_blank"><button type="button" class="btn btn-outline-primary btn-sm">Scenariusz</button></a>
                            @endif
                            @else
                                <i class="text-secondary">brak scenariusza, linku do YT</i>
                            @endif
                        </td>
                    </tr>        
                </tbody>
            </table>

            @if($film->status < 9 and $film->status > 2)
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>Pamiętaj o kontroli!</strong> Na każdym etapie pilnuj, żeby film był zgodny z <a href="https://docs.google.com/document/d/1n-swHA6Sc5HZiGYWxxrEwPA0aqcyCBYNCRYypNtOvto/edit?usp=sharing" target="_blank" class="alert-link">plikiem kontrolnym</a>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <?php
            $stop_date = date('Y-m-d');
            $stop_date = date('Y-m-d', strtotime($stop_date . ' +3 day'));
            //$currentDate = date('Y-m-d');
            //$currentDate = date('Y-m-d', strtotime($currentDate));
            ?>
            @if($film->end < date('Y-m-d') and $film->end != NULL and $film->status < 9)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>PRZEGAPIONA PUBLIKACJA!</strong> Film powinien być już opublikowany.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif($film->end <= $stop_date and $film->end != NULL and $film->status < 9)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Zbliża się publikacja!</strong> (mniej niż 4 dni)
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif