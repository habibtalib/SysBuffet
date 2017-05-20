<?php

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado = new Estado([
        	'nombre' => 'pendiente'
        ]);
        $estado->save();

        $estado = new Estado([
        	'nombre' => 'entregado'
        ]);
        $estado->save();

        $estado = new Estado([
        	'nombre' => 'cancelado'
        ]);
        $estado->save();
    }
}
