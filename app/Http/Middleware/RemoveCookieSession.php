<?php

namespace App\Http\Middleware;

use Closure;

class RemoveCookieSession
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
        if (!$request->is('auth/*') && !$request->is('admin*')) {
            config(['session.driver' => 'array']);
        } /*else {*/
//             config(['session.driver' => 'file']);
//         }
        return $next($request);
    }
}
