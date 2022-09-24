<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller{

    public function template1(){
        return view('layouts/app');
    }

    public function template2()
    {
        return view('layouts/app2');
    }

}
