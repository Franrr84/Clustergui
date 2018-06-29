<?php

namespace Leanxcale;

use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    //Creamos variable que referencia a nuestra tabla de prueba
    protected $table='componentes';
    //Creamos varible que referencia a la clave primaria de la tabla prueba
    protected $primaryKey="id";
    //Especificamos que no necesitamos columnas adicionales de tiempo/fecha de creación de los registros
    public $timestamps=false;
    //Definir campos que serán almacenados en la base de datos
    protected $fillable =[
    		'nombre',
    		'estado',
            'origen',
    		'visibilidad'
    ];
    //Definir campos que no serán almacenados en la base de datos
    protected $guarded =[

    ];
}