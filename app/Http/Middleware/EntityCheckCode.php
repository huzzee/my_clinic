<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class EntityCheckCode
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
        //dd($request);
        if(Auth::user()->entities->status == 0)
        {
            return abort(409);
        }
        return $next($request);
    }
}
