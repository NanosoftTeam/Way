@extends('layouts.app')

@section('template_title')
    {{ $important->name ?? 'Show Important' }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('importants.index') }}">Importants</a> > {{ $important->name }}</span>
                    </div>

                    <div class="card-body">
                    <a class="btn btn-sm btn-success" href="{{ route('importants.edit',$important->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                    <br /><br />
                    <table class="table table-sm" id="table-film-info">

                    <thead>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="name">Nazwa</td>
                            <td id="t-name">{{ $important->name }}</td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="type">Typ</td>
                            <td id="t-type">{{ $important->type }}</td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="description">Opis</td>
                            <td id="t-description">{!!nl2br($important->description) !!}</td>
                        </tr>
                        <tr>
                            <td class="table-active text-secondary" style="width: 20%" data-field="url">URLs</td>
                            <td id="t-url"><a class="btn btn-sm btn-secondary" href="{{ $important->url }}">Zobacz</a></td>
                        </tr> 
                    </tbody>
                    </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
