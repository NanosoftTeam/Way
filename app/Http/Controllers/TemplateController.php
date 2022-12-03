<?php

namespace App\Http\Controllers;

class TemplateController extends Controller{

    public function template1(){
        return view('layouts/app');
    }

    public function template2()
    {
        return view('layouts/app2');
    }

}
