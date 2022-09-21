@extends('layouts.app')

@section('template_title')
    Important
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Important') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('importants.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                <i class="fa-solid fa-plus"></i> Nowe
                                </a>
                              </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
										<th>Name</th>
										<th>Type</th>
										<th>Url</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($importants as $important)
                                        <tr>                                            
											<td>{{ $important->name }}</td>
											<td>{{ $important->type }}</td>
											<td><a class="btn btn-sm btn-secondary" href="{{ $important->url }}">Zobacz</a></td>

                                            <td>
                                                <form action="{{ route('importants.destroy',$important->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('importants.show',$important->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('importants.edit',$important->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $importants->links() !!}
            </div>
        </div>
    </div>
@endsection
