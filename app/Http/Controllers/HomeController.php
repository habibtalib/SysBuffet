<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Setting;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('sitio-habilitado');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.my-home', ['productosDia' => Menu::traerProductosHoy()]);
    }

    public function about()
    {
        return view('home.acerca-de', ['settings' => Setting::all()]);
    }
}
