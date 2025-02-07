<?php

namespace App\Http\Controllers\HistorialPagos;

use App\ApiResponse as AppApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistorialPagos\HistorialPagos;

class HistorialPagosController extends Controller
{
    use AppApiResponse;
    public function generarHistorialPagos(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'cost' => 'required|numeric',
                'nextPayment' => 'required|date',
                'idNegocio' => 'required|integer',
                'idServicio' => 'required|integer'
            ]);
            $response = HistorialPagos::generarHistorialPagos($datosValidados);
            return $this->successResponse($response, "Insertado con exito");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function obtenerHistorialPagos(Request $request)
    {
        $response = null;
        try {

            $response = HistorialPagos::obtenerHistorialPagos();
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function actualizarHistorialPagos(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'id' => 'required|integer',
                'cost' => 'required|numeric',
                'nextPayment' => 'required|date',
                'idNegocio' => 'required|integer',
                'idServicio' => 'required|integer'
            ]);
            HistorialPagos::actualizarHistorialPagos($datosValidados);
            return $this->successResponse(($response));
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function eliminarHistorialPagos(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'id' => 'required|integer',
            ]);
            HistorialPagos::eliminarHistorialPagos($datosValidados);
            return $this->successResponse(($response));
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }
}
