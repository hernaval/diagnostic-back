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
        //  header('Acess-Control-Allow-Origin: *');
        //  header('Acess-Control-Allow-Headers: *');
        //  header('Acess-Control-Allow-Origin: Content-type, X-Auth-Token, Authorization, Origin');
        //  header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    
         return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers','Accept, Origin, Content-Type,X-Requested-With, X-Auth-Token,Authorization');
       
    }
}
