<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @param  string[] ...$roles Variabel argumen berupa daftar role yang diizinkan (misal: 'admin', 'hr')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (! $request->user() || ! in_array($request->user()->role, $roles)) {
            abort(403, 'Unauthorized Access. Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
