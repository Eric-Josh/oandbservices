<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRegistrationCompletedMiddleware
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
        if (is_null(auth()->user()->phone1) 
            && is_null(auth()->user()->address) 
            && is_null(auth()->user()->job_type_id) 
            && auth()->user()->hasRole('handyman') )
        {
            return redirect()->route('handyman-register-step-2.create');
        }

        return $next($request);
    }
}
