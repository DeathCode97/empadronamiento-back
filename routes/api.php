<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Propietarios\PropietariosController;
use App\Http\Controllers\Servicios\ServiciosController;
use App\Http\Controllers\Negocio\NegocioController;
use App\Http\Controllers\HistorialPagos\HistorialPagosController;
use App\Http\Controllers\Giros\GirosController;
use App\Http\Controllers\ActividadEconomica\ActividadEconomicaController;
use App\Http\Controllers\Servicios\Entidades\EntidadesController;
use App\Http\Controllers\Servicios\CategoriasEntidades\CategoriasEntidadesController;
use App\Http\Controllers\Servicios\SubcategoriasCategorias\SubcategoriasCategoriasController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\SanctumJWTMiddleware;
use App\Http\Controllers\GeneradorQrController;
use App\Http\Controllers\ProteccionCivil\ProteccionCivilController;
use App\Http\Controllers\Notificaciones\NotificacionesController;


Route::post('login', [AuthController::class, 'login']);
Route::post('example', [AuthController::class, 'example']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);

Route::post('/vistearNorificacion', [NotificacionesController::class, 'vistearNorificacion']);

Route::post('/insertarNotificacionHacienda', [NotificacionesController::class, 'insertarNotificacionHacienda']);

Route::post('/consultarNotificacionesPorUsuario', [NotificacionesController::class, 'consultarNotificacionesPorUsuario']);

Route::post('/eliminarNegocio', [NegocioController::class, 'eliminarNegocioById']);


Route::middleware(['middleware'])->group(function(){
    Route::post('/autorizarRevisionPc', [ProteccionCivilController::class, 'autorizarRevisionPc']);
    Route::post('/insertarRevisionPc', [ProteccionCivilController::class, 'insertarRevisionPc']);
    Route::post('/actualizarRevisionPc', [ProteccionCivilController::class, 'actualizarRevisionPc']);
    Route::post('/obtenerRevisonPcPorIdNegocio', [ProteccionCivilController::class, 'obtenerRevisonPcPorIdNegocio']);
    Route::post('/obtenerPropietarios', [PropietariosController::class, 'obtenerPropietarios']);

    Route::post('/registrarPagoNegocio', [NegocioController::class, 'registrarPagoNegocio']);


    Route::post('/consultarNotificacionPorUsuario', [NotificacionesController::class, 'consultarNotificacionPorUsuario']);

    Route::post('/agregarNegocio', [NegocioController::class, 'agregarNegocio']);
    // Route::post('/insertarRevisionPc', [ProteccionCivilController::class, 'insertarRevisionPc']);


    Route::post('/generarQr', [GeneradorQrController::class, 'generarQr']);

    Route::post('/insertarPropietarios', [PropietariosController::class, 'insertarPropietarios']);
    Route::post('/obtenerNegocioPropietario', [PropietariosController::class, 'obtenerNegocioPropietario']);
    // GENERADOR

    Route::post('/obtenerPropietariosYNegos', [PropietariosController::class, 'obtenerPropietariosYNegos']);

    // --------------------------
    // Route::post('/obtenerPropietarios', [PropietariosController::class, 'obtenerPropietarios']);

    Route::post('/editarPropietario', [PropietariosController::class, 'editarPropietario']);

    Route::post('/eliminarPropietarioSoft', [PropietariosController::class, 'eliminarPropietarioSoft']);

    Route::post('/obtenerNegociosPorPropietario', [PropietariosController::class, 'obtenerNegociosPorPropietario']);

    // Servicios asignados y des asignados
    Route::post('/serviciosAsignadosDesasignados', [ServiciosController::class, 'serviciosAsignadosDesasignados']);


    //ruta de agregar servicios
    Route::post('/agregarServicios', [ServiciosController::class, 'agregarServicios']);

    //ruta de obtener servicios
    Route::post('/obtenerServicios', [ServiciosController::class, 'obtenerServicios']);

    //ruta para actualizar servicios
    Route::post('/actualizarServicios', [ServiciosController::class, 'actualizarServicios']);

    //ruta para eliminar servicios
    Route::post('/eliminarServicios', [ServiciosController::class, 'eliminarServicios']);

    // Actividad Economica - dropdown negocio
    Route::post('/obtenerActividadesEconomicas', [NegocioController::class, 'obtenerActividadesEconomicas']);

    // OBTENER NODOS DE ENTIDADES
    Route::post('/obtenerNodosEntidades', [ServiciosController::class, 'obtenerNodosEntidades']);

    //OBTENER SOLO LOS SERVICIOS
    Route::post('/obtenerServiciosTodos', [ServiciosController::class, 'obtenerServiciosTodos']);

    //Negocio

    //ruta para agregarNegocio



    Route::post('/obtenerInformacionNegocioQR', [NegocioController::class, 'obtenerInformacionNegocioQR']);

    //ruta para obtenerNegocio

    Route::post('/obtenerNegocio', [NegocioController::class, 'obtenerNegocio']);

    //ruta para actualizarNegocio

    Route::post('/actualizarNegocio', [NegocioController::class, 'actualizarNegocio']);

    // Actualizar negocio Diego

    Route::post('/updateNegocio', [NegocioController::class, 'updateNegocio']);

    //ruta para eliminarNegocio

    // Route::post('/eliminarNegocio', [NegocioController::class, 'eliminarNegocio']);

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

    //obtener entidades

    Route::post('/obtenerEntidades', [EntidadesController::class, 'obtenerEntidades']);


    //agregar entidad

    Route::post('/agregarEntidad', [EntidadesController::class, 'agregarEntidad']);


    //actualizar entidad

    Route::post('/actualizarEntidad', [EntidadesController::class, 'actualizarEntidad']);


    //eliminar entidad

    Route::post('/eliminarEntidad', [EntidadesController::class, 'eliminarEntidad']);


    //obtener categorias_entidades

    Route::post('/obtenerCategoriasEntidades', [CategoriasEntidadesController::class, 'obtenerCategoriasEntidades']);

    //agregar categorias_entidades


    Route::post('/agregarCategoriaEntidad', [CategoriasEntidadesController::class, 'agregarCategoriaEntidad']);

    //actualizar categorias_entidades

    Route::post('/actualizarCategoriaEntidad', [CategoriasEntidadesController::class, 'actualizarCategoriaEntidad']);

    //eliminar categorias_entidades

    Route::post('/eliminarCategoriaEntidad', [CategoriasEntidadesController::class, 'eliminarCategoriaEntidad']);


    //obtener subcategorias_categorias

    Route::post('/obtenerSubcategoriasCategorias', [SubcategoriasCategoriasController::class, 'obtenerSubcategoriasCategorias']);


    //agregar subcategorias_categorias

    Route::post('/agregarSubcategoriaCategoria', [SubcategoriasCategoriasController::class, 'agregarSubcategoriaCategoria']);


    //actualizar subcategorias_categorias

    Route::post('/actualizarSubcategoriaCategoria', [SubcategoriasCategoriasController::class, 'actualizarSubcategoriaCategoria']);


    //eliminar subcategorias_categorias

    Route::post('/eliminarSubcategoriaCategoria', [SubcategoriasCategoriasController::class, 'eliminarSubcategoriaCategoria']);
    Route::get('/obtenerFecha', [PropietariosController::class, 'obtenerFecha']);
});


// Esta es la ruta
