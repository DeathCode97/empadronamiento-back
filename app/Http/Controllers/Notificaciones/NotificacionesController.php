<?php

namespace App\Http\Controllers\Notificaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ApiResponse as AppApiResponse;
use App\Models\Notificaciones\NotificacionesModel;
use App\Events\NewDataInserted;


class NotificacionesController extends Controller
{
    use AppApiResponse;



    public function consultarNotificacionesPorUsuario(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'usuario' => 'required|string|max:10'
            ]);
            $response = NotificacionesModel::consultarNotificacionPorUsuario($datosValidados);
            // $response = ActividadEconomica::insertarActividadEconomica($datosValidados);
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function insertarNotificacionHacienda(Request $request)
    {
        $response = null;
        try {
            $data = ["Nombre" => "Diego", "Apellido" => "Ronquillo" ];
            broadcast(new NewDataInserted($data));
            return response()->json($data);
            // $datosValidados = $request->validate([
            //     "idNegocio" => 'required | integer',
            //     "calle" => 'required|string | max:300',
            //     "numero" => 'required|integer',
            //     "colonia" => 'required|string|max:200',
            //     "municipio" => 'required|string|max:200',
            //     "metrajeFrente" => 'required|numeric',
            //     "metrajeLargo" => 'required|numeric',
            //     "metrajeTotal" => 'required|numeric',
            // ]);

            // $datosCompletos = array_merge($request->all(), $datosValidados);
            // return $datosCompletos;
            // Negocio::actualizarNegocio($datosValidados);
            // ProteccionCivil::insertarRevisionPc($datosCompletos);
            // return $this->updateResponse();
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }
}
