<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Producto;
use App\Models\DetalleIngreso;

class VentasEditRequest extends FormRequest
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
        'producto_id' => 'required|numeric',
        'cantidad' => 'required|numeric|diferenciaNoSuperaStock:'.$this->route()->getParameter('venta').','.$this->input('producto_id'),
        'descripcion' => 'string|max:255'
      ];
    }
}
