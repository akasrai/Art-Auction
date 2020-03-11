<?php

namespace App\Http\Middleware;

use Closure;

class ManagerMiddleware
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
        // checking users type here in loop
        foreach (Auth::user()->role as $role) {
            if ($role->name == 'Manager') {
                return $next($request);
            }
        }
        return redirect('/seller');
    }
}
