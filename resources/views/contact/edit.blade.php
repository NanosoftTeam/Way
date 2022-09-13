@extends('layouts.app')

@section('template_title')
    Update Contact
@endsection

@section('content')
    <div class="container">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"><a href="{{ route('contacts.index') }}">Kontakty</a> ><a href="{{ route('contacts.show', $contact->id) }}">{{ $contact->name }}</a> > Edycja</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('contacts.update', $contact->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('contact.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
