<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DetalleEgreso;
use App\Models\Producto;
use Image;
use Response;

class Compra extends Model
{

    use softDeletes;

    protected $table = 'compras';
    protected $dates = ['deleted_at'];

	protected $fillable = [
        'cuit_proveedor', 'proveedor', 'fecha'
    ];

    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];

    public function detalles()
    {
      return $this->hasMany('App\Models\DetalleEgreso');
    }

    public function setImagenDesdeRequest($request)
    {
        if($request->file('factura') != null){
            $factura = Image::make($request->file('factura')->getRealPath())->resize(600,600);
            Response::make($factura->encode('jpeg'));
            $this->factura = $factura;
        }
    }

    //Consultar política de editar compras en documentación del sistema
    public function actualizarDetalles($nuevosDetalles)
    {
        $detallesOriginales = DetalleEgreso::where('compra_id', $this->id)->get()->keyBy('producto_id');
        foreach ($nuevosDetalles as $nuevoDetalle){
            if(isset($detallesOriginales[$nuevoDetalle['producto_id']])){ //habia un producto en la compra
            	$this->actualizarDetalleOriginal($detallesOriginales[$nuevoDetalle['producto_id']], $nuevoDetalle);
            } else {
            	DetalleEgreso::crear($nuevoDetalle, $this->id);
            }
        }
        foreach ($detallesOriginales as $detalleOriginal){ //borra los detalles originales que no aparecen, dejando el stock del producto como antes
            $nuevosDetalles = collect($nuevosDetalles)->keyBy('producto_id');
            if (! isset($nuevosDetalles[$detalleOriginal['producto_id']])){
                $producto = Producto::findOrFail($detalleOriginal['producto_id']);
                $producto->stock = $producto->stock - $detalleOriginal['cantidad'];
                $producto->update();
                $detalleOriginal->forceDelete();
            }
        }
    }
	
    private function actualizarDetalleOriginal($detalleOriginal, $nuevoDetalle)
    {
    	$producto = Producto::findOrFail($nuevoDetalle['producto_id']);
    	$diferencia = $nuevoDetalle['cantidad'] - $detalleOriginal['cantidad'];
    	$producto->stock = $producto->stock + $diferencia;
    	$detalleOriginal['precio_total'] = $nuevoDetalle['cantidad'] * $producto->precio_venta_unitario;
    	$detalleOriginal['cantidad'] = $nuevoDetalle['cantidad'];
    	$producto->update();
    	$detalleOriginal->update();
    }
    
    public function productosPedidos()
    {
        return $this->belongsToMany('App\Models\Producto');
    }
}
