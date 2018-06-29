<?php

namespace Leanxcale\Http\Controllers;

use Illuminate\Http\Request;

use Leanxcale\Prueba;
use Illuminate\Support\Facades\Redirect;
use Leanxcale\Http\Requests\PruebaFormRequest;
use DB;

/*
	$request: variable que contiene parámetros de entrada (index: searchText, store: datos formulario, update: datos formulario)
	$id: identificador para seleccionar un elemento de la tabla existente (edit/update, show, destroy)
*/


class PruebaController extends Controller
{
    //Constructor
    public function __construct(){

    }

    //borrar
    public function inicio(){
    	return "Inicio";
    }

    //Función que se ejecuta por defecto en la ruta de recurso - La funcion index está preparada para recibir un parámetro
    public function index(Request $request){
    	if ($request){
    		//Si se searchText tiene algun valor, se usará en la consulta siguiente para filtrar los resultados, si no se cargarán todos los datos de la tabla
    		$query=trim($request->get('searchText'));

    		//Carga los registros de la tabla prueba en $prueba
    		$prueba=DB::table('prueba')->where('nombre','LIKE','%'.$query.'%')
    		->where('condicion','=','1')
    		->orderBy('id','asc')
    		->paginate(10);
    		
    		//Redirecciona a la Vista index con parametros $prueba y $query 
    		return view('almacen.prueba.index',["prueba"=>$prueba, "searchText"=>$query]);
    	}
    }

    public function create(){
    	//redirección a la vista con el formulario para crear un nuevo registro en la tabla
    	return view("almacen.prueba.create");
    }

    //STORE: se le pasa por parametros una variable request con los valores que se van a introducir en la base de datos (tabla prueba)
    public function store(PruebaFormRequest $request){
    	//Variable modelo
    	$prueba = new Prueba;
    	//Asignamos valores de request para almacenar
    	$prueba->nombre=$request->get('nombre');
    	$prueba->campo1=$request->get('campo1');
    	$prueba->campo2=$request->get('campo2');
    	$prueba->campo3=$request->get('campo3');
    	//Condicion de inicio valdrá 1 para que la fila de la tabla sea visible para la aplicación
    	$prueba->condicion='1';
    	//Almacenar en la BD
    	$prueba->save();

    	//Redirección
    	return Redirect::to('almacen/prueba');
    }

    public function show($id){
    	return view("almacen.prueba.show",["prueba"=>Prueba::findOrFail($id)]);
    }

    public function edit($id){
    	//redirección a la vista con el formulario para la edición de valores
    	return view("almacen.prueba.edit",["prueba"=>Prueba::findOrFail($id)]);
    }

    public function update(PruebaFormRequest $request,$id){
    	//buscamos en la tabla el registro
    	$prueba=Prueba::findOrFail($id);
    	//lo modificamos con los nuevos valores
    	$prueba->nombre=$request->get('nombre');
    	$prueba->campo1=$request->get('campo1');
    	$prueba->campo2=$request->get('campo2');
    	$prueba->campo3=$request->get('campo3');
    	//actualizamos en la BD
    	$prueba->update();

    	//Redirección
    	return Redirect::to('almacen/prueba');
    }
    
    public function destroy($id){
    	$prueba=Prueba::findOrFail($id);
    	$prueba->condicion='0';
    	$prueba->update();

    	//Redirección
    	return Redirect::to('almacen/prueba');
    }
    
}
