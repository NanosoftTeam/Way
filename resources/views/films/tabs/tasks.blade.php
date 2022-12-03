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
                <td><a href="{{ route('tasks.show', $task->id) }}"><span class="badge badge-pill badge-{{ $color[$task->status] }}" style="margin-right: 3px;">{{ $status[$task->status] }}</span> @if($task->count_children > 0) <span class="badge badge-pill badge-secondary">Projekt</span> @endif {{ $task->name }} @if($task->end <= date('Y-m-d') and $task->status != 4 and $task->end != NULL) <i class="fa-solid fa-calendar-days text-danger" title="Po terminie"></i> @endif @if($task->start <= date('Y-m-d') and $task->status < 2 and $task->start != NULL) <i class="fa-solid fa-calendar-days text-warning" title="Spóźniony start!"></i> @endif</a></td>
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