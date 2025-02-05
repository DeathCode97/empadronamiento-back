<?php

namespace App\Http\Controllers\Servicios;

use App\ApiResponse as AppApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicios\Servicios;

class ServiciosController extends Controller
{
    use AppApiResponse;
    public function agregarServicios(Request $request)
    {
        $response = null;
        try {

            $datosValidados = $request->validate([
                'nombreServicio' => 'required|string|max:200',
                'descripcionServicio' => 'required|string|max:200',
                'frecuenciaServicio' => 'required|string|max:200',
            ]);
            $response = Servicios::agregarServicios($datosValidados);
            return $this->successResponse($response, "Insertado con exito");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }


    public function obtenerServicios(Request $request)
    {
        $response = null;
        try {
            $response = Servicios::obtenerServicios();
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function actualizarServicios(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'id' => 'required|integer',
                'nombreServicio' => 'required|string|max:200',
                'descripcionServicio' => 'required|string|max:200',
                'frecuenciaServicio' => 'required|string|max:200',
            ]);
            Servicios::actualizarServicios($datosValidados);
            return $this->successResponse(($response));
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function eliminarServicios(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'id' => 'required|integer',
            ]);
            Servicios::eliminarServicios($datosValidados);
            return $this->successResponse(($response));
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }
}
