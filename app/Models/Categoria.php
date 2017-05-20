<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
  protected $table = 'categorias';

  public function productos(){
    return $this->hasMany('App\Models\Producto');
  }

  protected $hidden = [
      'created_at', 'updated_at'
  ];
}
