<?php

use Illuminate\Database\Seeder;
use App\Models\TipoEgreso;
use App\Models\DetalleEgreso;
use App\Models\Compra;
use App\Models\Producto;

class CompraSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoCompra = new TipoEgreso();
        $tipoCompra->nombre="Compra a proveedor";
        $tipoCompra->save();

        $tipoCompra = new TipoEgreso();
        $tipoCompra->nombre="Gastos extras";
        $tipoCompra->save();

        $compra = new Compra();
        $compra->cuit_proveedor = '31-10191018-1';
        $compra->proveedor = 'Linux SA';
        $compra->fecha = date('Y-m-d');
        $compra->save();

        $detalleCompra = new DetalleEgreso();
        $detalleCompra->compra_id = 1;
        $detalleCompra->cantidad=200;
        $detalleCompra->fecha = date('Y-m-d');
        $detalleCompra->producto_id=3;
        $detalleCompra->tipo_egreso_id = 1;
        $prod = Producto::find($detalleCompra->producto_id);
        $detalleCompra->precio_total = $detalleCompra->cantidad * $prod->precio_venta_unitario; //Ejemplo, no se resta stock
        $detalleCompra->save();

        $detalleCompra = new DetalleEgreso();
        $detalleCompra->compra_id = 1;
        $detalleCompra->cantidad=40;
        $detalleCompra->fecha = date('Y-m-d');
        $detalleCompra->producto_id=6;
        $detalleCompra->tipo_egreso_id = 1;
        $prod = Producto::find($detalleCompra->producto_id);
        $detalleCompra->precio_total = $detalleCompra->cantidad * $prod->precio_venta_unitario; //Ejemplo, no se resta stock
        $detalleCompra->save();
    }
}
