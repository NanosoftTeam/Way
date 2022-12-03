<?php
    $status  = array("Pomysł", "Wstrzymany", "Do zrealizowania", "Plan", "Scenariusz", "Nagrywanie", "Montaż", "Uploadowanie", "Oczekuje na publikację", "Opublikowany", "Koniec");
    $color = array("secondary", "secondary", "primary", "warning", "warning", "danger", "danger", "success", "success", "success", "success");
?>

<a href="{{ route('films.index').'?user=a&status=a&course='.$course->id.'&date=a' }}" class="float-right">Otwórz listę</a>
<table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">Nazwa</th>
                    <th scope="col" style="width:10px"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($films as $film)
                    <tr>
                        <td><a href="{{ route('films.show', $film->id) }}"><span class="badge badge-pill badge-{{ $color[$film->status] }}">{{ $status[$film->status] }}</span> {{ $film->title }}</a></td>
                        <td>
                        <div class="btn-group">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item show2" data-id="{{ $course->id }}" href="{{ route('films.show', $film->id) }}">Zobacz</a>
                            </div>
                        </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>