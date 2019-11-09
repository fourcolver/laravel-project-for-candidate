<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Routing\ResponseFactory;

/**
 * Handle an incoming request.*/
class Admin
{


    /* *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::check()) {
            if (Auth::user()->isAdmin) {
                return $next($request);
            }
            if (Auth::user()->isEmployee) {
                $permission = \DB::table('emp_permission')->where('emp_id', Auth::user()->id)->first();
                $all_routes = array('index' => 'index', 'view' => 'view');
                $route = \Request::route()->getName();
                $permission = \DB::table('emp_permission')->where('emp_id', Auth::user()->id)->first();
                $kunden_roles = explode(',', $permission->kunden_permission);
                $manager_roles = explode(',', $permission->knotakte_permission);
                $opportunity_roles = explode(',', $permission->projektanfrage_permission);
                $freelancer_roles = explode(',', $permission->kandidaten_permission);
                $festanstellung_roles = explode(',', $permission->festanstellung_permission);
                $task_roles = explode(',', $permission->task_permission);
                if (in_array($route, $all_routes)) {
                    return $next($request);
                } else if (in_array($route, $kunden_roles) || in_array($route, $manager_roles) || in_array($route, $opportunity_roles) || in_array($route, $freelancer_roles) || in_array($route, $festanstellung_roles) || in_array($route, $task_roles)) {
                    return $next($request);
                } else {
                    \Session::flash('message', "Please Login First as Admin");
                    redirect('/');
                }
            }
        }
        \Session::flash('message', "Please Login First as Admin");
        return redirect('/');
    }
}
