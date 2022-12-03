@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm" style="margin-bottom: 15px;">
            @if($post != '')
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading"><b>Ogłosznie</b></h5>
                    <p>{!!nl2br($post)!!}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        
            {!! $post_html !!}

            <script>
                {!! $post_js !!}
            </script>


            <div class="card">
                <div class="card-header"><i class="fa-solid fa-list-check"></i> Dzisiaj</div>

                <div class="card-body">
                    Dzień tygodnia: <b><i class="fa-solid fa-calendar-day"></i> {{ $weekday }}</b><br />
                    Data:   <b><i class="fa-solid fa-calendar"></i> {{ $date1 }} @if($date1 != date('Y-m-d')) (<i class="fa-solid fa-triangle-exclamation"></i>inna)  @endif</b><br />
                    Czas: <b><i class="fa-solid fa-clock"></i> {{ round($duration/60, 2) }} h</b> <br />
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ round($procent, 2) * 100 }}%;" aria-valuenow="{{ round($procent, 2) * 100 }}" aria-valuemin="0" aria-valuemax="100">{{ round($procent, 2) * 100 }}%</div>
                    </div>

                    
                    
                    
                </div>

                <div class="card-footer">
                    <form style="">
                        <input name="date" id="date" type="date" class="form-control form-control2" style="width: 50%; float: left;">
                        <button type="submit" style="float: left;" class="btn btn-primary btn-sm">Inny dzień</button>
                    </form>
                </div>
            </div>
            <br />
            <div class="card">
                <div class="card-header"><i class="fa-solid fa-list-check"></i> Dzisiejsze zadania</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th scope="col">Nazwa</th>
                            <th scope="col">Deadline i czas</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $status  = array("Pomysł", "Do zrobienia", "W trakcie", "Testy", "Gotowe");
                                $color = array("secondary", "danger", "warning", "primary", "success");
                            ?>
                            @foreach($tasks as $task)
                                
                                <tr>
                                    <td class="@if($task->duration == NULL) table-active @endif"><span class="badge badge-pill badge-{{ $color[$task->status] }}">{{ $status[$task->status] }}</span> <a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a></td>
                                    <td><span class="badge badge-light"><i class="fa-solid fa-clock"></i> {{ $task->duration }} min</span><a onclick="window.open('{{ route('tasks.edit2', $task->id) }}', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');">  <span class="badge @if(\Carbon\Carbon::parse($task->end.' 21:30:00') < date('Y-m-d H:i:s')) badge-danger @else badge-light @endif">@isset($task->end) <i class="fa-solid fa-clock"></i> {{ \Carbon\Carbon::parse($task->end." 21:30:00")->diffForHumans()  }} @endisset</span> </a></td>   
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('tasks.index') }}?user={{ Auth::id() }}&status=a&film=a&date=1">Pokaż wszystkie</a>
                    
                    
                    
                </div>

            </div>
            <br />
            <div class="card">
                <div class="card-header"><i class="fa-solid fa-list-check"></i> Dzisiejsze deadliney</div>

                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th scope="col">Nazwa</th>
                            <th scope="col">Typ</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $color = array("table-danger", "table-info", "table-warning", "table-success", "table-secondary");
                            ?>
                            @foreach($deadlines as $deadline)
                                <tr class="{{ $color[$deadline->priority] }}">
                                    <td><a href="{{ route('deadlines.show', $deadline->id) }}">{{ $deadline->name }}</a></td>
                                    <td>{{ $deadline->type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>

            </div>
            <br />
            <div class="card">
                <div class="card-header"><i class="fa-solid fa-list-check"></i> Jutrzejsze deadliney</div>

                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th scope="col">Nazwa</th>
                            <th scope="col">Typ</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $color = array("table-danger", "table-info", "table-warning", "table-success", "table-secondary");
                            ?>
                            @foreach($deadlines_tommorow as $deadline2)
                                <tr class="{{ $color[$deadline2->priority] }}">
                                    <td><a href="{{ route('deadlines.show', $deadline2->id) }}">{{ $deadline2->name }}</a></td>
                                    <td>{{ $deadline2->type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>

            </div>
        </div>
        
        <div class="col-sm">
        <div class="card">
                <div class="card-header text-danger"><b><i class="fa-solid fa-thumbtack"></i> Tym się teraz zajmujemy</b></div>

                <div class="card-body" style="padding-top: 0px; margin-bottom: 0px;">
                    <table class="table table-sm" style="margin-top: 0px; margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th scope="col">Nazwa</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($importants as $important)
                                <tr>
                                    <td><span class="badge badge-pill badge-primary">{{ $important->type }}</span> <a href="{{ $important->url }}">{{ $important->name }}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <br />

            <blockquote class="blockquote">
                <p class="mb-0">
                    - wyraźne poczucie celu, <br />
                    - niezachwiana nadzieja, <br />
                    - wiara w Boga i w Jego nieograniczone możliwości, <br />
                    - miłość i samoakceptacja, <br />
                    11 <br />
                    NICK VUJICIC <br />
                    - dewiza „postawa to podstawa", <br />
                    - odważny duch, <br />
                    - gotowość na zmiany, <br />
                    - ufne serce, <br />
                    - głód okazji, <br />
                    - umiejętność oceny ryzyka i poczucie humoru, <br />
                    - misja, która pozwala służyć innym,</p>
                <footer class="blockquote-footer">Nick Vujicic <cite title="Source Title">Bez rąk, bez nóg, bez ograniczeń!</cite></footer>
            </blockquote>
            
        </div>
    </div>
  
</div>
@endsection

@section('javascript')
$( document ).ready(function() {
    $(window).on('storage', message_receive);

    // receive message
    //
    function message_receive(ev)
    {
        if (ev.originalEvent.key!='message') return; // ignore other keys
        var message=JSON.parse(ev.originalEvent.newValue);
        if (!message) return; // ignore empty msg or msg reset

        if (message.command == 'refresh') window.location.reload();
    }
        
        
            
});

@endsection