<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user() && auth()->user()->role == 'Admin') {
            if (auth()->user() && auth()->user()->approval == 'approved') {
                if (auth()->user() && auth()->user()->status == 'active') {
                    return $next($request);
                }
            }
        }
        return redirect('/');
    }
}
