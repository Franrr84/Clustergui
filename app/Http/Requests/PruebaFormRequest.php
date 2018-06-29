<?php

namespace Leanxcale\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PruebaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //Aquí especificamos reglas para los datos que introduzcamos por un formulario para almacenar en BBDD
            //required: significa obligatorio y max se refiere a la longitud
            'campo1' => 'required|max:4',
            'campo2' => 'required|max:4',
            'campo3' => 'required|max:4',
            'nombre' => 'required|max:50'
        ];
    }
}
