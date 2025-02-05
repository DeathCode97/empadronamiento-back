<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\VarDumper\VarDumper;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        // Aqui le podemos poner que reciba el rol de usuario y otros parametros de registro de USUARIOS FUNCIONALES DEL SISTEMA

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            // 'access_token' => $token,
            // 'token_type' => 'Bearer',
            "message" => "Usuario Creado con exito"
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        // Genera un token personal
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);

    }

    public function logout(Request $request)
    {
        var_dump($request->user());
        // $request->user()->currentAccessToken()->delete();


        // return response()->json(['message' => 'Logged out'], 200);
        // var_dump($request);
        // $request->user()->tokens()->delete();

        return response()->json(['message' => 'Sesión cerrada con éxito']);
    }
}
