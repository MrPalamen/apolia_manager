<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ControllerFines extends Controller
{
    public function __construct()
    {
        if (!in_array(Session::get('grade'), ['administrator', 'moderator']))
            return redirect()->route('manager');
    }

    public function index(Request $id)
    {
        dd($id);
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
