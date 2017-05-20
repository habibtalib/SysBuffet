<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Setting;
use App\Http\Requests\ConfiguracionRequest;

class ConfiguracionController extends Controller
{
    
    public function __construct()
    {
    	$this->middleware('administrador');
    }

    public function editar()
    {
    	return view('configuracion.editar-configuracion', ['operacion' => 'editar']);
    }

    public function configurar(ConfiguracionRequest $request)
    {
    	Setting::set('nombre', $request['nombre']);
    	Setting::set('items_paginados', $request['items_paginados']);
    	Setting::set('descripcion', $request['descripcion']);
    	Setting::set('mail_contacto', $request['mail_contacto']);
    	Setting::set('sitio_habilitado', $request['sitio_habilitado']);
    	Setting::set('mensaje_deshabilitacion', $request['mensaje_deshabilitacion']);
    	Setting::save();
    	return view('configuracion.configuracion-editada');
    }

}
