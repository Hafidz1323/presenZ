<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\JwtService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class JwtAuthMiddleware
{
    protected JwtService $jwtService;

    public function __construct(JwtService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $authorization = $request->header('Authorization');

        if (!$authorization || !str_starts_with($authorization, 'Bearer ')) {
            return response()->json(['message' => 'Unauthorized: Token missing (Header Authorization Bearer kosong)'], 401);
        }

        $token = substr($authorization, 7);

        $payload = $this->jwtService->decode($token);

        if (!$payload || !isset($payload['sub'])) {
            return response()->json(['message' => 'Unauthorized: Token invalid or expired (Token tidak sah atau kedaluwarsa)'], 401);
        }

        $user = User::find($payload['sub']);

        if (!$user) {
            return response()->json(['message' => 'Unauthorized: User not found (Karyawan tidak terdaftar)'], 401);
        }

        if (!$user->is_active) {
            return response()->json(['message' => 'Unauthorized: User account is inactive (Akun dinonaktifkan)'], 403);
        }

        Auth::login($user);

        return $next($request);
    }
}
