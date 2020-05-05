<?php

namespace App\Http\Controllers;

use App\Fine;
use App\FineScale;
use App\Records;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ControllerFines extends Controller
{
    public function __construct()
    {
        if (!in_array(Session::get('grade'), ['administrator', 'moderator']))
            return redirect()->route('manager');
    }

    public function index($id)
    {
        if ($id > 0){
            $record = (object)Records::find($id)->toArray();
            $fines = FineScale::all()->sortBy('type',)->toArray();
            $fine = Fine::where('user_id', $id)->get()->toArray();
            $number = 12;
            foreach ($fine as $key => $value)
            {
                $number = $number - $value['points'];
            }
            return view('fines.home', ['record' => $record, 'fines' => $fines, 'number' => $number]);
        } else {
            return redirect()->route('manager');
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'item_type' => 'required',
            'item_name' => 'required',
            'item_points' => 'required',
            'item_price' => 'required',
            'item_option' => 'required'
        ]);

        if ($request->all() !== null) {
            foreach ($request->input('item_type') as $key => $fines) {
                Fine::create(array(
                    'type' => $request->input("item_type.$key"),
                    'name' => $request->input("item_name.$key"),
                    'points' => $request->input("item_points.$key"),
                    'price' => $request->input("item_price.$key"),
                    'option' => $request->input("item_option.$key"),
                    'user_id' => $request->input('id')
                ));
            }

            $record = (object)Records::find($request->input('id'))->toArray();

            Records::find($request->input('id'))->update(array(
                'credit' => $request->input('credit') + $record->credit,
            ));
            $request->session()->flash('status', 'Task was successful!');
            return redirect()->route('records_view', $request->input('id'));
        }
        else
        {
            $request->session()->flash('status_error', 'error update');
            return redirect()->route('records');
        }

    }

    public function edit($id)
    {
        $view = (object)Fine::find($id)->toArray();
        return view('fines.edit', ['view' => $view]);
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

        $view = (object)Fine::find($request->input('id'))->toArray();
        if ($request->all() !== null){

            Fine::find($request->input('id'))->update(array(
                'type' => $request->input('type'),
                'name'  => $request->input('name'),
                'points' => $request->input('point'),
                'price' => $request->input('price'),
                'option' => $option
            ));

            $request->session()->flash('status', 'Task was successful!');
            return redirect()->route('records_view', $view->user_id);
        }
        else
        {
            $request->session()->flash('status_error', 'error update');
            return redirect()->route('records_view', $view->user_id);
        }
    }

    public function delete(Request $request)
    {
        if ($request->input('id') >= 1)
        {
            $records = Fine::find($request->input('id'))->delete();
            return response()->json($records);
        }
        else
        {
            $request->session()->flash('status_error', 'error delete');
            return redirect()->route('records');
        }
    }
}
