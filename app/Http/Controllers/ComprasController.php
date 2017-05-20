<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Compra;
use App\Models\DetalleEgreso;
use Illuminate\Http\Request;
use App\Http\Requests\CompraRequest;
use Image;
use Response;
use Setting;

class ComprasController extends Controller
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
        $compras = Compra::orderBy('id')->paginate(Setting::get('items_paginados'));
        return view('compras.lista-compras', ['items' => $compras]);
    }

    public function ordenarPor($atributo)
    {  
        $compras = Compra::orderBy($atributo, 'desc')->paginate(Setting::get('items_paginados'));
        return view('compras.listar-compras', ['items' => $compras]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::pluck('nombre', 'id');
        return view('compras.agregar-editar-compra', ['productos' => $productos, 'operacion' => 'insertar']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompraRequest $request)
    {
        $request['fecha'] = date('Y-m-d');
        $compra = new Compra($request->all());
        $compra->setImagenDesdeRequest($request);
        $compra->save();
        foreach ($request['carrito'] as $detalle) DetalleEgreso::crear($detalle, $compra->id);
        return view('compras.compra-insertada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Compra::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $compra = Compra::findOrFail($id);
        $productos = Producto::pluck('nombre', 'id');
        return view('compras.agregar-editar-compra', ['operacion' => 'editar', 'compra' => $compra, 'productos' => $productos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompraRequest $request, $id)
    {
        $compra = Compra::findOrFail($id);
        $compra->setImagenDesdeRequest($request);
        $compra->update($request->all());
        $compra->actualizarDetalles($request['carrito']);
        $compra->update();
        return view('compras.compra-editada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $compra = Compra::find($id);
        foreach ($compra->detalles as $detalle){
            $detalle->delete();
        }
          if ($compra != NULL && $compra->delete()){
            return response()->json([
              'msj' => 'destroyed'
            ]);
          } else {
            return response()->json([
              'msj' => 'not-destroyed'
            ]);
          }
    }

    public function mostrarFactura($id){
        $compra = Compra::findOrFail($id);
        $pic = Image::make($compra->factura);
        $response = Response::make($pic->encode('jpeg'));
        $response->header('Content-Type', 'image/jpeg');
        return $response;
    }

    public static function format($carritoObjetos){
        $carritoArray = array();
        $index = 0;
        if ($carritoObjetos != null){
            foreach ($carritoObjetos as $detalle){
                $carritoArray[$index]['cantidad'] = $detalle->cantidad;
                $carritoArray[$index]['producto_id'] = $detalle->producto_id;
                $index = $index + 1;
            }
        }
        return $carritoArray;
    }
}
