<?php

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      $cat = new Categoria();
      $cat->nombre = "Varios";
      $cat->descripcion = "Productos Varios";
      $cat->save();

      $cat1 = new Categoria();
      $cat1->nombre = "Golosinas";
      $cat1->descripcion = "Golosinas de todo tipo";
      $cat1->save();

      $prod = new Producto();
      $prod->nombre = "Alfajor de maicena";
      $prod->marca="Guaymayén";
      $prod->stock=100;
      $prod->stock_minimo=10;
      $prod->proveedor="Distribuidora La Plata";
      $prod->precio_venta_unitario=2.50;
      $prod->descripcion="Delicioso";
      $prod->fecha_alta=date('Y-m-d H:i:s');
      $prod->codigo_barras=111010;
      $prod->categoria_id = $cat->id;
      $prod->save();

    }
}
