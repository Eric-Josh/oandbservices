<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBasicUserTypeMiddleware
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
        if ( auth()->user()->user_type == 2 )
        {
            return redirect('/customer/dashboard');

        }elseif (auth()->user()->user_type == 3)
        {
            return redirect()->route('handyman.dashboard');
            
        }elseif (auth()->user()->user_type == 1)
        {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
