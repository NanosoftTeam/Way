<?php

namespace App\Http\Controllers;

use DOMDocument;
use DOMXPath;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Support\Renderable;
require '../vendor/autoload.php';

class LibrusController extends Controller
{

    /*
     * @return Renderable
     */
    public function index(): Renderable {
        return view('gradebook.index');
    }

    /**
     * @throws GuzzleException
     */
    public function getData($login, $pass) {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.librus.pl/OAuth/Authorization?client_id=46', [
            'form_params' => [
                'action' => 'login',
                'username' => $login,
                'password' => $pass
            ]
        ]);
        echo $response->getBody();
    }
}

