<?php

namespace App\Http\Controllers;




use App\FineScale;
use Illuminate\Http\Request;
use App\DataTables\FineScaleDataTable;
use Illuminate\Support\Facades\Session;

class ControllerFineScales extends Controller
{
    public function __construct()
    {
        if (!in_array(Session::get('grade'), ['administrator', 'moderator']))
            return redirect()->route('manager');
    }

    public function index(FineScaleDataTable $dataTable)
    {
        return $dataTable->render('fine_scale.home');
    }

    public function view($id)
    {
        $view = FineScale::find($id)->toArray();
        return view('fine_scale.view', ['view' => $view]);
    }

    public function edit($id)
    {
        $view = FineScale::find($id)->toArray();
        return view('fine_scale.edit', ['view' => $view]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'point' => 'required',
            'price' => 'required'
        ]);

        $option = null;
        if ($request->input('option'))
            $option = $request->input('option');

        if ($request->all() !== null){

            FineScale::create(array(
                'type' => $request->input('type'),
                'name'  => $request->input('name'),
                'points' => $request->input('point'),
                'price' => $request->input('price'),
                'option' => $option
            ));

            $request->session()->flash('status', 'Task was successful!');
            return redirect()->route('fine_scales');
        }
        else
        {
            $request->session()->flash('status_error', 'error update');
            return redirect()->route('fine_scales');
        }
    }

    public function edit_post(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'type' => 'required',
            'name' => 'required',
            'point' => 'required',
            'price' => 'required'
        ]);

        $option = null;
        if ($request->input('option'))
            $option = $request->input('option');

        if ($request->all() !== null){

            FineScale::find($request->input('id'))->update(array(
                'type' => $request->input('type'),
                'name'  => $request->input('name'),
                'points' => $request->input('point'),
                'price' => $request->input('price'),
                'option' => $option
            ));

            $request->session()->flash('status', 'Task was successful!');
            return redirect()->route('fine_scales');
        }
        else
        {
            $request->session()->flash('status_error', 'error update');
            return redirect()->route('fine_scales');
        }
    }

    public function delete(Request $request)
    {
        if ($request->input('id') >= 1)
        {
            $response = FineScale::find($request->input('id'))->delete();
            return response()->json($response);
        }
        else
        {
            $request->session()->flash('status_error', 'error delete');
            return redirect()->route('records');
        }
    }
}
