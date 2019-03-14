<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;
use Closure;

class SuperUserMiddleware
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
        if ($request->user() && $request->user()->role != 'SUPERUSER')
        {
            return new Response(view('auth.login')->with('role', 'SUPERUSER'));
        }
        return $next($request);
    }
}
