<?php

namespace App\Http\Controllers\Servicios\Entidades;

use App\ApiResponse as AppApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicios\Entidades\Entidades;

class EntidadesController extends Controller
{
    use AppApiResponse;
    public function obtenerEntidades(Request $request)
    {
        $response = null;
        try {
            $response = Entidades::obtenerEntidades();
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function agregarEntidad(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'nombreEntidad' => 'required|string|max:200',
                'descripcionEntidad' => 'required|string|max:200',
            ]);
            $response = Entidades::agregarEntidad($datosValidados);
            return $this->successResponse($response, "Insertado con exito");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }


    public function actualizarEntidad(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'idEntidad' => 'required|integer',
                'nombreEntidad' => 'required|string|max:200',
                'descripcionEntidad' => 'required|string|max:200',
            ]);
            Entidades::actualizarEntidad($datosValidados);
            return $this->successResponse(($response));
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function eliminarEntidad(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'idEntidad' => 'required|integer',
            ]);
            Entidades::eliminarEntidad($datosValidados);
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }
}
