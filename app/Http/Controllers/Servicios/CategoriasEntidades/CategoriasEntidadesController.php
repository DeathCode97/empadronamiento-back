<?php

namespace App\Http\Controllers\Servicios\CategoriasEntidades;

use App\ApiResponse as AppApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicios\CategoriasEntidades\CategoriasEntidades;

class CategoriasEntidadesController extends Controller
{
    use AppApiResponse;
    public function obtenerCategoriasEntidades(Request $request)
    {
        $response = null;
        try {
            $response = CategoriasEntidades::obtenerCategoriasEntidades();
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function agregarCategoriaEntidad(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'nombreCategoria' => 'required|string|max:200',
                'entidadId' => 'required|integer',
                'descripcionCategoria' => 'required|string|max:200',
            ]);
            $response = CategoriasEntidades::agregarCategoriaEntidad($datosValidados);
            return $this->successResponse($response, "Insertado con exito");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function actualizarCategoriaEntidad(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'idCategoria' => 'required|integer',
                'nombreCategoria' => 'required|string|max:200',
                'entidadId' => 'required|integer',
                'descripcionCategoria' => 'required|string|max:200',
            ]);
            CategoriasEntidades::actualizarCategoriaEntidad($datosValidados);
            return $this->successResponse(($response));
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function eliminarCategoriaEntidad(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'idCategoria' => 'required|integer',
            ]);
            CategoriasEntidades::eliminarCategoriaEntidad($datosValidados);
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }
}
