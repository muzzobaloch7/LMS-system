<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            // \Log::info('User not authenticated');
            return redirect()->route('user.login');
        }

        $user = auth()->user();
        // \Log::info('User role: ' . $user->role);

        // If the user is a main admin, allow access regardless of other roles
        if ($user->role === 'mainadmin') {
            // \Log::info('User is mainadmin, allowing access');
            return $next($request);
        }

        // \Log::info('Allowed roles: ' . implode(', ', $roles));
        if (in_array($user->role, $roles)) {
            // \Log::info('User role is allowed, granting access'); // Ensure logging is active
            return $next($request);
        }

        // \Log::info('Access denied');
        return redirect()->route('user.login')->with('error', 'You do not have permission to access this page.');
    }
}