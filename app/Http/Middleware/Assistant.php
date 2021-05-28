<?php

namespace App\Http\Middleware;

use App\Models\Notification;
use Closure;
use Auth;
use View;

class Assistant
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
        if (Auth::guard('assistant')->check()) {
            $notifications = Notification::where('user_type', 5)
                ->where('user_id', Auth::guard('assistant')->user()->id)
                ->where('is_read', 0)
                ->orderBy('id', 'DESC')
                ->get();

            View::share('notifications', $notifications);

            $response = $next($request);
            return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
                ->header('Pragma','no-cache')
                ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
        }
        return redirect()->route('assistantLoginForm');
    }
}
