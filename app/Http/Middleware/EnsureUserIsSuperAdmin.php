<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Check if the user is authenticated and is a super admin
        if (!auth()->check() || !auth()->user()->hasRole('superadmin')) {
            // If not, redirect to the home page or an error page
            return redirect('/')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
