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
            window.location.href = "{{ route('lessons.index') }}";
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection


@section('template_title')
    {{ $lesson->name ?? 'Show Lesson' }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('lessons.index') }}">Lekcje</a> > {{ $lesson->name }}
                            <a class="btn btn-sm btn-success" href="{{ route('lessons.edit',$lesson->id) }}" style="margin-left: 5px;"><i class="fa fa-fw fa-edit"></i> Edit</a>
                            <button type="button" onclick="delete1({{ $lesson->id}}, '{{$lesson->name}}')" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                        </span>
                    </div>


                    <div class="card-body">
                    <?php
                    $dni_tygodnia = array('Poniedzialek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela');
                    ?>

                        <table class="table table-sm" id="table-film-info">

                        <thead>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Nazwa</td>
                                <td id="t-name"><b>{{ $lesson->name }}</b></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Dzień</td>
                                <td id="t-name"><b>{{ $dni_tygodnia[$lesson->day - 1] }}</b></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Numer lekcji</td>
                                <td id="t-name"><b>{{ $lesson->lesson_number }}</b></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Numer sali</td>
                                <td id="t-name"><b>{{ $lesson->classroom_number }}</b></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Opis</td>
                                <td id="t-name">{{ $lesson->description }}</td>
                            </tr>
                            
                        </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
