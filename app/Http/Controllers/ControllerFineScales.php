<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;

class ControllerFineScales extends Controller
{
    public function __construct()
    {
        if (!in_array(Session::get('grade'), ['administrator', 'moderator']))
            return redirect()->route('manager');
    }

    public function index()
    {
        return view('fines.home');
    }

    public function search()
    {

    }

    public function create()
    {

    }

    public function record()
    {

    }
}
