<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioEditRequest extends FormRequest
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
          'nombre' => 'string|required|max:45',
          'apellido' => 'string|required|max:45',
          'usuario' => 'string|required|max:45|unique:usuarios,usuario',
          'documento' => 'numeric|required',
          'email' => 'string|required|max:255|email',
          'telefono' => 'numeric|required',
          'departamento' => 'string|required|max:45',
          'ubicacion_id' =>  'numeric|required',
          'rol_id' =>  'numeric|required'
        ];
    }
}