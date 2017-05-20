<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UsuarioRegistrado
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
       if (Auth::guard($guard)->check()) {
           if (Auth::user()->rol->nombre == "usuario"){
               return $next($request);
           } else return response('Unauthorized', 401);
       } else return response('Unauthorized.', 401);
    
    }
}
