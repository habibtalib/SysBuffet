<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Producto extends Model
{
      use Sluggable;
      use SoftDeletes;

      protected $table = 'productos';
      protected $dates = ['deleted_at'];

  /**
  * Return the sluggable configuration array for this model.
  *
  * @return array
  */
  public function sluggable()
  {
      return [
          'slug' => [
              'source' => 'nombre'
          ]
      ];
  }

  public function categoria(){
    return $this->belongsTo('App\Models\Categoria');
  }

  public function ingresos(){
    return $this->hasMany('App\Models\DetalleIngreso');
  }

  public function pedidosDetalle()
  {
    return $this->hasMany('App\Models\PedidoDetalle');
  }

  public function compras()
  {
        return $this->hasMany('App\Models\Producto');
  }

  protected $fillable = [
      'nombre', 'baja', 'marca', 'proveedor', 'descripcion', 'precio_venta_unitario', 'stock', 'stock_minimo', 'codigo_barras', 'categoria_id', 'fecha_alta'
  ];

  protected $hidden = [
      'password', 'remember_token', 'created_at', 'updated_at'
  ];

  public function vender($cantidad)
  {
    $this->stock = $this->stock - $cantidad;
    $this->update();
  }

  public function comprar($cantidad)
  {
    $this->stock = $this->stock + cantidad;
    $this->update();
  }
  
  public function menus()
  { 
    return $this->belongsToMany('App\Models\Menu')->withTimestamps();
  } 

  public function pedidos()
  {
    return $this->belongsToMany('App\Models\Pedido')->withTimeStamps();
  }

  public static function validarStock($carrito)
  {
      $superoStock = false;
      foreach($carrito as $detalle){
        $productoPedir = Producto::findOrFail($detalle['producto_id']);
        $resta = $productoPedir->stock - $detalle['cantidad'];
        if ($resta < 0) $superoStock = true;
      }
      return $superoStock;
  }

}
