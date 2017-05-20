<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = "ubicaciones";

    public function usuarios(){
      return $this->hasMany('App\Models\Usuario');
    }
}
