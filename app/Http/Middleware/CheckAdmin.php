<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If not logged in → redirect to login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // If user is admin → allow access
        if (Auth::check() && Auth::user()->isAdmin()) {
        return $next($request);
    }

        // If not admin → block and redirect
        return redirect()
            ->route('movies.index')
            ->with('error', 'Unauthorized: Admin access required.');
    }
}