@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('javascript2')
function myFunction(id1, name) {
    let czy = prompt("Usunąć notatkę tak/nie? NAJPIERW USUŃ WEWNĘTRZNE FOLDERY" + "\n \n nazwa: " + name);

    if (czy == "tak") {
        $.ajax({
            method: "GET",
            url: "{{ config('app.url', 'Laravel') }}/notes/d/" + id1,
        data: { id: id1}
        })
        .done(function( msg ) {
            getArticles(window.location.href);
            $('#show_note').modal('hide');
            
        })
        .fail(function( msg ) {
            alert("error");
        });
    }
}
@endsection

@section('content')

<div class="container">
    @if(Session::get('team_id') == 0)
    <div class="card">
        <div class="card-header">
            <b>Notatki</b> | 
            <button type="button" data-toggle="modal" data-target="#add_note" class="btn btn-primary btn-sm pull-right" id="add-t"><i class="fa-solid fa-plus"></i> Nowe</button>
            <label class=""><input type="checkbox" name="only-projects" class="select-f" id="only-projects"> Tylko projekty</label>
            
            
            <a data-toggle="collapse" href="#collapse-filters" role="button" aria-expanded="false" aria-controls="collapse-filters"><button type="button" class="btn btn-link"><i class="fa-solid fa-filter"></i> Filtry</button></a>

        </div>
        <div class="card-header collapse multi-collapse" id="collapse-filters">
            <div class="form-inline">
                <input name="search" id="search" placeholder="Szukaj" type="text" class="form-control float-left select-f" style="width: 180px;">
            </div>
        </div>

        <div class="card-body" style="padding-top: 0px;">
        
                    <section class="notes">
                        @include('notes.load')
                    </section>
        </div>
    </div>
    @else
    <div class="alert alert-warning" role="alert">
        Ten moduł jest dostępny tylko w wersji personal
    </div>
    @endif
    
</div>

<div class="modal fade bd-example-modal-lg" id="add_note" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notatka</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  action="#" id="form-add-note">
                        <table class="table table-sm" id="table-film-info">

                        <thead>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name">Nazwa</td>
                                <td id="t-name"><input name="name" id="name" type="text" class="form-control form-control2" required></td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%">Należy do</td>
                                <td >
                                    <input name="name3" id="search1" type="text" autocomplete="off" class="form-control form-control2">
                                    <input name="parent_id" id="parent_id" type="hidden" class="form-control form-control2">
                                    <label id="search-text" style="margin-bottom: 1px;">Wybrano: [brak]</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%">Treść</td>
                                <td ><textarea id="content" name="content" class="form-control form-control2 content" rows="10"></textarea></td>
                            </tr>
                            <tr>
                                
                            </tr>
                            <tr>
                                <td class="table-active text-secondary" style="width: 20%" data-field="name"></td>
                                <td id="t-name"><input type="checkbox" name="addmany" id="addmany"><label class=""> Dodaj wiele z opisu</label></td>
                            </tr>
                        </tbody>
                    </table>



                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit" data-id="" >Zapisz</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                </div>
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
                                <input name="name3" id="search2" type="text" autocomplete="off" class="form-control form-control2">
                                <input name="parent_id" id="parent_id2" type="hidden" class="form-control form-control2">
                                <label id="search2-text" style="margin-bottom: 1px;">Wybrano: [nie zmieniono]</label>
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
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="show_note" tabindex="-3" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notatka</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-show-note" style="padding-top: 0px;">
                    ...
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')


    $( document ).ready(function() {
        path = "{{ route('notes.search') }}";
        
        $('#search1').typeahead({
            source: function(query, process){
                if (typeof timeout !== 'undefined') {
                    clearTimeout(timeout);
                }

                timeout = setTimeout(function() {
                    objects = [];
                    map = {};

                    

                    $.getJSON(path + '?query='+query,function(data){
                            var data = $.map(data,function(row){
                                return {
                                    id:row.id,
                                    name:row.name,
                                }
                            })
                            

                            //console.log(data);

                            

                            $.each(data, function(i, object) {
                            map[object.name] = object;
                            objects.push(object.name);
                        });
                        return process(objects);

                    })
                }, 300);

            },
            updater: function(item) {
                //alert(map[item].id);
                $('#parent_id').val(map[item].id);
                $('#search-text').text("Wybrano: " + map[item].name);
                return item;
            }

        });
        
        $('#search2').typeahead({

            source: function(query, process){
                if (typeof timeout !== 'undefined') {
                    clearTimeout(timeout);
                }

                timeout = setTimeout(function() {
                    objects = [];
                    map = {};

                    

                    $.getJSON(path + '?query='+query,function(data){
                            var data = $.map(data,function(row){
                                return {
                                    id:row.id,
                                    name:row.name,
                                }
                            })
                            

                            //console.log(data);

                            

                            $.each(data, function(i, object) {
                            map[object.name] = object;
                            objects.push(object.name);
                        });
                        return process(objects);

                    })
                }, 300);

            },
            updater: function(item) {
                //alert(map[item].id);
                $('#parent_id2').val(map[item].id);
                $('#search2-text').text("Wybrano: " + map[item].name);
                return item;
            }

        });
        
        let parent = @if(isset($_GET['parent'])) {{ $_GET['parent'] }} @else 0 @endif;
        let film = @if(isset($_GET['film'])) '{{ $_GET['film'] }}' @else 'a' @endif;
        let l_parent;

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
                        document.getElementById('search2').value = obj.parent_name;
                        console.log(obj.parent_name);
                        if(obj.parent_name == "") {
                            $('#search2-text').text("Wybrano: brak");
                        }
                        else{
                            $('#search2-text').text("Wybrano: [nie zmieniono]");
                        }
                        
                    }
                })
            
        })

        var interval2;

        $(document).on('click', '.show2', function() {
            if($(this).data("child") == " 1 "){
                //alert("ma podzadania");
                l_parent = parent;
                parent = $(this).data("id");

                $('#load a').css('color', '#dfecf6');
                $('#load').append('<img style="position: absolute; left: 45%; top: 10%;" src="https://demos.laraget.com/images/loading2.gif" />');
                var only_projects = 0;
                if($("#only-projects").is(":checked")){
                    only_projects = 1;
                }
                getArticles(window.location.pathname + "?parent=" + parent + "&projects=" + only_projects + "&search=" + $('#search').val());
                window.history.pushState({}, '', window.location.pathname + "?parent=" + parent + "&projects=" + only_projects + "&search=" + $('#search').val());
            }
            else{
                $('#show_note').modal('show');
                $('#modal-show-note').html('<img style="display: block; margin: 0 auto;" src="https://demos.laraget.com/images/loading2.gif" />');

                $.ajax({
                        url : "{{ config('app.url', 'Laravel') }}/notes/m/" + $(this).data("id"),
                    }).done(function (data) {
                        $('#modal-show-note').html(data);
                    }).fail(function () {
                        alert('Modal could not be loaded.');
                });

                var mid = $(this).data("id"); 

                interval2 = setInterval(function(){
                    $.ajax({
                        url : "{{ config('app.url', 'Laravel') }}/notes/m/" + mid,
                    }).done(function (data) {
                        $('#modal-show-note').html(data);
                    }).fail(function () {
                        alert('Modal could not be loaded.');
                    });
                }, 30000);
            }
            
        })

        $(document).on('click', '.b-last', function() {
            l_parent = $(this).data("last");
            parent = l_parent;
            
            $('#load a').css('color', '#dfecf6');
            $('#load').append('<img style="position: absolute; left: 45%; top: 10%;" src="https://demos.laraget.com/images/loading2.gif" />');
            var only_projects = 0;
            if($("#only-projects").is(":checked")){
                only_projects = 1;
            }
            getArticles(window.location.pathname + "?parent=" + parent + "&projects=" + only_projects + "&search=" + $('#search').val());
            window.history.pushState({}, '', window.location.pathname + "?parent=" + parent + "&projects=" + only_projects + "&search=" + $('#search').val());
            
        })

        $('#show_note').on('hidden.bs.modal', function () {
            clearInterval(interval2);
        });

        var status  = ["Pomysł", "Do zrobienia", "W trakcie", "Testy", "Gotowe"];
        var color = ["secondary", "danger", "warning", "primary", "success"];

        $(document).on('click', '#submit2', function() { 
            $('#edit_note').modal('hide');
            
            var id11 = $('#submit2').attr('data-id')
            //var status22 = document.getElementById('status2').value;

            //document.getElementById('t' + id11).innerHTML = document.getElementById('name2').value;
            //document.getElementById('s' + id11).innerHTML = '<span class="badge badge-pill badge-' + color[status22] + '">' + status[status22] + '</span>';
            //document.getElementById('e' + id11).innerHTML = "czekaj...";
            


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

       
        $(document).on('click', '#add-t', function() {
            if(parent != 0){
                document.getElementById("parent_id").value = parent;
                $('#search-text').text("Wybrano: [w aktualnym folderze]");
                $('#search1').val("[w akt. folderze]");
                
            }else{
                $('#search-text').text("Wybrano: [brak]");
                $('#search1').val("");
            }

            if(film != 'a'){
                //document.getElementById("film_id").value = film;
                
            }
            else{
                //document.getElementById("film_id").value = 0;
            }
            
            
           
        })

        
        $(document).on('click', '#submit', function() { 
            $('#add_note').modal('hide');
            $.ajax({
                method: "POST",
                url: "{{ config('app.url', 'Laravel') }}/notes/new" ,
                data: $("#form-add-note").serialize(),
                
                success:function(response)
                {
                    document.getElementById("form-add-note").reset();
                    
                    

                    getArticles(window.location.href);
                }
            })
           
        })

        $(document).on('change', '.select-f', function() {
            $('#load a').css('color', '#dfecf6');
            $('#load').append('<img style="position: absolute; left: 45%; top: 10%;" src="https://demos.laraget.com/images/loading2.gif" />');
            var only_projects = 0;
            if($("#only-projects").is(":checked")){
                only_projects = 1;
            }
            getArticles(window.location.pathname + "?parent=" + parent + "&projects=" + only_projects + "&search=" + $('#search').val());
            window.history.pushState({}, '', window.location.pathname + "?parent=" + parent + "&projects=" + only_projects + "&search=" + $('#search').val());
            //const queryString = window.location.search;
            //film = $('#select-film option:selected').val();
        });
            

        @if(isset($_GET['projects'])) 
        $('#collapse-filters').collapse('show');
        @endif
        @if(isset($_GET['search'])) document.getElementById('search').value = '{{ $_GET['search'] }}'; @endif
        @if(isset($_GET['projects']) and $_GET['projects'] == 1) $("#only-projects").prop('checked', true); @endif
        
            
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
                    $('.notes').html(data);
                }).fail(function () {
                    alert('notes could not be loaded.');
                });
            }

            setInterval(function(){
                getArticles(window.location.href)
            }, 30000);
@endsection