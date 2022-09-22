@extends('layouts.app')

@section('javascript2')
function myFunction(id1, name) {
    let czy = prompt("Usunąć notatkę tak/nie? nazwa: " + name);

    if (czy == "tak") {
        $.ajax({
            method: "GET",
            url: "{{ config('app.url', 'Laravel') }}/notes/d/" + id1,
        data: { id: id1}
        })
        .done(function( msg ) {
            window.location.href = "{{ route('notes.index') }}";
            
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection

@section('content')
<?php
$status  = array("Pomysł", "Do zrobienia", "W trakcie", "Testy", "Gotowe");
$color = array("secondary", "danger", "warning", "primary", "success");
$channel  = array("Infast", "Infast Animations");
$category  = array("Mine-imator", "MCreator", "MC Animation");
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" id="note-info">
            @include('notes.show-load')
            
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="edit_note" tabindex="-2" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="overflow-y: auto !important;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notatka</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form  action="#" id="form-edit-note">
                <table class="table table-sm" id="table-film-info">

                <thead>
                    
                </thead>
                <tbody>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%" data-field="name">Nazwa</td>
                        <td id="t-name"><input name="name" id="name2" type="text" class="form-control form-control2" required></td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Należy do</td>
                        <td >
                            <select id="parent_id2" class="form-control form-control2" name="parent_id" value="" required autocomplete="parent_id">
                                <option class="form-control form-control2" value="">Brak</option>
                                @foreach($notes_all as $note)
                                    <option class="form-control form-control2" value="{{ $note->id }}">{{ $note->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-active text-secondary" style="width: 20%">Treść</td>
                        <td ><textarea id="content2" name="content" class="form-control form-control2 content" rows="10"></textarea></td>
                    </tr>     
                </tbody>
                </table>           
                </form>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit2" data-id="" >Zapisz</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    

    $( document ).ready(function() {
        
        $(document).on('click', '.edit', function() {
            $('#show_note').modal('hide');
            $('#edit_note').modal('show');
            $.ajax({
                method: "POST",
                url: "{{ config('app.url', 'Laravel') }}/notes/edit/" + $(this).data("id"),
                data: { id: $(this).data("id")},
                
                success:function(response)
                {
                    //alert(response);
                    obj = JSON.parse(JSON.stringify(response))
                    //alert(obj.name);

                    //document.getElementById("submit2").data("id") = "{{ config('app.url', 'Laravel') }}/notes/update/" + obj.id;
                    $('#submit2').attr('data-id' , obj.id);

                    document.getElementById('name2').value = obj.name;
                    document.getElementById('content2').value = obj.content;
                    document.getElementById('parent_id2').value = obj.parent_id;
                    
                    
                }
            })
        })

        $(document).on('click', '#submit2', function() { 
            $('#edit_note').modal('hide');
            
            var id11 = $('#submit2').attr('data-id')
            //var status22 = document.getElementById('status2').value;

            document.getElementById('b-edit').innerHTML = "Aktualizowanie...";


            $.ajax({
                method: "POST",
                url: "{{ config('app.url', 'Laravel') }}/notes/update/" + id11,
                data: $("#form-edit-note").serialize(),
                
                success:function(response)
                {
                    getArticles(window.location.href);
                    
                    
                }
            })

            $('#submit2').attr('data-id' , "");
           
        })

       


        
            
    });

            

            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                $('#load a').css('color', '#dfecf6');
                $('#load').append('<img style="position: absolute; left: 45%; top: 10%;" src="https://demos.laraget.com/images/loading2.gif" />');

                var url = $(this).attr('href');
                getArticles(url);
                window.history.pushState("", "", url);
            });

            function getArticles(url) {
                $.ajax({
                    url : url
                }).done(function (data) {
                    $('#note-info').html(data);
                }).fail(function () {
                    alert('notes could not be loaded.');
                });
            }

            setInterval(function(){
                getArticles(window.location.href)
            }, 30000);
@endsection
