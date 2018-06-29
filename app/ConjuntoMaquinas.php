<?php

namespace Leanxcale;

use Leanxcale\Maquina;

class ConjuntoMaquinas{
    public $maquinas;
    public $num_maquinas;

    function __construct(){
        $this->num_maquinas = 0;
        $this->maquinas = array();
    }

    //Inserta una maquina en el array y devuelve el id del elemento en el array
    public function setMaquina($nom,$est,$tip){
        $maq = new Maquina();
        
        $maq->id = $this->num_maquinas;
        $maq->nombre = $nom;
        $maq->estado = $est;
        $maq->tipo = $tip;
        $maq->visibilidad = '1';
        $this->maquinas[$this->num_maquinas] = $maq;
        $this->num_maquinas++;

        return ($maq->id);
    }

    public function setMaquinaNombreById($id,$nom){
        if($id < $this->num_maquinas){
            $this->getMaquinaById($id)->nombre = $nom;
        }
    }

    public function setMaquinaEstadoById($id,$est){
        if($id < $this->num_maquinas){
            $this->getMaquinaById($id)->estado = $est;
        }
    }

    public function setMaquinaTipoById($id,$tip){
        if($id < $this->num_maquinas){
            $this->getMaquinaById($id)->tipo = $tip;
        }
    }

    public function setMaquinaVisibilidadById($id,$vis){
        if($id < $this->num_maquinas){
            $this->getMaquinaById($id)->visibilidad = $vis;
        }
    }

    //Devuelve un elemento del array por el id
    public function getMaquinaById($id){
        $m = new Maquina();

        if($id < $this->num_maquinas){
            $m = $this->maquinas[$id];
        }

        return $m;
    }

    //Devuelve el id de un elemento segun el nombre
    public function getIdByName($nombre){
        $maq_id = -1;
        for($i=0;$i<$this->num_maquinas;$i++){
            $maq=$this->getMaquinaById($i);
            if($maq->nombre == $nombre){
                $maq_id = $i;
            }
        }

        return $maq_id;
    }

    public function getMaquinaIdById($id){
        $maq = new Maquina();

        if($id < $this->num_maquinas){
            $maq = $this->getMaquinaById($id);
            $idmaq = $maq->id;
        }
        return $idmaq;
    }

    public function getMaquinaNombreById($id){
        $maq = new Maquina();
        $nombre = "";

        if($id < $this->num_maquinas){
            $maq = $this->getMaquinaById($id);
            $nombre = $maq->nombre;
        }
        return $nombre;
    }

    public function getMaquinaEstadoById($id){
        $maq = new Maquina();
        $estado = "";

        if($id < $this->num_maquinas){
            $maq = $this->getMaquinaById($id);
            $estado = $maq->estado;
        }
        return $estado;
    }

    public function getMaquinaTipoById($id){
        $maq = new Maquina();
        $tipo = "";

        if($id < $this->num_maquinas){
            $maq = $this->getMaquinaById($id);
            $tipo = $maq->tipo;
        }
        return $tipo;
    }

    public function getMaquinaVisibilidadById($id){
        $maq = new Maquina();

        if($id < $this->num_maquinas){
            $maq = $this->getMaquinaById($id);
            $vis = $maq->visibilidad;
        }
        return $vis;
    }

    public function getOrigenId($ori){
        $id = -1;
        foreach($this->maquinas as $maq){
            if($maq->nombre == $ori){
                $id = $maq->id+1;
            }
        }
        return $id;
    }

    //Devuelve el estado de una maquina segun los componentes: TRUE (todos los componentes OK) o FALSE (algun o todos los componentes ERROR)
    //$id: id de la maquina que se consulta estados $gc: variable con todos los componentes
    public function getEstadoComponentes($id,$gc){
        $res = "FALSE";
        $cont = 0;
        $contok = 0;

        $maq = $this->getMaquinaById($id);
        for($i=0;$i<$gc->num_componentes;$i++){
            $comp= new Componente;
            $comp=$gc->getComponenteById($i);
            if($comp->origen == $maq->nombre){
                if($comp->estado == "On"){
                    $contok++;
                }
                $cont++;
            }
        }
        if($cont>0 && $cont == $contok){
            $res = "TRUE";
        }

        return $res;
    }

    //Carga información del fichero de datos a la clase 
    public function iniciarConjunto(){
        $operacion = "FALSE";
        $cadenas = file('files/inventory',FILE_SKIP_EMPTY_LINES);
        if($cadenas != FALSE){
            //Cargamos informacion del fichero en el array de maquinas
            $lectura = "noread";

            foreach($cadenas as $cad){
                if($lectura == "noread"){
                    if(strpos($cad,"meta") != FALSE){
                        $lectura = "readmeta";
                    }
                }
                else{
                    if($lectura == "readdata"){
                        if(strpos($cad,"tpccclients") == FALSE){
                            $datamaq = explode(" ",$cad);
                            $nom = trim($datamaq[0]);
                            $this->setMaquina($nom,"Off","Datastores"); 
                        }
                        else{
                            $lectura = "noread";
                            $this->num_maquinas--;
                        }
                    }
                    if($lectura == "readmeta"){
                        if(strpos($cad,"datastores") == FALSE){
                            $metamaq = explode(" ",$cad);
                            $nom = trim($metamaq[0]);
                            $this->setMaquina($nom,"Off","Meta"); 
                        }
                        else{
                            $lectura = "readdata";
                            $this->num_maquinas--;
                        }   
                    }
                }
            }
            $operacion = "TRUE";
        }
        return $operacion;
    }
}