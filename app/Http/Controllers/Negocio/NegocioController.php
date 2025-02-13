<?php

namespace App\Http\Controllers\Negocio;

use App\ApiResponse as AppApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Negocio\Negocio;


class NegocioController extends Controller
{
    use AppApiResponse;
    public function agregarNegocio(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'nombreNegocio' => 'required|string|max:200',
                'direccion' => 'required|string|max:200',
                'esAmbulante' => 'required|boolean',
                'idPropietario' => 'required|integer',
                'actividadEconomica' => 'required|integer',
                'numeroTelefonico' => 'required|string|max:10'
            ]);
            $response = Negocio::agregarNegocio($datosValidados);
            return $this->successResponse($response, "Insertado con exito");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function obtenerNegocio(Request $request)
    {
        $response = null;
        try {
            $response = Negocio::obtenerNegocio();
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function actualizarNegocio(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'id' => 'required|integer',
                'nombreNegocio' => 'required|string|max:200',
                'direccion' => 'required|string|max:200',
                'esAmbulante' => 'required|boolean',
                'idPropietario' => 'required|integer',
                'actividadEconomica' => 'required|integer',
                'numeroTelefonico' => 'required|string|max:10'
            ]);
            Negocio::actualizarNegocio($datosValidados);
            return $this->successResponse(($response));
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function eliminarNegocio(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'id' => 'required|integer',
            ]);
            Negocio::eliminarNegocio($datosValidados);
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function obtenerNegociosConPropietarios(Request $request)
    {
        $response = null;
        try {
            $response = Negocio::obtenerNegociosConPropietarios();
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function obtenerServiciosPorNegocio(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'folioNegocio' => 'required|integer',
            ]);
            $response = Negocio::obtenerServiciosPorNegocio($datosValidados);
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function obtenerActividadesEconomicas(Request $request)
    {
        $response = null;
        try {
            // $datosValidados = $request->validate([
            //     'idPropietario' => 'required|integer',
            // ]);
            $response = Negocio::obtenerActividadesEconomicas();
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function updateNegocio(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                // 'id' => 'required|integer',
                'nombreNegocio' => 'required|string|max:200',
                'direccion' => 'required|string|max:200',
                'esAmbulante' => 'required|boolean',
                'idPropietario' => 'required|integer',
                'actividadEconomica' => 'required|integer',
                'numeroTelefonicoNegocio' => 'required|string|max:20',
                'idNegocio' => 'required|integer'
            ]);
            Negocio::updateNegocio($datosValidados);
            return $this->successResponse(($response));
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }
}
