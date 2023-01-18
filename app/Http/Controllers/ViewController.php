<?php

namespace App\Http\Controllers;

use App\Models\Autos;
use App\Models\Clients;

class ViewController extends Controller
{
    public function home() {
        return view('home', ['data' => Clients::getAll()]);
    }

    public function edit() {
        return view('edit');
    }

    public function parking() {
        return view('parking', ['data' => Autos::getParking()]);
    }

    public function error() {
        return view('error');
    }
}
