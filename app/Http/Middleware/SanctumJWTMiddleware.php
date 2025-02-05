<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\PersonalAccessToken;

class SanctumJWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        // $user = Auth::guard('sanctum')->user();

        if (!$token) {
            return response()->json(['error' => 'Token no proporcionado'], Response::HTTP_UNAUTHORIZED);
        }

        // Verifica si el token es válido
        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken || !$accessToken->tokenable) {
            return response()->json(['error' => 'Token inválido'], Response::HTTP_UNAUTHORIZED);
        }

        // $user = $accessToken->tokenable;
        // Asocia el usuario autenticado con la solicitud
        $request->merge(['user' => $accessToken->tokenable]);

        return $next($request);
        // return $next($request);
    }
}
