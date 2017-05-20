<?php

namespace App\Models;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class DetalleEgreso extends Model
{
    use softDeletes;
	
	protected $table = 'detalles_egresos';
    protected $dates = ['deleted_at'];

	protected $fillable = [
        'cantidad', 'precio_total', 'fecha', 'tipo_egreso_id', 'compra_id', 'producto_id'
    ];

    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];

    public function compra()
    {
      return $this->belongsTo('App\Models\Compra');
    }

    public function producto()
    {
      return $this->belongsTo('App\Models\Producto');
    }

    public static function crear($detalleData, $idCompra)
    {
        $producto = Producto::findOrFail($detalleData['producto_id']);
        $nuevoDetalle = new DetalleEgreso([
        		'producto_id' => $producto->id,
        		'compra_id' => $idCompra,
        		'fecha' => date('Y-m-d'),
        		'cantidad' => $detalleData['cantidad'],
        		'precio_total' => $producto->precio_venta_unitario * $detalleData['cantidad'],
        		'tipo_egreso_id' => 1, //Compra a proveedores
        ]); 
        $nuevoDetalle->save();
        $producto->stock = $producto->stock + $nuevoDetalle['cantidad'];
        $producto->update();
    }

    public static function recuperarGastosPorProducto($fechaInicial, $fechaFinal)
    {
        $productos = DetalleEgreso::join('productos', 'detalles_egresos.producto_id', '=', 'productos.id')
                         ->select(DB::raw('productos.id, sum(precio_total), productos.nombre, productos.marca'))
                         ->groupBy(['productos.id', 'productos.nombre', 'productos.marca'])
                         ->where([
                                    ['fecha', '>=', $fechaInicial],
                                    ['fecha', '<=', $fechaFinal ],
                                    ['tipo_egreso_id', 1]
                         ])->withTrashed()
                         ->get();
        return $productos;
    } 
    
    public static function recuperarGastosPorFecha($fechaInicial, $fechaFinal)
    {
        $productos = DetalleEgreso::select(DB::raw('fecha, sum(precio_total)'))
                         ->groupBy('fecha')
                         ->where([
                                    ['fecha', '>=', $fechaInicial],
                                    ['fecha', '<=', $fechaFinal ]
                         ])->withTrashed()
                         ->get();
        return $productos;
    }
}
