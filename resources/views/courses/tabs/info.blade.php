<?php
$status  = array("Pomysł", "Oczekuje", "Otwarty", "Zamknięty");
$color = array("secondary", "primary", "success", "danger");
$channel  = array("Infast", "Infast Animations");
$category  = array("Mine-imator", "MCreator", "MC Animation");
?>

<button class="btn btn-danger btn-sm float-right delete" style="margin: 5px;" onclick="myFunction({{ $course->id}}, '{{$course->name}}')">Usuń</button>
            <button class="btn btn-primary btn-sm float-right edit" id="b-edit" style="margin: 5px;" data-id="{{ $course->id }}">Edytuj</button>
            
            <table class="table table-sm" id="table-film-info">

                <thead>
                    
                </thead>
                <tbody>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Nazwa</td>
                        <td id="t-name"><b>{{ $course->name }}</b></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Kanał</td>
                        <td id="t-channel">
                            {{ $channel[$course->channel] }}
                        </td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Kategoria</td>
                        <td id="t-category">
                            {{ $course->category }}
                        </td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Opis</td>
                        <td >{!!nl2br($course->description)!!}</td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Odcinki</td>
                        <td >
                            {{ $count_films }}
                            @if($course->p_episodes >= 1)
                                {{" / ".$course->p_episodes }}
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ round($count_films/$course->p_episodes, 2) * 100 }}%;" aria-valuenow="{{ round($count_films/$course->p_episodes, 2) * 100 }}" aria-valuemin="0" aria-valuemax="100">{{ round($count_films/$course->p_episodes, 2) * 100 }}%</div>
                                </div>
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Status opisowy</td>
                        <td >{!!nl2br($course->longstatus)!!}</td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Cel</td>
                        <td >{!!nl2br($course->goal)!!}</td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Status</td>
                        <td ><span class="badge badge-pill badge-{{ $color[$course->status] }}">{{ $status[$course->status] }}</span></td>
                    </tr>  
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Linki</td>
                        <td >
                            @if($course->yt != '' or $course->scenario != '')
                                @if($course->yt != '')
                                    <a href="{{ $course->yt }}" target="_blank"><button type="button" class="btn btn-outline-danger btn-sm">YouTube</button></a>
                                @endif

                                @if($course->scenario != '')
                                    <a href="{{ $course->scenario }}" target="_blank"><button type="button" class="btn btn-outline-primary btn-sm">Scenariusz</button></a>
                                @endif
                            @else
                                <i class="text-secondary">brak scenariusza, linku do YT</i>
                            @endif

                        </td>
                    </tr>        
                </tbody>
            </table>