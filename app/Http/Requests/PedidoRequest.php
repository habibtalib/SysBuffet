<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\ComprasController;
use App\Models\Producto;
use Auth;

class PedidoRequest extends FormRequest
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
     * La validación del stock se realiza en el constructor porque Laravel no provee un mecanismo para asociar
     * como parámetro de una regla el valor de otro atributo en la misma posición del arreglo en la que se
     * encuentra el atributo que se está validando.
     */
    public function __construct(\Illuminate\Http\Request $request)
    {
      $carrito = json_decode($request['carrito']);
      $request['carrito'] = ComprasController::format($carrito); //Facilita validaciones y manejo
      if (! Producto::validarStock($request['carrito'])) $request['validadoStock'] = 1;
      $request['usuario_id'] = Auth::id(); // Se añade campo al request para validar que el usuario tenga departamento
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'carrito' => 'required|array|min:1',
            'carrito.*.cantidad' => 'required|numeric|min:1',
            'carrito.*.producto_id' =>'required|numeric',
            'validadoStock' => 'required',
            'usuario_id' => 'tieneDepartamento'
        ];
    }
}
