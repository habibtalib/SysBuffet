<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Menu;
use App\Http\Requests\MenuRequest;

class MenusController extends Controller
{
    public function __construct()
    {
    	$this->middleware('staff');
    }

    public function index()
    {
    	return view('menus.lista-fechas');
    }

    public function editar(Request $request)
    {
    	$menu = Menu::where('fecha', $request['menu_dia'])->withTrashed()->first(); //me traigo también los borrados logicamente, ya que incluyen los vacíos
    	if ($menu == null){	//si no existe lo creo 
    		$menu = new Menu(['fecha' => $request['menu_dia']]);
    		$menu->save();
    	}
    	return redirect('/menus/'. $menu->fecha .'/administrar');
    }

    public function administrar($fecha)
    {
    	$menu = Menu::where('fecha', $fecha)->withTrashed()->firstOrFail();
    	return view('menus.administrar-menu', ['productos' => Menu::getProductosAptosParaMenu(), 'menuAdministrar' => $menu, 'operacion' => 'Editar']);
    }

    public function actualizar(MenuRequest $request, $fecha)
    {
    	$menu = Menu::where('fecha', $fecha)->withTrashed()->first();
    	$menu->actualizarDetalles($request['carrito']);
    	return view('menus.menu-editado');
    }
}