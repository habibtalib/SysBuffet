<?php

use Illuminate\Database\Seeder;
use App\Models\Ubicacion;

class UbicacionesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $ubicacion = new Ubicacion();
        $ubicacion->nombre 			=	"La Plata";
        $ubicacion->descripcion		=	"La mejor ciudad de todas";		
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre 			=	"Buenos Aires";
        $ubicacion->descripcion		=	"La ciudad con olor a humo";		
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre 			=	"Mar del Plata";
        $ubicacion->descripcion		=	"La ciudad feliz";		
        $ubicacion->save();
        
    }
}
