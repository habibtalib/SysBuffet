<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuDetalle extends Model
{

	use SoftDeletes;

	protected $table="menu_producto";
	protected $dates = ['deleted_at'];

	public function producto()
	{
		return $this->belongsTo('App\Models\Producto');
	}

	protected $fillable = [
        'menu_id', 'producto_id'
    ];

    protected $hidden = [
      'created_at', 'updated_at'
  	];

}

