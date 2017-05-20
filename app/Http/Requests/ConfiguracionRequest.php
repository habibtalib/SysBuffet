<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfiguracionRequest extends FormRequest
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
            'nombre' => 'string|required',
            'items_paginados' => 'numeric|required',
            'descripcion' => 'string|required',
            'mail_contacto' => 'string|required|email',
            'mensaje_deshabilitacion' => 'string|required',
            'sitio_habilitado' => 'required'
        ];
    }
}
