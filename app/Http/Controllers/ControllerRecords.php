<?php

namespace App\Http\Controllers;

use App\Records;
use Illuminate\Http\Request;
use App\DataTables\RecordsDataTable;

//casier judiciaire
class ControllerRecords extends Controller
{

    public function index(RecordsDataTable $dataTable)
    {
        return $dataTable->render('record.home');
    }
    public function search()
    {

    }

    public function create()
    {
        return view('record.create');
    }

    public function record()
    {

    }

    public function delete(Request $request)
    {
        if ($request->input('id') >= 1)
        {
            $response = DB::table('records')->where('id', $request->input('id'))->delete();
            return json_encode($response);
        }
        else
        {
            $request->session()->flash('status_error', 'error delete');
            return redirect()->route('records');
        }
    }
}
