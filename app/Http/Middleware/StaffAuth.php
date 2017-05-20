<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StaffAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */    
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->rol->nombre == "administrador" OR Auth::user()->rol->nombre == "empleado"){
              return $next($request);
            } else return response('Unauthorized', 401);
        } else return response('Unauthorized.', 401);
    }
}
