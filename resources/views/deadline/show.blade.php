@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('javascript2')
function delete1(id1, name) {
    let czy = prompt("Usunąć obiekt tak/nie? nazwa: " + name);
    if (czy == "tak") {
        
        $.ajax({
            method: "DELETE",
            url: "{{ config('app.url', 'Laravel') }}/deadlines/" + id1,
        data: { id: id1}
        })
        .done(function( msg ) {
            window.location.href = "{{ route('deadlines.index') }}";
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection

@section('template_title')
    {{ $deadline->name ?? 'Show Deadline' }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <?php    
                $color = array("danger", "info", "warning", "success", "secondary");
                ?>
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('deadlines.index') }}">Deadliney</a> > {{ $deadline->name }}
                            <a class="btn btn-sm btn-success" href="{{ route('deadlines.edit',$deadline->id) }}" style="margin-left: 5px;"><i class="fa fa-fw fa-edit"></i> Edit</a>
                            <button type="button" onclick="delete1({{ $deadline->id}}, '{{$deadline->name}}')" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                        </span>
                    </div>

                    <div class="card-body">

                        <table class="table table-sm" id="table-film-info">

                        <thead>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Name</td>
                                <td id="t-name">@if($deadline->is_planned == 0) ❌ @endif<b>{{ $deadline->name }}</b></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Date:</td>
                                <td id="t-name"><b>{{ $deadline->date }}</b></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Type</td>
                                <td id="t-name"><b>{{ $deadline->type }}</b></td>
                            </tr>
                            @isset($deadline->team)
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Team</td>
                                <td id="t-name"><b>{{ $deadline->team->name }}</b></td>
                            </tr>
                            @endisset
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%">Cel</td>
                                <td ><b><a href="@isset($deadline->goal) {{ route('goals.show', $deadline->goal_id) }} @else # @endisset">{{ $deadline->goal->name ?? '' }}</a></b></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%">Opis</td>
                                <td >{!!nl2br($deadline->description)!!}</td>
                            </tr>
                            
                        </tbody>
                        </table>
                        <p class="bg-{{ $color[$deadline->priority] }}">Priotytet: {{ $deadline->priority }}</p>

                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
