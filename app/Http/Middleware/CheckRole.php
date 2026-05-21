<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!$request->user()) {
            return $next($request);
        }

        if (!in_array($request->user()->role, $roles)) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to access this area.');
        }

        return $next($request);
    }
}
