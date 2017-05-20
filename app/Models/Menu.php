<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MenuDetalle;
use App\Models\Producto;

class Menu extends Model
{

	use SoftDeletes;

	protected $table="menus";
	protected $dates = ['deleted_at'];

	protected $fillable = [
        'fecha'
    ];

    protected $hidden = [
      'created_at', 'updated_at'
  	];

	public function productosDelMenu()
	{	
		return $this->belongsToMany('App\Models\Producto')->withTimestamps();
	}	

	public function actualizarDetalles($detalles)
	{
		$this->borrarDetalles();
		$this->crearDetalles($detalles);
	}

	public function borrarDetalles()
	{
		$detalles = MenuDetalle::where('menu_id', $this->id)->get();
		foreach($detalles as $detalle){
			$detalle->forceDelete(); //se borra físicamente porque no es data "interesante" si un producto fue dado de baja en un menú
		}
	}

	public function crearDetalles($detalles)
	{
		foreach($detalles as $productoId){
			$menuDetalle = new MenuDetalle([
				'producto_id' => $productoId,
				'menu_id' => $this->id
			]);
			$menuDetalle->save();
		}
	}

	public static function traerProductosHoy()
	{
		return self::traerProductos(date('Y-m-d'));
	}

	public static function traerProductos($fecha)
	{
		$menu = Menu::where('fecha', $fecha)->first();
		if($menu != null){
			return $menu->productosDelMenu;
		} else return collect([]);	
	}

	public static function getProductosAptosParaMenu()
	{
		return Producto::where('stock','>','stock_minimo')->pluck('nombre', 'id');
	}
}
