<?php

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	static $password;
    	$usuario = new Usuario([
    		'nombre'            =>  'Fermín',
	        'apellido'          =>  'Minetto',
	        'email'             =>  'ferminmine@gmail.com',
	        'usuario'           =>  'ferminmine',
	        'telefono'          =>  '+542213540026',
	        'password'          =>  bcrypt('123456'),
	        'habilitado'        =>  1,
	        'rol_id'            =>  1,
	        'ubicacion_id'      =>  1,
	        'departamento'      =>  'Buffet FI',
	        'documento'         =>  '38866490',
            'habilitado'        =>  1,
	        'remember_token'    =>  str_random(10),
    	]);
        $usuario->save();

        static $password;
        $usuario = new Usuario([
            'nombre'            =>  'Pedidos',
            'apellido'          =>  'Pedidos',
            'email'             =>  'pedidos@buffet.com',
            'usuario'           =>  'pedidos',
            'telefono'          =>  '+542213540026',
            'password'          =>  bcrypt('123456'),
            'habilitado'        =>  1,
            'rol_id'            =>  3,
            'ubicacion_id'      =>  1,
            'departamento'      =>  'Buffet FI',
            'documento'         =>  '38866490',
            'habilitado'        =>  1,
            'remember_token'    =>  str_random(10),
        ]);
        $usuario->save();
    }
}