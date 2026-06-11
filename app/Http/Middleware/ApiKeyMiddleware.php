<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY');

        if (!$apiKey) {
            return response()->json(['message' => 'Unauthorized: API Key missing (Header X-API-KEY kosong)'], 401);
        }

        $user = User::where('api_key', $apiKey)->first();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized: API Key invalid (API Key tidak cocok/salah)'], 401);
        }

        if (!$user->is_active) {
            return response()->json(['message' => 'Unauthorized: User account is inactive (Akun dinonaktifkan)'], 403);
        }

        Auth::login($user);

        return $next($request);
    }
}
