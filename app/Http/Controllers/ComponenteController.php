<?php

namespace Leanxcale\Http\Controllers;

use Illuminate\Http\Request;

use Leanxcale\Componente;
use Leanxcale\ConjuntoComponentes;
use Leanxcale\ConjuntoMaquinas;
use Illuminate\Support\Facades\Redirect;
use Leanxcale\Http\Requests\ComponenteFormRequest;
use DB;

/*
	$request: variable que contiene parámetros de entrada (index: searchText, store: datos formulario, update: datos formulario)
	$id: identificador para seleccionar un elemento de la tabla existente (edit/update, show, destroy)
*/


class ComponenteController extends Controller
{
    //ATRIBUTOS
    public $grupo_componentes;
    public $grupo_maquinas;

    //Constructor
    public function __construct(){
        $this->grupo_componentes = new ConjuntoComponentes();
        $this->grupo_maquinas = new ConjuntoMaquinas();
    }

    //Función que se ejecuta por defecto en la ruta de recurso - La funcion index está preparada para recibir un parámetro
    public function gridview(Request $request){
        if ($request){
            //1º FASE - Inicializar variables $grupo_maquinas y $grupo_componentes
            $operacion = $this->grupo_maquinas->iniciarConjunto();
            if($operacion == "FALSE"){
                $operacion = "ERRORINVENTORY";
                $componente = NULL;
                $query = NULL;
                $maquinas = NULL;
            }
            else{
                $operacion = $this->grupo_componentes->iniciarConjunto($this->grupo_maquinas);
                if($operacion == "FALSE"){
                    $operacion = "ERRORCHECKCLUSTER";
                    $componente = NULL;
                    $query = NULL;
                    $maquinas = NULL;
                }
                else{
                    //2º FASE - Almacenamos la información en la base de datos
                    Componente::truncate();
                    for($i=0;$i<$this->grupo_componentes->num_componentes;$i++){
                        $comp = new Componente;
                        $comp->nombre = $this->grupo_componentes->getComponenteNombreById($i);
                        $comp->origen = $this->grupo_componentes->getComponenteOrigenById($i);
                        $comp->estado = $this->grupo_componentes->getComponenteEstadoById($i);
                        $comp->visibilidad='1';
                        $comp->save();
                    }
                    //3º FASE - Creamos una consulta para mostrarla en la vista
                    
                    //Si se searchText tiene algun valor, se usará en la consulta siguiente para filtrar los resultados
                    $query=trim($request->get('searchText'));
                    //Carga los registros de la tabla prueba en $componente
                    $componente=DB::table('componentes')->where('nombre','LIKE','%'.$query.'%')
                    ->orWhere('origen','LIKE','%'.$query.'%')
                    ->orWhere('estado','LIKE','%'.$query.'%')
                    ->where('visibilidad','=','1')
                    ->orderBy('id','asc')
                    ->paginate(8);
                    $maquinas = $this->grupo_maquinas;

                    $operacion = "OK";
                }
            }

            return view('componentes.grid',["componente"=>$componente,"operacion"=>$operacion,"searchText"=>$query,"maquinas"=>$maquinas]);    
        }
    }
    //Función que se ejecuta por defecto en la ruta de recurso - La funcion index está preparada para recibir un parámetro
    public function listview(Request $request){
        if ($request){
            //1º FASE - Inicializar variables $grupo_maquinas y $grupo_componentes
            $operacion = $this->grupo_maquinas->iniciarConjunto();
            if($operacion == "FALSE"){
                $operacion = "ERRORINVENTORY";
                $componente = NULL;
                $query = NULL;
                $maquinas = NULL;
            }
            else{
                $operacion = $this->grupo_componentes->iniciarConjunto($this->grupo_maquinas);
                if($operacion == "FALSE"){
                    $operacion = "ERRORCHECKCLUSTER";
                    $componente = NULL;
                    $query = NULL;
                    $maquinas = NULL;
                }
                else{
                    //2º FASE - Almacenamos la información en la base de datos
                    Componente::truncate();
                    for($i=0;$i<$this->grupo_componentes->num_componentes;$i++){
                        $comp = new Componente;
                        $comp->nombre = $this->grupo_componentes->getComponenteNombreById($i);
                        $comp->origen = $this->grupo_componentes->getComponenteOrigenById($i);
                        $comp->estado = $this->grupo_componentes->getComponenteEstadoById($i);
                        $comp->visibilidad='1';
                        $comp->save();
                    }
                    //3º FASE - Creamos una consulta para mostrarla en la vista
                    
                    //Si se searchText tiene algun valor, se usará en la consulta siguiente para filtrar los resultados
                    $query=trim($request->get('searchText'));
                    //Carga los registros de la tabla prueba en $componente
                    $componente=DB::table('componentes')->where('nombre','LIKE','%'.$query.'%')
                    ->orWhere('origen','LIKE','%'.$query.'%')
                    ->orWhere('estado','LIKE','%'.$query.'%')
                    ->where('visibilidad','=','1')
                    ->orderBy('id','asc')
                    ->paginate(12);
                    $maquinas = $this->grupo_maquinas;

                    $operacion = "OK";
                }
            }

            return view('componentes.list',["componente"=>$componente,"operacion"=>$operacion,"searchText"=>$query,"maquinas"=>$maquinas]);    
        }
    } 

    //Función que se ejecuta al querer encender un componente desde la vista cuadricula de componentes
    public function componentegridturnon($id){
        $operacion = $this->grupo_maquinas->iniciarConjunto();
        if($operacion != "FALSE"){
            $operacion = $this->grupo_componentes->iniciarConjunto($this->grupo_maquinas);
            if($operacion != "FALSE"){
                $id = $id-1;
                if($id < $this->grupo_componentes->num_componentes){
                    $comp = $this->grupo_componentes->getComponenteById($id);
                    if($comp->estado == "Off"){
                        //CREAR ARCHIVO DE SALIDA (BORRAR)
                        $salida = $comp->origen . "_" . $comp->nombre . ".log";
                        exec("sudo touch" . $salida);
                        
                        //EJECUTAR SCRIPT (MODIFICAR)
                        $comando = "sudo sh /var/www/Clustergui/public/files/encender.sh";
                        exec($comando . ">files/" . $salida);
                    }
                }
            }
        }

        return redirect()->action('ComponenteController@gridview');
    }

    //Función que se ejecuta al querer apagar un componente desde la vista cuadricula de componentes
    public function componentegridturnoff($id){
        $operacion = $this->grupo_maquinas->iniciarConjunto();
        if($operacion != "FALSE"){
            $operacion = $this->grupo_componentes->iniciarConjunto($this->grupo_maquinas);
            if($operacion != "FALSE"){
                $id = $id-1;
                if($id < $this->grupo_componentes->num_componentes){
                    $comp = $this->grupo_componentes->getComponenteById($id);
                    if($comp->estado == "On"){
                        //EJECUTAR SCRIPT
                        //CREAR ARCHIVO DE SALIDA (BORRAR)
                        $salida = $comp->origen . "_" . $comp->nombre . ".log";
                        exec("sudo touch" . $salida);
                        
                        //EJECUTAR SCRIPT (MODIFICAR)
                        $comando = "sudo sh /var/www/Clustergui/public/files/apagar.sh";
                        exec($comando . ">files/" . $salida);
                    }
                }
            }
        }

        return redirect()->action('ComponenteController@gridview');
    }

    //Función que se ejecuta al querer encender un componente desde la vista listado de componentes
    public function componentelistturnon($id){
        $operacion = $this->grupo_maquinas->iniciarConjunto();
        if($operacion != "FALSE"){
            $operacion = $this->grupo_componentes->iniciarConjunto($this->grupo_maquinas);
            if($operacion != "FALSE"){
                $id = $id-1;
                if($id < $this->grupo_componentes->num_componentes){
                    $comp = $this->grupo_componentes->getComponenteById($id);
                    if($comp->estado == "Off"){
                        //EJECUTAR SCRIPT
                        //CREAR ARCHIVO DE SALIDA (BORRAR)
                        $salida = $comp->origen . "_" . $comp->nombre . ".log";
                        exec("sudo touch" . $salida);
                        
                        //EJECUTAR SCRIPT (MODIFICAR)
                        $comando = "sudo sh /var/www/Clustergui/public/files/encender.sh";
                        exec($comando . ">files/" . $salida);
                    }
                }
            }
        }

        return redirect()->action('ComponenteController@listview');
    }

    //Función que se ejecuta al querer apagar un componente desde la vista listado de componentes
    public function componentelistturnoff($id){
        $operacion = $this->grupo_maquinas->iniciarConjunto();
        if($operacion != "FALSE"){
            $operacion = $this->grupo_componentes->iniciarConjunto($this->grupo_maquinas);
            if($operacion != "FALSE"){
                $id = $id-1;
                if($id < $this->grupo_componentes->num_componentes){
                    $comp = $this->grupo_componentes->getComponenteById($id);
                    if($comp->estado == "On"){
                        //EJECUTAR SCRIPT
                        //CREAR ARCHIVO DE SALIDA (BORRAR)
                        $salida = $comp->origen . "_" . $comp->nombre . ".log";
                        exec("sudo touch" . $salida);
                        
                        //EJECUTAR SCRIPT (MODIFICAR)
                        $comando = "sudo sh /var/www/Clustergui/public/files/apagar.sh";
                        exec($comando . ">files/" . $salida);
                    }
                }
            }
        }

        return redirect()->action('ComponenteController@listview');
    }
}
