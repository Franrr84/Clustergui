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

//Ruta inicial de la aplicación y se asocia a la funcion que realiza el return a la vista
Route::get('/', function () {
    return view('layouts/index');
});

Route::resource('maquinas','MaquinaController');
Route::resource('componentes','ComponenteController');
Route::get('maquina/grid','MaquinaController@gridview');
Route::get('maquina/list','MaquinaController@listview');
Route::get('componente/grid','ComponenteController@gridview');
Route::get('componente/list','ComponenteController@listview');
Route::get('maquina/itemgrid/{id}','MaquinaController@itemgridview');
Route::get('maquina/itemlist/{id}','MaquinaController@itemlistview');
Route::get('maquina/itemturnon/{id}','MaquinaController@itemgridturnon');
Route::get('maquina/itemturnoff/{id}','MaquinaController@itemgridturnoff');

