<?php

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $rol = new Rol();
        $rol->nombre = "administrador";
        $rol->save();

        $rol = new Rol();
        $rol->nombre = "empleado";
        $rol->save();

        $rol = new Rol();
        $rol->nombre = "usuario";
        $rol->save();

    }
}
