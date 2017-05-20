<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriaSeed::class);
        $this->call(UbicacionesSeed::class);
        $this->call(EstadoSeed::class);
        $this->call(RolesSeed::class);
        $this->call(UsuarioSeed::class);
        factory(App\Models\Usuario::class, 80)->create();
        factory(App\Models\Producto::class, 50)->create();
        $this->call(VentaSeed::class);
        $this->call(CompraSeed::class);
    }
}
