<?php

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeed extends Seeder
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
    }
}
