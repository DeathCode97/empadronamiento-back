<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Propietarios\PropietariosController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\SanctumJWTMiddleware;

Route::middleware([SanctumJWTMiddleware::class])->group(function(){
    Route::get('/obtenerFecha', [PropietariosController::class, 'obtenerFecha']);
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Route::get('/obtenerFecha', [PropietariosController::class, 'obtenerFecha']);


// Esta es la ruta
Route::post('/insertarPropietarios', [PropietariosController::class, 'insertarPropietarios']);



Route::post('/obtenerPropietarios', [PropietariosController::class, 'obtenerPropietarios']);

