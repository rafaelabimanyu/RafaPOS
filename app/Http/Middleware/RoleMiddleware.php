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
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Logic for redirection if role doesn't match
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        } else {
            return redirect()->route('petugas.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }
    }
}
