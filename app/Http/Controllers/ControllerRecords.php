<?php

namespace App\Http\Controllers;

use App\Fine;
use App\FineScale;
use App\Records;
use Illuminate\Http\Request;
use App\DataTables\RecordsDataTable;
use Illuminate\Support\Facades\Session;

//casier judiciaire
class ControllerRecords extends Controller
{

    public function index(RecordsDataTable $dataTable)
    {
        return $dataTable->render('record.home');
    }

    public function create()
    {
        return view('record.create');
    }

    public function view($id)
    {

        $view = Records::find($id)->toArray();
        $views = Fine::where('user_id', $id)->get()->toArray();
        dd($view, $views);
        return view('fine_scale.view', ['view' => $view]);
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
