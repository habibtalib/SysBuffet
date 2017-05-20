<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Producto;

class VentasRequest extends FormRequest
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
      $producto = Producto::find($this->input('producto_id'));
      $cantMaxima = $producto->stock;
      return [
        'producto_id' => 'required|numeric',
        'cantidad' => 'required|numeric|max:'.$cantMaxima,
        'descripcion' => 'string|max:255',
      ];
    }
}
