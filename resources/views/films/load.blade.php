<?php
$status  = array("Pomysł", "Wstrzymany", "Do zrealizowania", "Plan", "Scenariusz", "Nagrywanie", "Montaż", "Uploadowanie", "Oczekuje na publikację", "Opublikowany", "Koniec");
$color = array("secondary", "secondary", "primary", "warning", "warning", "danger", "danger", "success", "success", "success", "success");
?>

<div id="load" style="position: relative;">
<table class="table table-sm table-hover">
        <thead>
        <tr>
            <th scope="col">Nazwa</th>
            <th scope="col"><i class="fa-solid fa-check"></i> Status</th>
            <th scope="col"><i class="fa-solid fa-calendar"></i> Publikacja</th>
            <th scope="col" style="width:10px"></th>
        </tr>
        </thead>
        <tbody>
            @foreach($films as $film)
                <tr style="cursor: pointer;">
                    <td id="t{{ $film->id }}" class="show2" data-id="{{ $film->id }}">{{ $film->title }} 
                        @if($film->start == NULL or $film->start == '') <u>(s)</u> @endif
                        @if($film->start <= date('Y-m-d') and $film->status < 3 and $film->start != NULL) <span class="badge badge-pill badge-warning">Start!</span>
                        @endif</td>
                    <?php
                        $stop_date = date('Y-m-d');
                        $stop_date = date('Y-m-d', strtotime($stop_date . ' +3 day'));
                    ?>
                    <td id="s{{ $film->id }}" class="show2" data-id="{{ $film->id }}"><span class="badge badge-pill badge-{{ $color[$film->status] }}">{{ $status[$film->status] }}</span></td>
                    <td id="e{{ $film->id }}" class="show2" data-id="{{ $film->id }}">
                        @if($film->end != NULL and $film->end <= $stop_date and $film->end >= date('Y-m-d') and $film->status < 9) <span class="badge badge-pill badge-warning">{{ $film->end }}</span>
                        @elseif($film->end <= date('Y-m-d') and $film->status < 9 and $film->end != NULL) <span class="badge badge-pill badge-danger">{{ $film->end }}</span>
                        @else <span class="badge badge-pill badge-success">{{ $film->end }}</span> @endif</td>
                    <td>
                    <div class="btn-group">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item show2" data-id="{{ $film->id }}"><i class="fa-solid fa-eye"></i> Podgląd</button>
                            <a href="{{ route('films.show', $film->id) }}" class="dropdown-item"><i class="fa-solid fa-eye"></i> Zobacz</a>
                            <button class="dropdown-item edit" data-id="{{ $film->id }}"><i class="fa-solid fa-pen-to-square"></i> Edytuj</button>
                            <button class="dropdown-item delete" onclick="myFunction({{ $film->id}}, '{{$film->title}}')"><i class="fa-solid fa-trash"></i> Usuń</button>
                        </div>
                    </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



</div>
{{ $films->links() }}