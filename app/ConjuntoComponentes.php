<?php

namespace Leanxcale;

use Leanxcale\Componente;

class ConjuntoComponentes{
    public $componentes;
    public $num_componentes;

    function __construct(){
        $this->num_componentes = 0;
        $this->componentes = array();
    }

    //Inserta una maquina en el array y devuelve el id del elemento en el array
    public function setComponente($nom,$est,$ori){
        $com = new Componente();
        
        $com->id = $this->num_componentes;
        $com->nombre = $nom;
        $com->estado = $est;
        $com->origen = $ori;
        $com->visibilidad = '1';
        $this->componentes[$this->num_componentes] = $com;
        $this->num_componentes++;

        return ($com->id);
    }

    //Devuelve un elemento del array por el id
    public function getComponenteById($id){
        $c = new Componente();

        if($id < $this->num_componentes){
            $c = $this->componentes[$id];
        }

        return $c;
    }

    //Devuelve el id de un elemento segun el nombre
    public function getIdByName($nombre){
        $com_id = -1;
        foreach($this->componentes as $com){
            if($com->nombre == $nombre){
                $com_id = $com->id;
            }
        }

        return $com_id;
    }

    public function getComponenteIdById($id){
        $com = new Componente();

        if($id < $this->num_componentes){
            $com = $this->getComponenteById($id);
            $idcom = $com->id;
        }
        return $idcom;
    }

    public function getComponenteNombreById($id){
        $com = new Componente();
        $nombre = "";

        if($id < $this->num_componentes){
            $com = $this->getComponenteById($id);
            $nombre = $com->nombre;
        }
        return $nombre;
    }

    public function getComponenteEstadoById($id){
        $com = new Componente();
        $estado = "";

        if($id < $this->num_componentes){
            $com = $this->getComponenteById($id);
            $estado = $com->estado;
        }
        return $estado;
    }

    public function getComponenteOrigenById($id){
        $com = new Componente();
        $origen = "";

        if($id < $this->num_componentes){
            $com = $this->getComponenteById($id);
            $origen = $com->origen;
        }
        return $origen;
    }

    public function getMaquinaVisibilidadById($id){
        $com = new Componente();

        if($id < $this->num_componentes){
            $com = $this->getComponenteById($id);
            $vis = $com->visibilidad;
        }
        return $vis;
    }

    //Carga información del fichero de datos a la clase 
    //$gm es grupo_maquinas, debe introducirse como parámetro de entrada y estar previamente inicializado
    public function iniciarConjunto(&$gm){
        $operacion = "FALSE";
        $cadenas = file('files\checkcluster.out',FILE_SKIP_EMPTY_LINES);

        if($cadenas != FALSE){
            $lectura = "noread";
            $contador = 0;

            foreach($cadenas as $cad){
                //LINEAS IGNORADAS
                if($lectura == "noread"){
                    if(strpos($cad,"debug") != FALSE){
                        $lectura = "readstatemachine";//Al encontrar 'debug' pasamos a 1º SECCION
                    }
                }
                else{
                    //2º SECCION: LECTURA DE COMPONENTES DE CADA MAQUINA Y SU ESTADO
                    if($lectura == "readcomponents"){
                        if(strpos($cad,"debug") == FALSE){
                            //INICIO DE CADA MAQUINA
                            if(strpos($cad,"k:") == TRUE){
                                $datamaq = explode(" ",$cad);
                                $datamaq[1] = str_replace("[","",$datamaq[1]);
                                $nommaq = str_replace("]","",$datamaq[1]);
                                //Buscar maquina en grupo_maquinas
                                $num=$gm->getIdByName($nommaq);
                                if($num != -1){
                                    //LEER COMPONENTES + ESTADO (COMPROBAR SI LA MAQUINA ESTA ON)
                                    if($gm->getMaquinaEstadoById($num) == 'On'){
                                        $lectura_componentes = TRUE;
                                    }
                                }  
                            }
                            else{
                                if($lectura_componentes && strpos($cad,"stdout_lines") == FALSE){
                                    //LECTURA DE COMPONENTES ($nommaq tiene almacenado el nombre de la maquina a la que pertenecen los comp.)
                                    if(strpos($cad,"DOWN") == FALSE){
                                        //$datacom = explode(" ",$cad);
                                        $cad = trim($cad);
                                        $datacom = explode(" ", $cad);
                                        $nom = $datacom[6];
                                        $est = str_replace('"','',$datacom[7]);
                                        if($est == "OK,"){
                                            $this->setComponente($nom,"On",$nommaq);
                                        }
                                        else{
                                            $this->setComponente($nom,"Off",$nommaq);
                                        }
                                    }
                                    //FIN DE LECTURA DE COMPONENTES DE UNA MAQUINA
                                    else{
                                        $lectura_componentes = FALSE;
                                    }
                                }
                            }
                        }
                        //FIN DE LECTURA DEL ARCHIVO (Al encontrar el 3º debug)
                        else{
                            $lectura = "noread";
                        }
                    }
                    //1º SECCION: LECTURA DE ESTADO DE LAS MAQUINAS
                    if($lectura == "readstatemachine"){
                        //Lectura del estado
                        if(strpos($cad,"debug") == FALSE){
                            //Linea de interés
                            if($contador == 0){
                                //Estado maquina OK
                                if(strpos($cad,"k:") == TRUE){
                                    //Obtener nombre de la maquina del fichero
                                    $datamaq = explode(" ",$cad);
                                    $datamaq[1] = str_replace("[","",$datamaq[1]);
                                    $nom = str_replace("]","",$datamaq[1]);
                                    //Buscar maquina en grupo_maquinas
                                    $num=$gm->getIdByName($nom);
                                    //Si encuentra la máquina la pone a ON
                                    if($num != -1){
                                        $gm->setMaquinaEstadoById($num,"On");
                                    }
                                }
                                else{
                                    //Estado maquina ERROR, no hace nada pues el estado es Off por defecto
                                }
                            }
                            $contador++;
                            if($contador == 3){$contador=0;}
                        }
                        //Al encontrar 'debug' pasamos a 2º SECCION
                        else{
                            $lectura = "readcomponents";
                            $lectura_componentes = FALSE;
                        }
                    }
                }
            }
            $operacion = "TRUE"; // Se encontró el archivo de lectura
        }
        return $operacion;
    }
}