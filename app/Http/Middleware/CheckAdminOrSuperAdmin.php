<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminOrSuperAdmin
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
        if(Auth::guard('admin')->user()->hasRoles(['superadmin','admin']) == false){
            return redirect()->route('admin.home');
        }
        return $next($request);
    }
}
