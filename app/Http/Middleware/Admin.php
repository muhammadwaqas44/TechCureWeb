<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use View;
use App\Models\Notification;

class Admin
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
        if (Auth::user() != null) {

            $notifications = Notification::where('user_type', 4)
            ->where('is_read', 0)
            ->orderBy('id', 'DESC')
            ->get();

            View::share('notifications', $notifications);

            $response = $next($request);
            return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
                ->header('Pragma','no-cache')
                ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
        }
        return redirect('/');
    }
}
