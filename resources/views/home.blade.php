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
                    <h5 class="alert-heading"><b>{!! preg_split('#\r?\n#', $post, 2)[0] !!}</b></h5>
                    {!! nl2br(preg_replace('/^.+\n/', '', $post)) !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {!! $post_html !!}

            <script>
                {!! $post_js !!}
            </script>
            @if(Session::get('team_id') == 0)
            <style type="text/css">
                body {
                    background-color: #f9f9fa
                }

                @media (min-width:992px) {
                    .page-container {
                        max-width: 1140px;
                        margin: 0 auto
                    }

                    .page-sidenav {
                        display: block !important
                    }
                }

                .padding {
                    padding: 2rem
                }

                .w-32 {
                    width: 32px !important;
                    height: 32px !important;
                    font-size: .85em
                }

                .tl-item .avatar {
                    z-index: 2
                }

                .circle {
                    border-radius: 500px
                }

                .gd-warning {
                    color: #fff;
                    border: none;
                    background: #f4c414 linear-gradient(45deg, #f4c414, #f45414)
                }

                .timeline {
                    position: relative;
                    border-color: rgba(160, 175, 185, .15);
                    padding: 0;
                    margin: 0
                }

                .p-4 {
                    padding: 1.5rem !important
                }

                .mb-4,
                .my-4 {
                    margin-bottom: 1.5rem !important
                }

                .tl-item {
                    border-radius: 3px;
                    position: relative;
                    display: -ms-flexbox;
                    display: flex
                }

                .tl-item>* {
                    padding: 10px
                }

                .tl-item .avatar {
                    z-index: 2
                }

                .tl-item:last-child .tl-dot:after {
                    display: none
                }

                .tl-item.active .tl-dot:before {
                    border-color: #448bff;
                    box-shadow: 0 0 0 8px rgba(68, 139, 255, .2)
                }

                .tl-item:last-child .tl-dot:after {
                    display: none
                }

                .tl-item.active .tl-dot:before {
                    border-color: #448bff;
                    box-shadow: 0 0 0 8px rgba(68, 139, 255, .2)
                }

                .tl-dot {
                    position: relative;
                    border-color: rgba(160, 175, 185, .15)
                }

                .tl-dot:after,
                .tl-dot:before {
                    content: '';
                    position: absolute;
                    border-color: inherit;
                    border-width: 2px;
                    border-style: solid;
                    border-radius: 50%;
                    width: 10px;
                    height: 10px;
                    top: 15px;
                    left: 50%;
                    transform: translateX(-50%)
                }

                .tl-dot:after {
                    width: 0;
                    height: auto;
                    top: 25px;
                    bottom: -15px;
                    border-right-width: 0;
                    border-top-width: 0;
                    border-bottom-width: 0;
                    border-radius: 0
                }

                tl-item.active .tl-dot:before {
                    border-color: #448bff;
                    box-shadow: 0 0 0 8px rgba(68, 139, 255, .2)
                }

                .tl-dot {
                    position: relative;
                    border-color: rgba(160, 175, 185, .15)
                }

                .tl-dot:after,
                .tl-dot:before {
                    content: '';
                    position: absolute;
                    border-color: inherit;
                    border-width: 2px;
                    border-style: solid;
                    border-radius: 50%;
                    width: 10px;
                    height: 10px;
                    top: 15px;
                    left: 50%;
                    transform: translateX(-50%)
                }

                .tl-dot:after {
                    width: 0;
                    height: auto;
                    top: 25px;
                    bottom: -15px;
                    border-right-width: 0;
                    border-top-width: 0;
                    border-bottom-width: 0;
                    border-radius: 0
                }

                .tl-content p:last-child {
                    margin-bottom: 0
                }

                .tl-date {
                    font-size: .85em;
                    margin-top: 2px;
                    min-width: 100px;
                    max-width: 100px
                }

                .avatar {
                    position: relative;
                    line-height: 1;
                    border-radius: 500px;
                    white-space: nowrap;
                    font-weight: 700;
                    border-radius: 100%;
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-pack: center;
                    justify-content: center;
                    -ms-flex-align: center;
                    align-items: center;
                    -ms-flex-negative: 0;
                    flex-shrink: 0;
                    border-radius: 500px;
                    box-shadow: 0 5px 10px 0 rgba(50, 50, 50, .15)
                }

                .b-warning {
                    border-color: #f4c414!important;
                }

                .b-primary {
                    border-color: #58b87a!important;
                }

                .b-danger {
                    border-color: #f54394!important;
                }
            </style>
            

                    <div class="timeline p-4 block mb-4" style="margin-left: 0px; padding-left: 0px;">
                        @if(date("H:i:s") < "08:30:01" or $date1 != date('Y-m-d'))
                        <div class="tl-item">
                            <div class="tl-dot b-warning"></div>
                            <div class="tl-content">
                                <div class=""><b>Rutyna rano</b><br />
                                    {!! nl2br($rutyna_rano) !!}
                                </div>
                            </div>
                        </div>
                        @endif

                        @foreach ($lessons as $lesson)
                            @if($lessons_times[$lesson->lesson_number]->content3 > date('H:i:s') or $date1 != date('Y-m-d'))
                            <div class="tl-item @if(\Carbon\Carbon::parse(date('Y-m-d').$lessons_times[$lesson->lesson_number]->content3) > date('Y-m-d H:i:s') and \Carbon\Carbon::parse(date('Y-m-d').$lessons_times[$lesson->lesson_number]->content2) < date('Y-m-d H:i:s')) active @endif">
                                <div class="tl-dot b-danger"></div>
                                <div class="tl-content">
                                    <div class=""><b>{{ $lesson->name }}</b></div>
                                    <b> L {{ $lesson->lesson_number }}</b>, S <b>{{ $lesson->classroom_number }}</b> ({{ substr($lessons_times[$lesson->lesson_number]->content2, 0, -3)." - ".substr($lessons_times[$lesson->lesson_number]->content3, 0, -3) }})
                                    <div class="tl-date text-muted mt-1">@if(\Carbon\Carbon::parse(date('Y-m-d').$lessons_times[$lesson->lesson_number]->content2) > date('Y-m-d H:i:s')) {{ \Carbon\Carbon::parse(date('Y-m-d').$lessons_times[$lesson->lesson_number]->content2)->diffForHumans()  }} @endif
                                    @if(\Carbon\Carbon::parse(date('Y-m-d').$lessons_times[$lesson->lesson_number]->content3) > date('Y-m-d H:i:s') and \Carbon\Carbon::parse(date('Y-m-d').$lessons_times[$lesson->lesson_number]->content2) < date('Y-m-d H:i:s')) Koniec za {{ \Carbon\Carbon::parse(date('Y-m-d').$lessons_times[$lesson->lesson_number]->content3)->diffForHumans()  }} @endif </div>
                                </div>
                            </div>
                            @endif
                        @endforeach

                        @if($tasks->count() > 0 or $date1 != date('Y-m-d'))
                        <div class="tl-item">
                            <div class="tl-dot b-warning"></div>
                            <div class="tl-content">
                                <div class=""><b>Rutyna po południu</b> <br />
                                    {!! nl2br($rutyna_popoludnie) !!}
                                </div>
                            </div>
                        </div>
                        <div class="tl-item">
                            <div class="tl-dot b-warning"></div>
                            <div class="tl-content">
                                <div class=""><b>Zadania</b> <br />
                                    <table class="table table-sm">
                                        <tbody>
                                            <?php
                                                $status  = array("Pomysł", "Do zrobienia", "W trakcie", "Testy", "Gotowe");
                                                $color = array("secondary", "danger", "warning", "primary", "success");
                                            ?>
                                            @foreach($tasks as $task)

                                                <tr>
                                                    <td class="@if($task->duration == NULL) table-active @endif" @if($task->description != NULL and $task->description != "") title="{!! preg_replace('/\s\s+/', '&#13;', $task->description); !!}" @endif><span class="badge badge-pill badge-{{ $color[$task->status] }}">{{ $status[$task->status] }}</span> <a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }} @if($task->description != NULL and $task->description != "") <i class="fa-solid fa-circle-info"></i> @endif</a></td>
                                                    <td><span class="badge badge-light"><i class="fa-solid fa-clock"></i> {{ $task->duration }} min</span><a onclick="window.open('{{ route('tasks.edit2', $task->id) }}', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');">  <span class="badge @if(\Carbon\Carbon::parse($task->end.' 21:30:00') < date('Y-m-d H:i:s')) badge-danger @else badge-light @endif">@isset($task->end) <i class="fa-solid fa-clock"></i> {{ \Carbon\Carbon::parse($task->end." 21:30:00")->diffForHumans()  }} @endisset</span> </a></td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="tl-item">
                            <div class="tl-dot b-primary"></div>
                            <div class="tl-content">
                                <div class=""><b>Wolne</b></div>
                                <div class="tl-date text-muted mt-1">Odpoczynek! To jest test</div>
                            </div>
                        </div>
                        <div class="tl-item">
                            <div class="tl-dot b-warning"></div>
                            <div class="tl-content">
                                <div class=""><b>Rutyna wieczór </b> <br />
                                    {!! nl2br($rutyna_wieczor) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="card">
                            <div class="card-header">TWOJE Zadania</div>

                            <div class="card-body">
                                <table class="table table-sm">
                                    <tbody>
                                        <?php
                                            $status  = array("Pomysł", "Do zrobienia", "W trakcie", "Testy", "Gotowe");
                                            $color = array("secondary", "danger", "warning", "primary", "success");
                                        ?>
                                        @foreach($tasks as $task)

                                            <tr>
                                                <td class="@if($task->duration == NULL) table-active @endif" @if($task->description != NULL and $task->description != "") title="{!! preg_replace('/\s\s+/', '&#13;', $task->description); !!}" @endif><span class="badge badge-pill badge-{{ $color[$task->status] }}">{{ $status[$task->status] }}</span> <a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }} @if($task->description != NULL and $task->description != "") <i class="fa-solid fa-circle-info"></i> @endif</a></td>
                                                <td><span class="badge badge-light"><i class="fa-solid fa-clock"></i> {{ $task->duration }} min</span><a onclick="window.open('{{ route('tasks.edit2', $task->id) }}', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');">  <span class="badge @if(\Carbon\Carbon::parse($task->end.' 21:30:00') < date('Y-m-d H:i:s')) badge-danger @else badge-light @endif">@isset($task->end) <i class="fa-solid fa-clock"></i> {{ \Carbon\Carbon::parse($task->end." 21:30:00")->diffForHumans()  }} @endisset</span> </a></td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif



            <br />
            <br />

        </div>

        <div class="col-sm">
        <div class="card">
                        <div class="card-body">
                            Dzień tygodnia: <b><i class="fa-solid fa-calendar-day"></i> {{ $weekday }}</b><br />
                            Data:   <b><i class="fa-solid fa-calendar"></i> {{ $date1 }} @if($date1 != date('Y-m-d')) (<i class="fa-solid fa-triangle-exclamation"></i>inna)  @endif</b><br />
                            Czas: <b><i class="fa-solid fa-clock"></i> {{ round($duration/60, 2) }} h</b> <br />
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ round($procent, 2) * 100 }}%;" aria-valuenow="{{ round($procent, 2) * 100 }}" aria-valuemin="0" aria-valuemax="100">{{ round($procent, 2) * 100 }}%</div>
                            </div>
                            <br />
                            <form style="">
                                <input name="date" id="date" type="date" class="form-control form-control2" style="width: 50%; float: left;">
                                <button type="submit" style="float: left;" class="btn btn-primary btn-sm">Inny dzień</button>
                            </form>

                        </div>
                    </div>
                    <br />
        <div class="card">
                <div class="card-header text-danger"><b><i class="fa-solid fa-thumbtack"></i> Priorytety</b></div>

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

            <div class="card">
                <div class="card-body">
                    {!! $quote !!}
                </div>
            </div>

            <br />



            <div class="card">
                <div class="card-header"><i class="fa-solid fa-list-check"></i> Nadchodzące deadliney (najbliższy tydzień)</div>

                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th scope="col">Nazwa</th>
                            <th scope="col">Typ</th>
                            <th scope="col">Data</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $color = array("table-danger", "table-info", "table-warning", "table-success", "table-secondary");
                            ?>
                            @foreach($deadlines as $deadline)
                                <?php
                                    $weekMap = [
                                        0 => 'Niedz',
                                        1 => 'Pon',
                                        2 => 'Wt',
                                        3 => 'Śr',
                                        4 => 'Cz',
                                        5 => 'Pt',
                                        6 => 'Sob',
                                    ];
                                    $dayOfTheWeek = \Carbon\Carbon::parse($deadline->date)->dayOfWeek;
                                    $weekday = $weekMap[$dayOfTheWeek];
                                ?>
                                <tr class="{{ $color[$deadline->priority] }}">
                                    <td> @if(date('Y-m-d') == $deadline->date)<span class="badge badge-secondary">Dziś</span> @elseif($jutro == $deadline->date)<span class="badge badge-danger">Jutro</span>@endif @if($deadline->is_planned == 0) ❌ @endif <a href="{{ route('deadlines.show', $deadline->id) }}">{{ $deadline->name }}</a></td>
                                    <td>{{ $deadline->type }}</td>
                                    <td>{!! $deadline->date." <u>".$weekday."</u>" !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

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
