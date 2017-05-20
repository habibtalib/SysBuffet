<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTime;
use Setting;

class Pedido extends Model
{
	use SoftDeletes;
    protected $table="pedidos";
	protected $dates = ['deleted_at'];

	protected $fillable = [
        'observacion','fecha', 'estado_id', 'usuario_id'
    ];
    
    public function productosPedidos()
    {
    	return $this->belongsToMany('App\Models\Producto')->withPivot('cantidad');
    }
    public function detalles()
    {
        return $this->hasMany('App\Models\PedidoDetalle');
    }
    public function estado()
    {
    	return $this->belongsTo('App\Models\Estado');
    }
    public function usuario()
    {
    	return $this->belongsTo('App\Models\Usuario');
    }

    public function puedeModificar()
    {
        $fechaPedido = new DateTime($this->fecha);
        $tiempoTranscurrido = $fechaPedido->diff(new DateTime());
        if ($tiempoTranscurrido->d == 0 && $tiempoTranscurrido->h == 0 && $tiempoTranscurrido->i < 30) return true;
        else return false;
    }

    public function agregarPedidos($carrito)
    {
        foreach ($carrito as $productoPedido){
            $pedidoDetalle = new PedidoDetalle([
                'producto_id' => $productoPedido['producto_id'],
                'pedido_id' => $this->id,
                'cantidad' => $productoPedido['cantidad'],
            ]);
            $pedidoDetalle->save();
        }
    }
    
    public static function pedidoEntreFechasDeUsuario($usuarioId, $fechaInicial, $fechaFinal)
    {
    	return $pedidos = Pedido::where([
    			['usuario_id', $usuarioId],
    			['fecha', '>=', $fechaInicial],
    			['fecha', '<=', $fechaFinal]
    	])->orderBy('id')->paginate(Setting::get('items-paginados'));
    }
    
    public static function crear($usuarioId)
    {
    	$pedido = new Pedido([
    							'fecha' => date("Y-m-d H:i:s"),
    							'usuario_id' => $usuarioId,
    							'estado_id' => 1, //Estado pendiente
    						]);
    	$pedido->save();
    	return $pedido;
    }
}
