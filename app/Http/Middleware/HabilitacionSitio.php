<?php

namespace App\Http\Middleware;

use Closure;
use Setting;
use Illuminate\Support\Facades\Auth;

class HabilitacionSitio
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
    
      if (Setting::get('sitio_habilitado') == 'deshabilitado'){
        if (Auth::guard($guard)->check() && Auth::user()->rol->nombre == "administrador"){
            return $next($request);
        }
        if ($request->route()->uri() == 'login') return $next($request); //solo se puede acceder al logearse
        else return response(view('configuracion.sitio-deshabilitado'));
      } else return $next($request);
    }
}