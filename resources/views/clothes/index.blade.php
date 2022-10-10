@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('template_title')
    Clothes
@endsection

@section('content')
<?php
$status  = array("Na miejscu", "Na sobie", "Spakowane", "W praniu", "Oczekuje na położenie na miejscu", "Zaginione", "Oddane", "Inny");
$color = array("success", "success", "success", "primary", "warning", "danger", "secondary", "primary");

?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Clothes') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('clothes.index2') }}" class="btn btn-primary btn-sm float-right" data-placement="left" style="margin-left: 5px;">
                                    <i class="fa-solid fa-magnifying-glass"></i> Szukaj
                                </a>
                                <a href="{{ route('clothes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  <i class="fa-solid fa-plus"></i> Nowe
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>
                                        <th>Type</th>
										<th>Status</th>
										<th>Place</th>
                                        <th>Notes</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clothes as $c)
                                        <tr>
                                            <td>{{ $c->id }}</td>
											<td>{{ $c->type." ".$c->subtype }}</td>
											<td><span class="badge badge-pill badge-{{ $color[$c->status] }}">{{ $status[$c->status] }}</span></td>
											<td>{{ $c->place }}</td>
                                            <td>{{ $c->notes }}</td>

                                            <td>
                                                <form action="{{ route('clothes.destroy',$c->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('clothes.show',$c->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('clothes.edit',$c->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $clothes->links() !!}
            </div>
        </div>
    </div>
@endsection
