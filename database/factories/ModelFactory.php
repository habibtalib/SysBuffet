<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Usuario::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'nombre'            =>  $faker->firstNameMale,
        'apellido'          =>  $faker->lastName,
        'email'             =>  $faker->unique()->safeEmail,
        'usuario'           =>  $faker->userName,
        'telefono'          =>  $faker->e164PhoneNumber,
        'password'          =>  $password ?: $password = bcrypt('123456'),
        'habilitado'        =>  1,
        'rol_id'            =>  3,
        'ubicacion_id'      =>  3,
        'departamento'      =>  'Linux',
        'documento'         =>  rand(25000000,60000000),
        'remember_token'    =>  str_random(10),
    ];
});

$factory->define(App\Models\Producto::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'nombre'                =>  'Cerveza artesanal '. $faker->company, 
        'marca'                 =>  $faker->company. $faker->companySuffix,
        'stock'                 =>  rand(20, 300),
        'stock_minimo'          =>  rand(20, 300),
        'proveedor'             =>  $faker->company. $faker->companySuffix,
        'precio_venta_unitario' =>  rand(2,100),
        'descripcion'           =>  1,
        'fecha_alta'            =>  date('Y-m-d'),
        'codigo_barras'         =>  $faker->ean8,
        'categoria_id'          =>  1,
    ];
});
