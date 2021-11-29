<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Permission;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permiso,$rol)
    {
        
            if(Auth::guest()){
                return redirect('/login');
            } 
            if($permiso != '' &&!$request->user()->can($permiso)){
                abort(403);       
            }
            if($rol != '' && !$request->user()->hasRole($rol)){
                abort(403);
            }
            return $next($request);
    }
}
