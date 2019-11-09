<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Routing\ResponseFactory;

/**
 * Handle an incoming request.*/
class isEmployee
{


    /* *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->isEmployee || Auth::user()->isAdmin)) {
            return $next($request);
        }
        \Session::flash('message', "Please Login First");
        return redirect('/');
    }
}
