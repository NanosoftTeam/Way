@extends('layouts.app')

<?php

//use App\Http\Controllers; <--- errory

use Illuminate\Support\Facades\Auth; ?>

@section('javascript')

    import { Api } from 'public/js/api.js';

    $( document ).ready(function() {
    console.log("test");

    var json = `[
  {
    name: 'test1',
    semester: [ [Object], [Object], [Object], [Object] ],
    tempAverage: NaN,
    average: NaN
  },
  {
    name: 'test2',
    semester: [ [Object], [Object], [Object], [Object] ],
    tempAverage: NaN,
    average: NaN
  },
  {
    name: 'test3',
    semester: [ [Object], [Object], [Object], [Object] ],
    tempAverage: NaN,
    average: NaN
  }
]`;
    json = json.replace(/name/g, '"name"');
    json = json.replace(/semester/g, '"semester"');
    json = json.replace(/tempAverage/g, '"tempAverage"');
    json = json.replace(/average/g, '"average"');
    json = json.replace(/'/g, '"');
    json = json.replace(/Object/g, '"x"');
    json = json.replace(/NaN/g, '0');


    const api = new Librus();
    api.authorize('gg', 'gg').then(() => {
        api.info.getGrades().then((grades) => {
            console.log(grades);
        });
    });

    var data = JSON.parse(json);

    console.log(data);

    data.forEach(myFunction);

    function myFunction(item) {
        document.getElementById('table-content1').innerHTML = document.getElementById('table-content1').innerHTML + `<tr>
                                            <td>` + item["name"] + `</td>
                                            <td>x</td>
                                            <td>x</td>
                                            <td>x</td>
                                        </tr>`;
    }
});
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Gradebook') }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead" id="table-content1">
                                <tr>
                                    <th>Subject</th>
                                    <th>Grade</th>
                                    <th>Description</th>
                                    <th>Teacher</th>
                                </tr>

                                    <?php
                                //LibrusController::getData(Auth::user()->librus_id, Auth::user()->librus_password); <---- errory
                                ?>
                                    <!--oreach($grades as $grade)
                                    <tr>
                                        <td>$grade->subject}}</td>
                                        <td>$grade->grade}}</td>
                                        <td>{$grade->description}}</td>
                                        <td>{$grade->teacher}}</td>
                                    </tr>
                                endforeach-->
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
