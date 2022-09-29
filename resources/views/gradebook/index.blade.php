@extends('layouts.app')

<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; ?>
@section('javascript2')

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
                                <thead class="thead">
                                <tr>
                                    <th>Subject</th>
                                    <th>Grade</th>
                                    <th>Description</th>
                                    <th>Teacher</th>
                                </tr>
                                    <?php
                                LibrusController::getData(Auth::user()->librus_id, Auth::user()->librus_password);
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
