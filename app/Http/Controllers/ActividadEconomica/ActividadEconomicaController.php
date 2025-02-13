<?php

namespace App\Http\Controllers\ActividadEconomica;

use App\ApiResponse as AppApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActividadEconomica\ActividadEconomica;

class ActividadEconomicaController extends Controller
{
    use AppApiResponse;

    public function insertarActividadEconomica(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'sectorName' => 'required|string|max:200',
                'fromGiroId' => 'required|integer'
            ]);
            $response = ActividadEconomica::insertarActividadEconomica($datosValidados);
            return $this->successResponse($response, "Insertado con exito");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function obtenerActividadEconomica(Request $request)
    {
        $response = null;
        try {
            $response = ActividadEconomica::obtenerActividadEconomica();
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function actualizarActividadEconomica(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'sectorName' => 'required|string|max:200',
                'fromGiroId' => 'required|integer',
                'id' => 'required|integer'
            ]);
            ActividadEconomica::actualizarActividadEconomica($datosValidados);
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function eliminarActividadEconomica(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'id' => 'required|integer',
            ]);
            ActividadEconomica::eliminarActividadEconomica($datosValidados);
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }
}
