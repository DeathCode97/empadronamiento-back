<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class MiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try{

            if (!$request->hasHeader('Authorization')) {
                return response()->json(['error' => 'Acceso denegado'], 401);
            }

            if (!Auth::check()) {
                return response()->json(['error' => 'Usuario no ha inciado sesión'], 401);
            }
            if(!Auth::user()){
                return response()->json(['error' => 'Usuario no autenticado'], 401);
            }
        }catch(JWTException $ex){
            return response()->json(['error' => 'Token inválido o expirado'], 401);
        }
        return $next($request);
    }
}
