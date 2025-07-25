<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function example()
    {
        return ["Axia" => "perrota"];
    }

    public function register(Request $request)
    {
        // Validar los datos del usuario
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:100',
            'rol' => 'required|string|max:100',
            'password' => 'required|string',
        ]);

        // return "hola";

        // Crear el usuario en la base de datos
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'rol' => $data['rol'],
            'password' => Hash::make($data['password']),
        ]);

        // Generar el token JWT
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $user,
            'token' => $token
        ], 201);
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }
        $user = User::where('username', $request->username)->select('name', 'username', 'rol')->first();

        return response()->json(['token' => $token, 'info_session' => $user]);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        Auth::logout();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }

}
