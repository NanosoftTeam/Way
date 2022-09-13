<?php
$status  = array("Pomysł", "Oczekuje", "Otwarty", "Zamknięty");
$color = array("secondary", "primary", "success", "danger");
$channel  = array("Infast", "Infast Animations");
$category  = array("Mine-imator", "MCreator", "MC Animation");
?>

<div class="container">
  <div class="row">
    <div class="col-sm">
        <div class="card">
            <div class="card-header"><a href="{{ route('courses.index') }}">Kursy</a> > {{ $course->name }}
                
            </div>

            <div class="card-body" id="n-info" style="padding-top: 1px;">
                @include('courses.tabs.info')
            </div>
        </div>
    </div>
    <div class="col-sm">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-films-tab" data-toggle="tab" href="#nav-films" role="tab" aria-controls="nav-films" aria-selected="false">Filmy</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            
            <div class="tab-pane fade show active" id="nav-films" role="tabpanel" aria-labelledby="nav-films-tab">
                @include('courses.tabs.films')
            </div>
        </div>

    </div>
  </div>
</div>



