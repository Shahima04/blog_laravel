<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //ensure the user is authenticated and has the 'admin' user_type
        if (Auth::check() && Auth::user()->user_type === 'admin'){
            return $next($request);
        }

        //redirect to the admin login page is not a admin
        return redirect()->route('admin.login')->with('error', 'Unauthorized access');   
    }
}
