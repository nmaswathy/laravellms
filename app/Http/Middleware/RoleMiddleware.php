<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in.');
        }

        $user = Auth::user();

        if ($user->role !== $role) {
            // If admin tries to access user pages, redirect to admin dashboard
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard')->with('error', 'Admins cannot access user pages.');
            }

            // For any other unauthorized access (e.g. user trying to access admin), redirect to login
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('error', 'Unauthorized access attempt.');
        }

        return $next($request);
    }
}
