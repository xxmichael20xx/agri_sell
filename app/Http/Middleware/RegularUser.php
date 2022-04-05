<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RegularUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->isRegularUser())
        {
            return $next($request);
        }
        return redirect('home');
    }
}
