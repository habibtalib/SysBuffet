<?php

namespace App\Models;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class DetalleIngreso extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "detalles_ingresos";

    public function tipo_ingreso()
    {
      return $this->belongsTo('App\Models\TipoIngreso');
    }

    public function producto()
    {
      return $this->belongsTo('App\Models\Producto')->withTrashed();
    }

    protected $fillable = [
        'cantidad', 'producto_id', 'descripcion', 'fecha', 'tipo_ingreso_id', 'precio_total', 'deleted_at', 'created_at', 'updated_at'
    ];

    public function puedeEditar($producto_id, $nuevaCantidad)
    {
      $this->descripcion="Testeo";
      $this->update();
      if ($this->cantidad >= $nuevaCantidad) return true;
      else return false;
    }

    /*
    ** Una nueva cantidad, actualiza la venta y el stock del producto asociado.
    */
    public function actualizarVenta($nuevaCantidad)
    {
      $diferencia = $this->cantidad - $nuevaCantidad;
      $this->producto->stock = $this->producto->stock + $diferencia;
      $this->cantidad = $nuevaCantidad;
      $this->update();
      $this->producto->update();
    }

    public static function recuperarVentasPorProducto($fechaInicial, $fechaFinal)
    {
        $productos = DetalleIngreso::join('productos', 'detalles_ingresos.producto_id', '=', 'productos.id')
                         ->select(DB::raw('productos.id, sum(precio_total), productos.nombre, productos.marca'))
                         ->groupBy(['productos.id', 'productos.nombre', 'productos.marca'])
                         ->where([
                                    ['fecha', '>=', $fechaInicial],
                                    ['fecha', '<=', $fechaFinal ],
                                    ['tipo_ingreso_id', 1]
                                ])
                         ->get();
        return $productos;
    } 
    
    public static function recuperarVentasPorFecha($fechaInicial, $fechaFinal)
    {
        $productos = DetalleIngreso::select(DB::raw('fecha, sum(precio_total)'))
                         ->groupBy('fecha')
                         ->where([
                                    ['fecha', '>=', $fechaInicial],
                                    ['fecha', '<=', $fechaFinal ]
                                ])
                         ->get();
        return $productos;
    }
    
    public static function crearVenta($productoVendido, $cantidad, $descripcion = null)
    {
    	$productoVendido->stock = $productoVendido->stock - $cantidad;
    	$productoVendido->update();
    	$venta = new DetalleIngreso([
    			'precio_total' => $cantidad * $productoVendido->precio_venta_unitario,
    			'cantidad' => $cantidad,
    			'producto_id' => $productoVendido->id,
    			'tipo_ingreso_id' => 1, //venta del buffet
    			'fecha' => date('Y-m-d'),
    			'descripcion' => $descripcion,
    	]);
    	$venta->save();
    }
}
