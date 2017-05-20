<?php

use Illuminate\Database\Seeder;
use App\Models\DetalleIngreso;
use App\Models\TipoIngreso;
use App\Models\Producto;

class VentaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $tipoVenta = new TipoIngreso();
        $tipoVenta->nombre="Venta del buffet";
        $tipoVenta->save();

        $tipoVenta = new TipoIngreso();
        $tipoVenta->nombre="Facultad";
        $tipoVenta->save();

        $venta = new DetalleIngreso();
        $venta->cantidad=200;
        $venta->fecha = date('Y-m-d');
        $venta->producto_id=3;
        $venta->tipo_ingreso_id=$tipoVenta->id;
        $prod = Producto::find($venta->producto_id);
        $venta->precio_total = $venta->cantidad * $prod->precio_venta_unitario;
        $venta->save();

        $venta = new DetalleIngreso();
        $venta->cantidad=21;
        $venta->fecha = date('Y-m-d');
        $venta->producto_id=2;
        $venta->tipo_ingreso_id=$tipoVenta->id;
        $prod = Producto::find($venta->producto_id);
        $venta->precio_total = $venta->cantidad * $prod->precio_venta_unitario;
        $venta->save();

        $venta = new DetalleIngreso();
        $venta->cantidad=11;
        $venta->fecha = date('Y-m-d');
        $venta->producto_id=1;
        $venta->tipo_ingreso_id=$tipoVenta->id;
        $prod = Producto::find($venta->producto_id);
        $venta->precio_total = $venta->cantidad * $prod->precio_venta_unitario;
        $venta->save();
    }
}
