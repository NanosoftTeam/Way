<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Auth;

class WelcomeController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $settings_content = Settings::find(1);
        return view('welcome', [
            'settings_content' => $settings_content->content,
        ]);
    }
}
