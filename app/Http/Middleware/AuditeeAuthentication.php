<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuditeeAuthentication
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'Auditee') {
            if (auth()->user()->approval === 'approved' && auth()->user()->status === 'active') {
                return $next($request);
            }
        }

        return redirect('/');
    }
}
