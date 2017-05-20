<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Ubicacion;
use App\Models\Rol;
use Setting;

class UsuariosController extends Controller
{

    public function __construct()
    {
        $this->middleware('administrador');
    }

    public function index()
    {
        $usuarios    =  Usuario::orderBy('usuario')->paginate(Setting::get('items_paginados'));
        return view('usuarios.listar-usuarios', ['items' => $usuarios]);
    }

    public function ordenarPor($atributo)
    {  
        $usuarios = Usuario::orderBy($atributo, 'desc')->paginate(Setting::get('items_paginados'));
        return view('usuarios.listar-usuarios', ['items' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::pluck('nombre', 'id');
        $ubicaciones = Ubicacion::pluck('nombre', 'id');
        return view('usuarios.agregar-editar-usuario', ['operacion' => 'insertar', 'roles' => $roles, 'ubicaciones' => $ubicaciones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        $request->password = bcrypt($request->password);
        $request->habilitado = 1;
        $usuario = new Usuario($request->all());
        $usuario->save();
        return view('usuarios.usuario-insertado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return Usuario::where('slug', $slug)->first(); //para debuggeo
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $roles = Rol::pluck('nombre', 'id');
        $usuario = Usuario::where('slug', $slug)->firstOrFail();
        $ubicaciones = Ubicacion::pluck('nombre', 'id');
        return view('usuarios.agregar-editar-usuario',['operacion' => 'editar', 'ubicaciones' => $ubicaciones, 'usuario' => $usuario, 'roles' => $roles ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioRequest $request, $slug)
    {
        $usuario = Usuario::where('slug', $slug)->firstOrFail();
        $usuario->update($request->all());
        return view('usuarios.usuario-editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
      $usuario = Usuario::where('slug', $slug);
      if ($usuario != NULL && $usuario->delete()){
        return response()->json([
          'msj' => 'destroyed'
        ]);
      } else {
        return response()->json([
          'msj' => $slug +' not destroyed'
        ]);
      }
    }

    public function habilitar($slug)
    {
        $usuario = Usuario::where('slug', $slug)->firstOrFail();
        $usuario->habilitado = 1;
        $usuario->update();
        return view('usuarios.usuario-habilitado');
    }


}
