@extends('layouts.app')

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
                                
                                <a href="{{ route('clothes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                                 
                                <a href="{{ route('clothes.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left" style="margin-right: 3px;">
                                    <i class="fa-solid fa-arrow-left-long"></i> Wróć
                                </a>
                              </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <form method="GET" action="{{ route('clothes.index2') }}" role="form" enctype="multipart/form-data">
                                <input name="id" id="search" placeholder="ID" value="<?php if(isset($_GET['id'])){ echo $_GET['id']; } ?>" type="text" class="form-control" style="width: 180px;">
                                <input name="type" id="search" placeholder="Type" value="<?php if(isset($_GET['type'])){ echo $_GET['type']; } ?>" type="text" class="form-control" style="width: 180px;">
                                <input name="subtype" id="search" placeholder="Subtype" value="<?php if(isset($_GET['subtype'])){ echo $_GET['subtype']; } ?>" type="text" class="form-control" style="width: 180px;">
                                <select name="status" id="status" class="form-control" style="width: 180px;">
                                    <option value="">Wszystkie statusy</option>
                                    <option value="0"  @if($if_status == '0') selected @endif>Na miejscu</option>
                                    <option value="1"  @if($if_status == '1') selected @endif>Na sobie</option>
                                    <option value="2" @if($if_status == '2') selected @endif>Spakowane</option>
                                    <option value="3" @if($if_status == '3') selected @endif>W praniu</option>
                                    <option value="4" @if($if_status == '4') selected @endif>Oczekuje na położenie na miejscu</option>
                                    <option value="5" @if($if_status == '5') selected @endif>Zaginione</option>
                                    <option value="6" @if($if_status == '6') selected @endif>Oddane</option>
                                    <option value="7" @if($if_status == '7') selected @endif>Inny</option>
                                </select>
                                <input name="place" id="search" placeholder="Place" value="<?php if(isset($_GET['place'])){ echo $_GET['place']; } ?>" type="text" class="form-control" style="width: 180px;">
                                <input name="notes" id="search" placeholder="Notes" value="<?php if(isset($_GET['notes'])){ echo $_GET['notes']; } ?>" type="text" class="form-control" style="width: 180px;">
                                <br />
                                <button type="submit" class="btn btn-info" name="action" value="save1">Zapisz</button>
                            </form>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <b>Na stronie {{ $clothes->count() }}</b>
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('clothes.update2') }}" role="form" enctype="multipart/form-data">
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
											<td><span class="badge badge-pill badge-{{ $color[$c->status] }}">{{ $status[$c->status] }}</span><br />
                                            (Ostatnia zmiana {{ $c->last_status_changed." (".\Carbon\Carbon::parse($c->last_status_changed)->diffForHumans().")" }})</td>
											<td>{{ $c->place }}</td>
                                            <td>{{ $c->notes }}</td>

                                            <td>
                                                <select name="clothes[{{ $c->id }}][status]" id="status" class="form-control float-left" style="width: 180px;">
                                                    <option value="0"  @if($c->status == '0') selected @endif>Na miejscu</option>
                                                    <option value="1"  @if($c->status == '1') selected @endif>Na sobie</option>
                                                    <option value="2" @if($c->status == '2') selected @endif>Spakowane</option>
                                                    <option value="3" @if($c->status == '3') selected @endif>W praniu</option>
                                                    <option value="4" @if($c->status == '4') selected @endif>Oczekuje na położenie na miejscu</option>
                                                    <option value="5" @if($c->status == '5') selected @endif>Zaginione</option>
                                                    <option value="6" @if($c->status == '6') selected @endif>Oddane</option>
                                                    <option value="7" @if($c->status == '7') selected @endif>Inny</option>
                                                </select>
                                                <a class="float-left" href="{{ route('clothes.edit',$c->id) }}"><i class="fa fa-fw fa-edit"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-info" name="action" value="save1">Zapisz zmiay w tabeli</button>
                            </form>
                        </div>
                    </div>
                </div>
                {!! $clothes->links() !!}
            </div>
        </div>
    </div>
@endsection
