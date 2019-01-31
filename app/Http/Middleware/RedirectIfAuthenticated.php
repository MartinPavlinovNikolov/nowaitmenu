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
            'admin'    => 'admin.employers.index',
            'employee' => 'welcome',
            'tablet'   => 'welcome',
            'employer' => 'employer.home'
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
