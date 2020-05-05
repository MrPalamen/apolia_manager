@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
@endsection

@section('content')
    <form method="post" id="insert_form">
        <div class="table-repsonsive">
            <span id="error"></span>
            <table class="table table-bordered" id="item_table">
                <thead>
                <tr>
                    <th>Enter Item Name</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th><button type="button" name="add" class="btn btn-success btn-xs add"><span class="glyphicon glyphicon-plus"></span></button></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
            <div align="center">
                <input type="submit" name="submit" class="btn btn-info" value="Insert" />
            </div>
        </div>
    </form>
@endsection
