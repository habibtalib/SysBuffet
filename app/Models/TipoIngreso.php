<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoIngreso extends Model
{
    protected $table = "tipos_ingresos";

    public function ingresos_detalle(){
      return $this->hasMany('App\Models\DetalleIngreso');
    }
}
