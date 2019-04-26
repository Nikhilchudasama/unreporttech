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
        if ($guard == 'superAdmin') {
            if (Auth::guard('admin')->check()) {
                return redirect()->route('super_admin.dashboard');
            }
            return $next($request);
        }

        if ($guard == 'admin') {
            if (Auth::guard('web')->check()) {
                return redirect()->route('admin.dashboard');
            }
            return $next($request);
        }


        if (Auth::guard($guard)->check()) {
            if ($guard == 'web') {
                return redirect()->route('super_admin.dashboard');
            }
            return redirect('/home');
        }

        return $next($request);
    }
}
