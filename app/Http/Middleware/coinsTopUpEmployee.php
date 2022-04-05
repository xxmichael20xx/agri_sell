<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class coinsTopUpEmployee
{

    public function handle(Request $request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->isCoinsTopUpEmployee() )
        {
            return $next($request);
        }
        return redirect('home');
    }
}
