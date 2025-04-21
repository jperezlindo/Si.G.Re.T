<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Encargado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //1 administrador 2 Encargado
        if ((Auth::user()->rol() == 1) or (Auth::user()->rol() == 2)) {
            return $next($request);
        }else{
            abort(401);
        }
    }
}
