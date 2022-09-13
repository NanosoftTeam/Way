@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <b>Wszystkie zmiany</b> | 
        </div>

        <div class="card-body">
            
                    <section class="changes">

                        <div id="load" style="position: relative;">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">Nazwa</th>
                                <th scope="col"></th>
                                <th scope="col" style="width:10px"></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $models = array('film', "kurs", "zadanie", "użytkownika", "notatkę");
                                $actions = array("tworzy", "edytuje", "usuwa");
                                ?>
                                @foreach($changes as $change)
                                    <tr>
                                        <td><i class="fa-solid fa-user"></i> {{ $change->user->name." ".$actions[$change->action]}} <span class="badge badge-warning">{{ $models[$change->model] }}</span> <i class="text-secondary">{{ $change->name }}</i></td>
                                        <td><i class="fa-solid fa-clock"></i> {{ $change->updated_at }} <span class="badge badge-info">{{ $change->updated_at->diffForHumans() }}</span></td>
                                        <td>
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item text-secondary" href="#" enabled="false">Zobacz</a>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>



                        </div>
                        {{ $changes->links() }}
                    </section>
        </div>
    </div>
    
</div>
        
@endsection
@section('javascript')

@endsection