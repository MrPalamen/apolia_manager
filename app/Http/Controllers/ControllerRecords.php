<?php

namespace App\Http\Controllers;

use App\Fine;
use App\FineScale;
use App\Records;
use Illuminate\Http\Request;
use App\DataTables\RecordsDataTable;
use Illuminate\Support\Facades\Session;


class ControllerRecords extends Controller
{

    public function index(RecordsDataTable $dataTable)
    {
        return $dataTable->render('record.home');
    }

    public function view($id)
    {
        $view = (object)Records::find($id)->toArray();
        $find = Fine::where('user_id', $id)->get()->toArray();
        if (count($find) > 0){
            $find = Fine::where('user_id', $id)->orderBy('type', 'desc')->get()->toArray();
        }

        $number = 12;
        foreach ($find as $key => $value)
        {
            $number = $number - $value['points'];
        }
        return view('record.view', ['view' => $view, 'find' => $find, 'number' => $number]);
    }


    public function create(Request $request)
    {
        $request->validate([
            'number' => 'required',
            'surname' => 'required',
            'name' => 'required',
            'grade_agent' => 'required'
        ]);

        $note = null;
        if ($request->input('note'))
            $note = $request->input('note');

        if ($request->all() !== null){

            Records::create(array(
                'surname' => $request->input('surname'),
                'name'  => $request->input('name'),
                'number' => $request->input('number'),
                'name_agent' => Session::get('user')->name,
                'grade_agent' => $request->input('grade_agent'),
                'note' => $note
            ));

            $request->session()->flash('status', 'Task was successful!');
            return redirect()->route('records');
        }
        else
        {
            $request->session()->flash('status_error', 'error update');
            return redirect()->route('records');
        }
    }

    public function edit($id)
    {

        $view = (object)Records::find($id)->toArray();
        return view('record.edit', ['view' => $view]);
    }

    public function edit_post(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'number' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'credit' => 'required',
            'name_agent' => 'required',
            'grade_agent' => 'required'

        ]);

        $option = null;
        if ($request->input('note'))
            $option = $request->input('note');

        if ($request->all() !== null){

            Records::find($request->input('id'))->update(array(
                'number' => $request->input('number'),
                'name'  => $request->input('name'),
                'surname' => $request->input('surname'),
                'name_agent' => $request->input('name_agent'),
                'grade_agent' => $request->input('grade_agent'),
                'credit' => $request->input('credit'),
                'note' => $option
            ));


            $request->session()->flash('status', 'Task was successful!');
            return redirect()->route('records');
        }
        else
        {
            $request->session()->flash('status_error', 'error update');
            return redirect()->route('records');
        }
    }

    public function delete(Request $request)
    {
        if ($request->input('id') >= 1)
        {
            $response = Fine::where('user_id', $request->input('id'))->delete();
            $records = Records::find($request->input('id'))->delete();
            return response()->json($records);
        }
        else
        {
            $request->session()->flash('status_error', 'error delete');
            return redirect()->route('records');
        }
    }
}
