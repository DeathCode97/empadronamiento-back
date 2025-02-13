<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Propietarios\PropietariosController;
use App\Http\Controllers\Servicios\ServiciosController;
use App\Http\Controllers\Negocio\NegocioController;
use App\Http\Controllers\HistorialPagos\HistorialPagosController;
use App\Http\Controllers\Giros\GirosController;
use App\Http\Controllers\ActividadEconomica\ActividadEconomicaController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\SanctumJWTMiddleware;

Route::middleware([SanctumJWTMiddleware::class])->group(function () {
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

Route::post('/editarPropietario', [PropietariosController::class, 'editarPropietario']);

Route::post('/eliminarPropietario', [PropietariosController::class, 'eliminarPropietario']);

Route::post('/obtenerNegociosPorPropietario', [PropietariosController::class, 'obtenerNegociosPorPropietario']);


//ruta de agregar servicios
Route::post('/agregarServicios', [ServiciosController::class, 'agregarServicios']);

//ruta de obtener servicios
Route::post('/obtenerServicios', [ServiciosController::class, 'obtenerServicios']);

//ruta para actualizar servicios
Route::post('/actualizarServicios', [ServiciosController::class, 'actualizarServicios']);

//ruta para eliminar servicios
Route::post('/eliminarServicios', [ServiciosController::class, 'eliminarServicios']);


//Negocio

//ruta para agregarNegocio

Route::post('/agregarNegocio', [NegocioController::class, 'agregarNegocio']);

//ruta para obtenerNegocio

Route::post('/obtenerNegocio', [NegocioController::class, 'obtenerNegocio']);

//ruta para actualizarNegocio

Route::post('/actualizarNegocio', [NegocioController::class, 'actualizarNegocio']);

//ruta para eliminarNegocio

Route::post('/eliminarNegocio', [NegocioController::class, 'eliminarNegocio']);

// Obtener negocio y propietarios

Route::post('/obtenerNegociosConPropietarios', [NegocioController::class, 'obtenerNegociosConPropietarios']);

Route::post('/obtenerServiciosPorNegocio', [NegocioController::class, 'obtenerServiciosPorNegocio']);

//historialPagos

//generar historial de pagos

Route::post('/generarHistorialPagos', [HistorialPagosController::class, 'generarHistorialPagos']);

//obtener historial de pagos

Route::post('/obtenerHistorialPagos', [HistorialPagosController::class, 'obtenerHistorialPagos']);

//actualizar historial pagos

Route::post('/actualizarHistorialPagos', [HistorialPagosController::class, 'actualizarHistorialPagos']);

//eliminar historial pagos

Route::post('/eliminarHistorialPagos', [HistorialPagosController::class, 'eliminarHistorialPagos']);


//giros

//insert giro

Route::post('/agregarGiro', [GirosController::class, 'agregarGiro']);

//obtener giro

Route::post('/obtenerGiros', [GirosController::class, 'obtenerGiros']);


//actualizar giro

Route::post('/actualizarGiro', [GirosController::class, 'actualizarGiro']);

//eliminar giro 

Route::post('/eliminarGiro', [GirosController::class, 'eliminarGiro']);

//Actividad economica

//Insertar actividad economica

Route::post('/insertarActividadEconomica', [ActividadEconomicaController::class, 'insertarActividadEconomica']);


//obtener actividad economica

Route::post('/obtenerActividadEconomica', [ActividadEconomicaController::class, 'obtenerActividadEconomica']);


//actualizar actividad economica

Route::post('/actualizarActividadEconomica', [ActividadEconomicaController::class, 'actualizarActividadEconomica']);


//eliminar actividad economica

Route::post('/eliminarActividadEconomica', [ActividadEconomicaController::class, 'eliminarActividadEconomica']);
