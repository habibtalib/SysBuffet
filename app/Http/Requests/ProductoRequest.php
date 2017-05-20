<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
          'nombre' => 'string|required| max:255',
          'marca' => 'string|required',
          'proveedor' => 'string|required',
          'descripcion' => 'string|required',
          'stock' => 'numeric|required',
          'stock_minimo' => 'numeric|required',
          'precio_venta_unitario' => 'numeric|required',
          'codigo_barras' => 'numeric|required',
          'categoria_id' =>  'numeric|required'
        ];
    }
}
