@extends('layouts.app')

@section('javascript2')
function delete1(id1, name) {
    let czy = prompt("Usunąć lekcję tak/nie? nazwa: " + name);
    if (czy == "tak") {
        
        $.ajax({
            method: "DELETE",
            url: "{{ config('app.url', 'Laravel') }}/lessons/" + id1,
        data: { id: id1}
        })
        .done(function( msg ) {
            window.location.reload();
            
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection

@section('template_title')
    Lesson
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Lesson') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('lessons.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                    <?php
                    $dni_tygodnia = array('Poniedzialek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela');
                    ?>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">Lekcja</th>
                                <th scope="col">Poniedziałek</th>
                                <th scope="col">Wtorek</th>
                                <th scope="col">Środa</th>
                                <th scope="col">Czwartek</th>
                                <th scope="col">Piątek</th>
                                <th scope="col">Sob</th>
                                <th scope="col">N</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                    
                                    @for ($l = 0; $l <= 10; $l++)
                                        <tr>
                                        <td scope="row"><b>{{ $l }}</b> {{ "(".substr($lessons_times[$l]->content2, 0, -3)." - ".substr($lessons_times[$l]->content3, 0, -3).")" }}</td>
                                        <?php
                                            $act_lesson = 0;
                                        ?>
                                        @for ($i = 1; $i <= 7; $i++)
                                            <td>
                                            @while (isset($plan[$l][$act_lesson]) and $plan[$l][$act_lesson]->day == $i)
                                            <a href="{{ route('lessons.show', $plan[$l][$act_lesson]->id) }}">{{ $plan[$l][$act_lesson]->name }}</a>, s. {{ $plan[$l][$act_lesson]->classroom_number }}
                                                <br />
                                                <?php
                                                    $act_lesson += 1;
                                                ?>
                                            @endwhile
                                            </td>
                                        @endfor
                                        </tr>
                                    @endfor
                                
                            </tbody>
                        </table>
                            <!--
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
										<th>Name</th>
										<th>Day</th>
										<th>Lesson Number</th>
										<th>Classroom Number</th>
                                        
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lessons as $lesson)
                                        <tr>
											<td>{{ $lesson->name }}</td>
											<td>{{ $dni_tygodnia[$lesson->day - 1] }}</td>
											<td>{{ $lesson->lesson_number }}</td>
											<td>{{ $lesson->classroom_number }}</td>

                                            <td>
                                                <form action="{{ route('lessons.destroy',$lesson->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('lessons.show',$lesson->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('lessons.edit',$lesson->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="delete1({{ $lesson->id}}, '{{$lesson->name}}')" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            //-->
                        </div>
                    </div>
                </div>
                <!-- {!! $lessons->links() !!} //-->
            </div>
        </div>
    </div>
@endsection
