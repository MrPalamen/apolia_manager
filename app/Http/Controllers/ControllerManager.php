<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ControllerManager extends Controller
{

    public function index()
    {
        return view('home');
    }
}
