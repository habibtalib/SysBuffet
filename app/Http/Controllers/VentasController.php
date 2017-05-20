<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VentasEditRequest;
use App\Http\Requests\VentasRequest;
use App\Models\DetalleIngreso;
use App\Models\Producto;
use Setting;

class VentasController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('staff');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = DetalleIngreso::where('tipo_ingreso_id',1)->orderBy('cantidad')->paginate(Setting::get('items_paginados'));
        return view('ventas.listar-ventas', ['items' => $ventas]);
    }

    public function ordenarPor($atributo)
    {  
        $ventas = DetalleIngreso::orderBy($atributo, 'desc')->paginate(Setting::get('items_paginados'));
        return view('ventas.listar-ventas', ['items' => $ventas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::pluck('nombre','id');
        return view('ventas.agregar-editar-venta', ['productos' => $productos, 'operacion' => 'insertar']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VentasRequest $request)
    {
      $productoVendido = Producto::find($request['producto_id']);
      DetalleIngreso::crearVenta($productoVendido, $request->input('cantidad'), $request->input('descripcion'));
      return view('ventas.venta-insertada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DetalleIngreso::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venta = DetalleIngreso::find($id);
        $productos = Producto::pluck('nombre','id');
        return view('ventas.agregar-editar-venta', ['productos' => $productos, 'detalleIngreso' => $venta, 'operacion' => 'editar']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VentasEditRequest $request, $id)
    {
        $venta = DetalleIngreso::find($id);
        $venta->actualizarVenta($request->input('cantidad'));
        return view('ventas.venta-editada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $venta = DetalleIngreso::find($id);
      if ($venta != NULL && $venta->delete()){
        return response()->json([
          'msj' => 'destroyed'
        ]);
      } else {
        return response()->json([
          'msj' => 'not-destroyed'
        ]);
      }
    }
}
