<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        // header('Acess-Control-Allow-Origin: *');
        // header('Acess-Control-Allow-Origin: Content-type, X-Auth-Token, Authorization, Origin');
        // header('Acess-Control-Allow-Methods : GET, POST, PUT, DELETE, OPTIONS');
        return $next($request);
       
    }
}
