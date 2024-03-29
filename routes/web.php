<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::get('', function () {
    return view('welcome');
})->name('home');

Route::get('logout', function (){
    Session::flush();
    return redirect()->route('home');
})->name('logout');

Route::middleware(['Kronthto\LaravelOAuth2Login\CheckOAuth2', 'CheckGrade'])->prefix('manager')->group(function () {
    Route::get('/', 'ControllerManager@index')->name('manager');


    Route::prefix('records')->group(function (){
        Route::get('/', 'ControllerRecords@index')->name('records');
        Route::get('/view/{id}', 'ControllerRecords@view')->name('records_view');
        Route::post('/create', 'ControllerRecords@create')->name('records_create_post');
        Route::get('/edit/{id}', 'ControllerRecords@edit')->name('records_edit');
        Route::post('/edit', 'ControllerRecords@edit_post')->name('records_edit_post');
        Route::post('/delete', 'ControllerRecords@delete')->name('records_delete');

    });

    Route::prefix('fines')->group(function (){
        Route::get('/{id}', 'ControllerFines@index')->name('fines');
        Route::post('/', 'ControllerFines@create')->name('fines_create');
        Route::get('/edit/{id}', 'ControllerFines@edit')->name('fines_edit');
        Route::post('/edit', 'ControllerFines@edit_post')->name('fines_edit_post');
        Route::post('/delete', 'ControllerFines@delete')->name('fines_delete');

    });

    Route::prefix('fine_scales')->group(function (){
        Route::get('/', 'ControllerFineScales@index')->name('fine_scales');
        Route::post('/', 'ControllerFineScales@create')->name('fine_scales_create');
        Route::get('/view/{id}', 'ControllerFineScales@view')->name('fine_scales_view');
        Route::get('/edit/{id}', 'ControllerFineScales@edit')->name('fine_scales_edit');
        Route::post('/edit', 'ControllerFineScales@edit_post')->name('fine_scales_edit_post');
        Route::post('/delete', 'ControllerFineScales@delete')->name('fine_scales_delete');

    });


    Route::prefix('radio')->group(function (){
        Route::get('/', 'ControllerRadio@index')->name('radio');
        Route::post('/edit', 'ControllerRadio@post')->name('radio_post');
        Route::get('/reload', 'ControllerRadio@reload')->name('radio_reload');
        Route::get('/reload_api', 'ControllerRadio@reload_api')->name('radio_reload_api');
    });

});
