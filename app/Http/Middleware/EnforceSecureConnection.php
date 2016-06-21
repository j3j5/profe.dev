<?php

namespace App\Http\Middleware;

use Closure;

class EnforceSecureConnection
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
        $secure = env('HTTP_X_FORWARDED_PROTO') == 'https';
        if (!$secure && !app()->environment('local')) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
