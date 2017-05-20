<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{

	protected $table="estados";
	protected $dates = ['deleted_at'];

	protected $fillable = [
        'nombre', 'estado'
    ];

    protected $hidden = [
      'created_at', 'updated_at'
  	];

  	public function pedidos()
  	{
  		return $this->hasMany('App\Models\Pedido');
  	}
}
