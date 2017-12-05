<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
        $route = [
            'admin'    => 'admin.dashboard',
            'employee' => 'employee.dashboard',
            'tablet'   => 'tablet.dashboard',
            'employer' => 'employer.dashboard'
        ];

        /**
         *  navigate deferent users, depend on they roles
         */
        if (Auth::guard($guard)->check()) {
            return redirect()->route($route[$guard]);
        }

        return $next($request);
    }

}
