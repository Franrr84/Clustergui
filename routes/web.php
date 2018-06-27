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

//EJEMPLOS (borrar todo lo de abajo)

//Rutas de tipo resource, grupo de rutas de recursos 
//con peticiones: index, sow, edit, store, etc.
Route::resource('almacen/prueba','PruebaController');


//ruta de ejemplo: http://localhost:8000/prueba/4/pepe
/*Route::get('/prueba/{parametro1}/{parametro2}',function($parametro1, $parametro2){
	return "Parametro1: " . $parametro1 . " Parametro2: " . $parametro2;
})->where('parametro1','[a-zA-Z]+');*/

//Ejemplo de ruta asociada a un controlador y método de controlador
Route::get('/inicio','PruebaController@inicio');


