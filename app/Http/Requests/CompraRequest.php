<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\ComprasController;

class CompraRequest extends FormRequest
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
     * Antes de enviar las reglas debe convertir el objeto a un arreglo.
     */
    public function __construct(\Illuminate\Http\Request $request)
    {
      $carrito = json_decode($request['carrito']);
      $request['carrito'] = ComprasController::format($carrito); //para facilitar manejo y validaciones se convierte a un array
    }

    /**

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {  
        return [
            'cuit_proveedor' => 'required|string|size:13',
            'proveedor' => 'required|string',
            'carrito' => 'required|array|min:1',
            'carrito.*.cantidad' => 'required|numeric|min:1',
            'carrito.*.producto_id' =>'required|numeric',
            'factura' => 'image',
        ];
    }
}
