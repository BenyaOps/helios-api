<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(array('prefix' => 'departments'), function () {
    Route::get('/', ["as" => "index_departments", "uses" => "DepartmentsController@index"]);
    Route::get('list', ["as" => "list_departments", "uses" => "DepartmentsController@list"]);
});
