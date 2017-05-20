<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Pedido;
use App\Models\Usuario;
use Auth;

class PedidoEditRequest extends FormRequest
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

    public function __construct(\Illuminate\Http\Request $request)
    {
      $pedido = Pedido::findOrFail($request->route('id'));
      //Se valida vulnerabilidad: referencia a objetos directa de manera insegura
      $pedidos = Pedido::where([
            ['usuario_id', Auth::id()],
            ['id', $pedido->id ]
      ])->get();
      if ((count($pedidos)) > 0) $request['usuarioValidado'] = 1;

      //Se valida que no haya pasado media hora
      if ($pedido->puedeModificar()) $request['tiempoRequerido'] = 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'usuarioValidado' => 'required',
            'tiempoRequerido' => 'required'
        ];
    }
}
