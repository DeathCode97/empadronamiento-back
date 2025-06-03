<?php

namespace App\Http\Controllers\ProteccionCivil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ApiResponse as AppApiResponse;
use Exception;
use App\Models\ProteccionCivil\ProteccionCivil;

class ProteccionCivilController extends Controller
{
    use AppApiResponse;
    public function insertarRevisionPc(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                "idNegocio" => 'required | integer',
                "calle" => 'required|string | max:300',
                "numero" => 'required|integer',
                "colonia" => 'required|string|max:200',
                "municipio" => 'required|string|max:200',
                "metrajeFrente" => 'required|numeric',
                "metrajeLargo" => 'required|numeric',
                "metrajeTotal" => 'required|numeric',
            ]);

            $datosCompletos = array_merge($request->all(), $datosValidados);
            // return $datosCompletos;
            // Negocio::actualizarNegocio($datosValidados);
            ProteccionCivil::insertarRevisionPc($datosCompletos);
            return $this->updateResponse();
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function obtenerRevisonPcPorIdNegocio(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                "idNegocio" => 'required | integer'
            ]);

            $response = ProteccionCivil::obtenerRevisonPcPorIdNegocio($datosValidados);
            return $this->successResponse($response[0]);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

}
