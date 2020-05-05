<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerRadio extends Controller
{
    public function index()
    {
        $radios = DB::table('radios')->first();
        return view('radio.home', ['radios' => $radios]);
    }

    public function post(Request $request)
    {
        $request->validate([
            'cp' => 'required',
            'lp' => 'required',
            'cp_c' => 'required',
            'lp_c' => 'required'
        ]);

        if($request->all() !== null)
        {
            DB::table('radios')->where('id', 1)->update(array(
                'cp' => $request->input('cp'),
                'lp' => $request->input('lp'),
                'cp_c' => $request->input('cp_c'),
                'lp_c' => $request->input('lp_c'),
                'name_user' => Session::get('user')->name,
                'updated_at' => Carbon::now('Europe/Paris')->format('Y-m-d H:i:s')
            ));
            $request->session()->flash('status', 'Task was successful!');
            return redirect()->route('radio');
        }
        else
        {
            $request->session()->flash('status_error', 'error update');
            return redirect()->route('radio');
        }
    }

    public function reload(Request $request)
    {
        $data = [
            'cp' => rand (50*10, 400*10) / 10,
            'lp' => rand (30*10, 87*10) / 10,
            'cp_c' => rand (50*10, 400*10) / 10,
            'lp_c' => rand (30*10, 87*10) / 10,
        ];

            DB::table('radios')->where('id', 1)->update(array(
                'cp' => $data['cp'],
                'lp' => $data['lp'],
                'cp_c' => $data['cp_c'],
                'lp_c' => $data['lp_c'],
                'name_user' => Session::get('user')->name,
                'updated_at' => Carbon::now('Europe/Paris')->format('Y-m-d H:i:s')
            ));
            $request->session()->flash('status', 'Task was successful!');
            return redirect()->route('radio');
    }

}
