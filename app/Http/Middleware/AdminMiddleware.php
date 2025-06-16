<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $request->expectsJson()
                ? response()->json(['error' => 'Unauthenticated'], 401)
                : redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        if (Auth::user()->role !== 'admin') {
            return $request->expectsJson()
                ? response()->json(['error' => 'Hanya admin yang diizinkan'], 403)
                : redirect()->route('home')->with('error', 'Akses ditolak. Hanya admin yang diizinkan.');
        }

        return $next($request);
    }
}
