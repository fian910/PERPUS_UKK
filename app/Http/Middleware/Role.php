<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($request->user()->role != $role) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
            // atau
            // return abort(403, 'Unauthorized action');
        }
        return $next($request);
    }
}
