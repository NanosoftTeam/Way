<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class LibrusController extends Controller
{

    /*
     * @return Renderable
     */
    public function index(): Renderable {
        return view('gradebook.index');
    }


}
