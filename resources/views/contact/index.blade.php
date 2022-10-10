@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('javascript2')
function delete1(id1, name) {
    let czy = prompt("Usunąć kontakt tak/nie? nazwa: " + name);
    if (czy == "tak") {
        
        $.ajax({
            method: "DELETE",
            url: "{{ config('app.url', 'Laravel') }}/contacts/" + id1,
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
    Contact
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Contact') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('contacts.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
										<th>Name</th>
										<th>Surname</th>
										<th>Email</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr>
											<td>{{ $contact->name }}</td>
											<td>{{ $contact->surname }}</td>
											<td>{{ $contact->email }}</td>

                                            <td>
                                                <form action="{{ route('contacts.destroy',$contact->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('contacts.show',$contact->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('contacts.edit',$contact->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    <button type="button" onclick="delete1({{ $contact->id}}, '{{$contact->name}}')" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $contacts->links() !!}
            </div>
        </div>
    </div>
@endsection
