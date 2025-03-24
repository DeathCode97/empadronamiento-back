<?php

namespace App\Http\Controllers;
use App\Models\Negocio\Negocio;
use App\ApiResponse as AppApiResponse;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GeneradorQrController extends Controller
{
    use AppApiResponse;

    public function generarQr(Request $request)
    {
        $response = null;
        try {

            $datosValidados = $request->validate([
                'folio_negocio' => 'required|int',
            ]);
            $datosNegocio = Negocio::obtenerInformacionNegocio($datosValidados['folio_negocio']);

            $datosQr = [
                "FOLIO_NEGOCIO: " => $datosNegocio->folio_negocio,
                "NOMBRE NEGOCIO: " => $datosNegocio->nombre_negocio,
                "DIRECCION: " => $datosNegocio->direccion,
                "ES AMBULANTE: " => $datosNegocio->es_ambulante,
                "NUMERO TELEFONICO NEGOCIO: " => $datosNegocio->numero_telefonico_negocio,
                "FECHA DE REGISTRO" => $datosNegocio->fecha_registro,
                "PROPIETARIO" => $datosNegocio->nombre_propietario,
                "ACTIVIDAD ECONOMICA" => $datosNegocio->nombre_actividad,
                "GIRO" => $datosNegocio->nombre_giro
            ];

            $stringData = "
FOLIO NEGOCIO: $datosNegocio->folio_negocio,
NOMBRE NEGOCIO: $datosNegocio->nombre_negocio,
DIRECCION: $datosNegocio->direccion,
ES AMBULANTE: $datosNegocio->es_ambulante,
NUMERO TELEFONICO NEGOCIO: $datosNegocio->numero_telefonico_negocio,
FECHA DE REGISTRO: $datosNegocio->fecha_registro,
PROPIETARIO: $datosNegocio->nombre_propietario,
ACTIVIDAD ECONOMICA: $datosNegocio->nombre_actividad,
GIRO: $datosNegocio->nombre_giro
            ";
            // return trim($stringData);
            // $jsonDatosQr = json_encode($datosQr);
            $qr = QrCode::format('png')->size('250')->generate($stringData);
            $base64 = base64_encode($qr);
            return response()->json(['image' => 'data:image/png;base64,' . $base64]);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }
}

