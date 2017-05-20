<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PedidoRequest;
use App\Http\Requests\PedidoEditRequest;
use App\Models\Menu;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\DetalleIngreso;
use App\Models\Usuario;
use App\Models\Estado;
use Auth;
use Guard;
use Setting;

class PedidosController extends Controller
{
	
	public function indexUsuario($slug)
	{
		$usuario = Usuario::where('slug', $slug)->firstOrFail();
		$pedidos = Pedido::where('usuario_id', $usuario->id)->orderBy('id')->paginate(Setting::get('items-paginados'));
		return view('pedidos.listar-pedidos-usuario', ['items' => $pedidos]);
	}

	public function filtrarFechas(Request $request, $slug)
	{
		$pedidos = Pedido::pedidoEntreFechasDeUsuario(Auth::id(), $request->input('fecha_inicio'), $request->input('fecha_fin'));
		return view('pedidos.listar-pedidos-usuario', ['items' => $pedidos]);
	}

	public function indexStaff($atributo = 'id')
	{
		if($atributo == 'pendientes')$pedidos=Estado::where('nombre','pendiente')->firstOrFail()->pedidos()->orderBy('fecha')->paginate(Setting::get('items-paginados'));
		 else $pedidos = Pedido::orderBy($atributo, 'desc')->paginate(Setting::get('items-paginados'));
		return view('pedidos.listar-pedidos-staff', ['items' => $pedidos]);
	}

	public function create()
	{
		$productosAptos = Menu::traerProductosHoy()->pluck('nombre', 'id');
		if ($productosAptos->count() > 0) return view('pedidos.agregar-editar-pedido', ['productos' => $productosAptos, 'operacion' => 'insertar']);
		else return view('pedidos.no-menu');
	}

	public function store(PedidoRequest $request)
	{
		$pedido = Pedido::crear(Auth::id());
		$pedido->agregarPedidos($request['carrito']);
		return view('pedidos.pedido-creado');
	}

	public function aceptarPedido($id)
	{
		$pedido = Pedido::findOrFail($id);
		if($pedido->estado->nombre == 'pendiente'){
			foreach($pedido->productosPedidos as $producto) DetalleIngreso::crearVenta($producto, $producto->pivot->cantidad);				
			$pedido->estado_id = 2;
			$pedido->update();
		}
		return response()->json([
          'msj' => 'aceptado'
        ]);
	}

	public function rechazarPedido(Request $request, $id)
	{
		$pedido = Pedido::findOrFail($id);
		if($pedido->estado->nombre == 'pendiente'){
			$pedido->estado_id = 3;
			if(!empty($request->input('motivo'))) $pedido->observacion = $request->input('motivo');
			$pedido->update();
		}
		return response()->json([
          'msj' => 'destroyed'
        ]);
	}

	public function editar(PedidoEditRequest $request, $id)
	{
		$pedido = Pedido::findOrFail($id);
		$productosAptos = Menu::traerProductosHoy()->pluck('nombre', 'id');
		//se pasa misma variable con dos nombres posibles para adaptar interfaz de carrito de compra y ahorrar codigo
		return view('pedidos.agregar-editar-pedido', ['productos' => $productosAptos, 'pedido' => $pedido,'compra' => $pedido, 'operacion' => 'editar']);
	}

	public function actualizar(PedidoRequest $request, $id)
	{
		$pedido = Pedido::findOrFail($id);
		foreach ($pedido->detalles as $detalle){
			$detalle->forceDelete();
		}
		$pedido->agregarPedidos($request['carrito']);
		return view('pedidos.pedido-editado');
	}
    
}
