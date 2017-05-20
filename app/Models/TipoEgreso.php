<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEgreso extends Model
{
    protected $table = "tipos_egresos";

    public function ingresos_detalle(){
      return $this->hasMany('App\Models\DetalleEgreso');
    }
}

