<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\Models\Usuario;
use App\Models\DetalleIngreso;
use App\Models\Producto;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Validator::extend('tiene_departamento', function ($attribute, $value, $parameters, $validator) {
            $usuario = Usuario::findOrFail($value);
            return !(empty($usuario->departamento));
      });
      Validator::extend('diferenciaNoSuperaStock', function ($attribute, $value, $parameters, $validator) {
            $venta = DetalleIngreso::findOrFail($ventaId = $parameters[0]);
            $producto = Producto::findOrFail($parameters[1]);
            $diferencia = $venta->cantidad - $value;
            return (($producto->stock + $diferencia) > 0);
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
