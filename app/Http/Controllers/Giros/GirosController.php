<?php

namespace App\Http\Controllers\Giros;

use App\ApiResponse as AppApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Giros\Giros;

class GirosController extends Controller
{
    use AppApiResponse;
    public function agregarGiro(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'nombreGiro' => 'required|string|max:200'
            ]);
            $response = Giros::agregarGiro($datosValidados);
            return $this->successResponse($response, "Insertado con exito");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function obtenerGiros(Request $request)
    {
        $response = null;
        try {
            $response = Giros::obtenerGiros();
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function actualizarGiro(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'idGiro' => 'required|integer',
                'nombreGiro' => 'required|string|max:200'
            ]);
            Giros::actualizarGiro($datosValidados);
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }
    public function eliminarGiro(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'idGiro' => 'required|integer',
            ]);
            Giros::eliminarGiro($datosValidados);
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }
}
