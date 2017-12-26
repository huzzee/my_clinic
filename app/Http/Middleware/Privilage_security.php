<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Privilage_security
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
        /*if(Auth::user()->role_id !== 1)
        {

            if(!check_user_privilage(Auth::user()->role_id))
            {
                return abort(408);
            }
        }*/
        return $next($request);
    }
}
