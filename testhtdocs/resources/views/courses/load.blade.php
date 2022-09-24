<?php
$status  = array("Pomysł", "Oczekuje", "Otwarty", "Zamknięty");
$color = array("secondary", "primary", "success", "danger");

?>

<div id="load" style="position: relative;">
<table class="table table-sm table-hover">
        <thead>
        <tr>
            <th scope="col">Nazwa</th>
            <th scope="col">Status</th>
            <th scope="col">Odcinki</th>
            <th scope="col" style="width:10px"></th>
        </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <?php $count_films = count($course->films) ?>
                <tr style="cursor: pointer;">
                    <td id="t{{ $course->id }}" class="show2" data-id="{{ $course->id }}">{{ $course->name }}</td>
                    <td id="s{{ $course->id }}" class="show2" data-id="{{ $course->id }}"><span class="badge badge-pill badge-{{ $color[$course->status] }}">{{ $status[$course->status] }}</span></td>
                    <td id="e{{ $course->id }}" class="show2" data-id="{{ $course->id }}">{{ $count_films}} @if($course->p_episodes >= 1) {{ "/ ".$course->p_episodes }} @endif
                        @if($course->p_episodes >= 1)
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ round($count_films/$course->p_episodes, 2) * 100 }}%;" aria-valuenow="{{ round($count_films/$course->p_episodes, 2) * 100 }}" aria-valuemin="0" aria-valuemax="100">{{ round($count_films/$course->p_episodes, 2) * 100 }}%</div>
                        </div>
                        @endif</td>
                    <td>
                    <div class="btn-group">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item show2" data-id="{{ $course->id }}">Podgląd</button>
                            <a href="{{ route('courses.show', $course->id) }}" class="dropdown-item">Zobacz</a>
                            <button class="dropdown-item edit" data-id="{{ $course->id }}">Edytuj</button>
                            <button class="dropdown-item delete" onclick="myFunction({{ $course->id}}, '{{$course->name}}')">Usuń</button>
                        </div>
                    </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



</div>
{{ $courses->links() }}