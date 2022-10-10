@if(Session::get('team_id') == 0)
<?php $e = "layouts.app"; ?>
@else
<?php $e = "layouts.app3"; ?>
@endif

@extends($e)

@section('template_title')
    Create Word
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Listy słówek > <a href="{{ route('wordlists.show', $wordlist->id) }}">{{ $wordlist->name }}</a> > nauka</span>
                        <button type="button" id="finish-button" class="btn btn-primary btn-sm">Zakończ</button>

                    </div>
                    <div class="card-body" id="card-body">
                        <p class="text-success" id="correct" style="display: none;">Dobrze!</p>
                        <p class="text-danger" id="incorrect" style="display: none;">Źle, napisz poprawną odpowiedź!</p>
                        <h3 id="word-translation">Ładowanie tłumaczenia...</h3>
                        <input name="name" id="input-text" type="text" class="form-control form-control2" autocomplete="off">
                        <h4 id="word-name" style="display: none;">Ładowanie słowa...</h4>
                        <br />
                        <button type="button" id="submit-button" class="btn btn-success" style="display: block;">Sprawdź</button>
                        <button type="button" id="ok-button" class="btn btn-success" style="display: none;">OK</button>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

@section('javascript')
$( document ).ready(function() {
    let words_names = [
        @foreach($words as $word)
            {!! '"'.$word->name.'", ' !!}
        @endforeach    
    ];

    let words_translations = [
        @foreach($words as $word)
            {!! '"'.$word->translation.'", ' !!}
        @endforeach    
    ];

    let words_output = [
        @foreach($words as $word)
           {!! (0).", " !!} 
        @endforeach    
    ];

    let words_correct = [
        @foreach($words as $word)
           {!! (0).", " !!} 
        @endforeach    
    ];

    let words_id = [
        @foreach($words as $word)
            {!! '"'.$word->id.'", ' !!}
        @endforeach    
    ];

    let actual_word = 0;
    let sprawdzanie = false;
    let fast_mode = false;
    let total_words = {{ $words->count() }};

    $("#word-translation").text(words_translations[actual_word]);

    const input = document.getElementById('input-text');
            input.focus();
            input.setSelectionRange(0,0);
    
    $(document).on('click', '#submit-button', function() {
           if(words_names[actual_word] == $("#input-text").val()){
                $("#correct").css('display', 'block');
                words_output[actual_word] += 1;
                words_correct[actual_word] = 1;

                
                
            }else{
                $("#incorrect").css('display', 'block');
                if(words_output[actual_word] == 0){
                    words_output[actual_word] -= 2;
                }
                else{
                    words_output[actual_word] -= 1;
                }
                
           }       
           $("#submit-button").css('display', 'none');
           $("#ok-button").css('display', 'block');
           $("#word-name").text(words_names[actual_word]);
           $("#word-name").css('display', 'block');
           //$("#input-text").prop("disabled", true);

           sprawdzanie = true;

           if(words_names[actual_word] == $("#input-text").val()){
            fast_mode = true;
            $('#ok-button').trigger('click');
           }
           else{
            $("#word-name").html("<b>" + $("#word-name").text()+ "</b>" + " ty: <b>" + $("#input-text").val() + "</b>");
           $("#input-text").val("");
           }
           
        })

        

        $(document).on('click', '#ok-button', function() {
            if(words_names[actual_word] == $("#input-text").val() || fast_mode == true){
                sprawdzanie = false;
                fast_mode = false;
                $("#submit-button").css('display', 'block');
                $("#ok-button").css('display', 'none');
                actual_word += 1;
                while(actual_word < total_words && words_correct[actual_word] == 1){
                    actual_word += 1;
                    //console.log("a" + actual_word);
                }
                if(actual_word >= total_words){
                    actual_word = 0;
                    //console.log("b" + actual_word);
                }
                while(actual_word < total_words && words_correct[actual_word] == 1){
                    actual_word += 1;
                    //console.log("c" + actual_word);
                }
                
                if(actual_word >= total_words){
                        //alert("koniec");
                        //console.log("koniec uczenia");
                        $("#card-body").html("<h3>Koniec!</h3>");
                        $.ajax({
                            method: "POST",
                            url: "{{ config('app.url', 'Laravel') }}/wordlists/learn-finish/" + {{ $wordlist->id }},
                            data: { words_output: words_output,
                                    words_id: words_id
                                }
                        })
                        .done(function( msg ) {
                            window.location.href = "{{ route('wordlists.show', $wordlist->id) }}";
                            
                        })
                        .fail(function( msg ) {
                            alert("error");
                        });
                    }
                $("#word-translation").text(words_translations[actual_word]);
                $("#correct").css('display', 'none');
                $("#incorrect").css('display', 'none');
                $("#input-text").val("");
                //$("#input-text").prop("disabled", false);
                $("#word-name").css('display', 'none');

                const input = document.getElementById('input-text');
                    input.focus();
                    input.setSelectionRange(0,0);
            }
            
        })

        $(document).on('keypress',function(e) {
                if(e.which == 13) {
                    if(sprawdzanie){
                        $('#ok-button').trigger('click');
                    }else{
                        $('#submit-button').trigger('click');
                    }
                }
            });

        $(document).on('click', '#finish-button', function() { 
            //alert("koniec");
            //console.log("koniec uczenia");
            $("#card-body").html("<h3>Koniec!</h3>");
            $.ajax({
                method: "POST",
                url: "{{ config('app.url', 'Laravel') }}/wordlists/learn-finish/" + {{ $wordlist->id }},
                data: { words_output: words_output,
                        words_id: words_id
                    }
            })
            .done(function( msg ) {
                window.location.href = "{{ route('wordlists.show', $wordlist->id) }}";
                
            })
            .fail(function( msg ) {
                alert("error");
            });
        })

            

    
});
@endsection
