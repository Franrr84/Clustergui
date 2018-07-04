<?php

namespace Leanxcale\Http\Controllers;

use Illuminate\Http\Request;

use Leanxcale\Maquina;
use Leanxcale\Componente;
use Leanxcale\ConjuntoMaquinas;
use Leanxcale\ConjuntoComponentes;
use Illuminate\Support\Facades\Redirect;
use Leanxcale\Http\Requests\MaquinaFormRequest;
use DB;

/*
	$request: variable que contiene parámetros de entrada (index: searchText, store: datos formulario, update: datos formulario)
	$id: identificador para seleccionar un elemento de la tabla existente (edit/update, show, destroy)
*/


class MaquinaController extends Controller
{
    //ATRIBUTOS
    public $grupo_maquinas;
    public $grupo_componentes;

    //Constructor
    public function __construct(){
        $this->grupo_maquinas = new ConjuntoMaquinas();
        $this->grupo_componentes = new ConjuntoComponentes();
    }

    //Función que se ejecuta por defecto en la ruta de recurso - La funcion index está preparada para recibir un parámetro
    public function gridview(Request $request){
        if ($request){
            //1º FASE - Inicializar variables $grupo_maquinas y $grupo_componentes
            $operacion = $this->grupo_maquinas->iniciarConjunto();
            if($operacion == "FALSE"){
                $operacion = "ERRORINVENTORY";
                $maquina = NULL;
                $query = NULL;
                $componentes = NULL;
                $maquinas = NULL;
            }
            else{
                $operacion = $this->grupo_componentes->iniciarConjunto($this->grupo_maquinas);
                if($operacion == "FALSE"){
                    $operacion = "ERRORCHECKCLUSTER";
                    $maquina = NULL;
                    $query = NULL;
                    $componentes = NULL;
                    $maquinas = NULL;
                }
                else{
                    //2º FASE - Almacenamos la información en la base de datos
                    Maquina::truncate();
                    for($i=0;$i<$this->grupo_maquinas->num_maquinas;$i++){
                        $maq = new Maquina;
                        $maq->nombre = $this->grupo_maquinas->getMaquinaNombreById($i);
                        $maq->tipo = $this->grupo_maquinas->getMaquinaTipoById($i);
                        $maq->estado = $this->grupo_maquinas->getMaquinaEstadoById($i);
                        $maq->visibilidad='1';
                        $maq->save();
                    }
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
                    $maquina=DB::table('maquinas')->where('nombre','LIKE','%'.$query.'%')
                    ->orWhere('tipo','LIKE','%'.$query.'%')
                    ->orWhere('estado','LIKE','%'.$query.'%')
                    ->where('visibilidad','=','1')
                    ->orderBy('id','asc')
                    ->paginate(10);
                    $componentes = $this->grupo_componentes;
                    $maquinas = $this->grupo_maquinas;

                    $operacion = "OK";
                }
            }
            return view('maquinas.grid',["maquina"=>$maquina,"operacion"=>$operacion,"searchText"=>$query,"componentes"=>$componentes,"maquinas"=>$maquinas]);  
        }
    }

    //Función que se ejecuta por defecto en la ruta de recurso - La funcion index está preparada para recibir un parámetro
    public function listview(Request $request){
        if ($request){
            //1º FASE - Inicializar variables $grupo_maquinas y $grupo_componentes
            $operacion = $this->grupo_maquinas->iniciarConjunto();
            if($operacion == "FALSE"){
                $operacion = "ERRORINVENTORY";
                $maquina = NULL;
                $query = NULL;
            }
            else{
                $operacion = $this->grupo_componentes->iniciarConjunto($this->grupo_maquinas);
                if($operacion == "FALSE"){
                    $operacion = "ERRORCHECKCLUSTER";
                    $maquina = NULL;
                    $query = NULL;
                }
                else{
                    //2º FASE - Almacenamos la información en la base de datos
                    Maquina::truncate();
                    for($i=0;$i<$this->grupo_maquinas->num_maquinas;$i++){
                        $maq = new Maquina;
                        $maq->nombre = $this->grupo_maquinas->getMaquinaNombreById($i);
                        $maq->tipo = $this->grupo_maquinas->getMaquinaTipoById($i);
                        $maq->estado = $this->grupo_maquinas->getMaquinaEstadoById($i);
                        $maq->visibilidad='1';
                        $maq->save();
                    }
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
                    $maquina=DB::table('maquinas')->where('nombre','LIKE','%'.$query.'%')
                    ->orWhere('tipo','LIKE','%'.$query.'%')
                    ->orWhere('estado','LIKE','%'.$query.'%')
                    ->where('visibilidad','=','1')
                    ->orderBy('id','asc')
                    ->paginate(12);

                    $operacion = "OK";
                }
            }
            return view('maquinas.list',["maquina"=>$maquina,"operacion"=>$operacion,"searchText"=>$query]);  
        }
    }

    public function itemgridview($id){
        $operacion = $this->grupo_maquinas->iniciarConjunto();
        if($operacion == "FALSE"){
            $operacion = "ERRORINVENTORY";
            $maquina = NULL;
            $componentes = NULL;
        }
        else{
            $operacion = $this->grupo_componentes->iniciarConjunto($this->grupo_maquinas);
            if($operacion == "FALSE"){
                $operacion = "ERRORCHECKCLUSTER"; 
                $maquina = NULL;
                $componentes = NULL;
            }
            else{
                Maquina::truncate();
                for($i=0;$i<$this->grupo_maquinas->num_maquinas;$i++){
                    $maq = new Maquina;
                    $maq->nombre = $this->grupo_maquinas->getMaquinaNombreById($i);
                    $maq->tipo = $this->grupo_maquinas->getMaquinaTipoById($i);
                    $maq->estado = $this->grupo_maquinas->getMaquinaEstadoById($i);
                    $maq->visibilidad='1';
                    $maq->save();
                }
                Componente::truncate();
                for($i=0;$i<$this->grupo_componentes->num_componentes;$i++){
                    $comp = new Componente;
                    $comp->nombre = $this->grupo_componentes->getComponenteNombreById($i);
                    $comp->origen = $this->grupo_componentes->getComponenteOrigenById($i);
                    $comp->estado = $this->grupo_componentes->getComponenteEstadoById($i);
                    $comp->visibilidad='1';
                    $comp->save();
                }
                $maquina=Maquina::findOrFail($id);
                $componentes=DB::table('componentes')->orWhere('origen','LIKE','%'.$maquina->nombre.'%')
                    ->where('visibilidad','=','1')
                    ->orderBy('id','asc')
                    ->paginate(10);
            }
        }
        
        return view('maquinas.itemgrid',["maquina"=>$maquina,"componentes"=>$componentes]);  
    }

    public function itemlistview($id){
        $operacion = $this->grupo_maquinas->iniciarConjunto();
        if($operacion == "FALSE"){
            $operacion = "ERRORINVENTORY";
            $maquina = NULL;
            $componentes = NULL;
        }
        else{
            $operacion = $this->grupo_componentes->iniciarConjunto($this->grupo_maquinas);
            if($operacion == "FALSE"){
                $operacion = "ERRORCHECKCLUSTER";
                $maquina = NULL;
                $componentes = NULL;
            }
            else{
                Maquina::truncate();
                for($i=0;$i<$this->grupo_maquinas->num_maquinas;$i++){
                    $maq = new Maquina;
                    $maq->nombre = $this->grupo_maquinas->getMaquinaNombreById($i);
                    $maq->tipo = $this->grupo_maquinas->getMaquinaTipoById($i);
                    $maq->estado = $this->grupo_maquinas->getMaquinaEstadoById($i);
                    $maq->visibilidad='1';
                    $maq->save();
                }
                Componente::truncate();
                for($i=0;$i<$this->grupo_componentes->num_componentes;$i++){
                    $comp = new Componente;
                    $comp->nombre = $this->grupo_componentes->getComponenteNombreById($i);
                    $comp->origen = $this->grupo_componentes->getComponenteOrigenById($i);
                    $comp->estado = $this->grupo_componentes->getComponenteEstadoById($i);
                    $comp->visibilidad='1';
                    $comp->save();
                }
                $maquina=Maquina::findOrFail($id);
                $componentes=DB::table('componentes')->orWhere('origen','LIKE','%'.$maquina->nombre.'%')
                    ->where('visibilidad','=','1')
                    ->orderBy('id','asc')
                    ->paginate(12);
            }
        }
        
        return view('maquinas.itemlist',["maquina"=>$maquina,"componentes"=>$componentes]);  
    }    
}
