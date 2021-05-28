<?php

namespace App\Http\Middleware;

use Closure;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if ($permission !== null && !$request->user()->hasPermission($permission)) {
            return redirect('/admin/dashboard')->with('error', 'You don\'t have right to access this feature.');
        }
        return $next($request);
    }
}
