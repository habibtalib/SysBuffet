<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoDetalle extends Model
{
    use SoftDeletes;

	protected $table="pedido_producto";
	protected $dates = ['deleted_at'];

	protected $fillable = [
        'pedido_id', 'producto_id', 'cantidad',
    ];

    protected $hidden = [
      'created_at', 'updated_at'
  	];

  	public function producto()
	{
		return $this->belongsTo('App\Models\Producto');
	}

	public function pedido()
	{
		return $this->belongsTo('App\Models\Pedido');
	}
}
