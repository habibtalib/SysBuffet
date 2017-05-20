<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Setting;

class ProductosController extends Controller
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
        $productos    =  Producto::orderBy('nombre')->paginate(Setting::get('items_paginados'));
        return view('productos.listar-productos', ['items' => $productos]);
    }

    public function ordenarPor($atributo)
    {  
        $productos = Producto::orderBy($atributo, 'desc')->paginate(Setting::get('items_paginados'));
        return view('productos.listar-productos
            ', ['items' => $productos]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::pluck('nombre', 'id');
        return view('productos.agregar-editar-producto', [ 'categorias' => $categorias, 'operacion' => 'insertar'] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProducto  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoRequest $request)
    {
        $request['fecha_alta'] = date('Y-m-d');
        $usuario = new Producto($request->all());
        $usuario->save();
        return view('productos.producto-insertado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      return Producto::where('slug', $slug)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categorias = Categoria::pluck('nombre','id'); //Arma un array en donde el índice es 'id' y la clave 'nombre'
        $producto = Producto::where('slug', $slug)->first();
        return view('productos.agregar-editar-producto', ['producto' => $producto, 'categorias' => $categorias, 'operacion' => 'editar']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductoRequest $request, $slug)
    {
      $producto = Producto::where('slug', $slug)->first();
      $producto->update($request->all());
      return view('productos.producto-editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
      $producto = Producto::where('slug', $slug);
      if ($producto != NULL && $producto->delete()){
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
