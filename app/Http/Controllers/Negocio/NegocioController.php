<?php

namespace App\Http\Controllers\Negocio;

use App\ApiResponse as AppApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Negocio\Negocio;
use Exception;
use PhpParser\Node\Stmt\Echo_;

class NegocioController extends Controller
{
    use AppApiResponse;
    public function agregarNegocio(Request $request)
    {
        // $response = null;
        try {
            // Validamos entradas
            $datosValidados = $request->validate([
                'nombreNegocio' => 'required| string  | max: 200',
		        'direccion' => 'required| string | max: 200',
		        'esAmbulante' => 'required| boolean ',
		        'idPropietario' => 'required| integer',
		        'actividadEconomica' => 'required|integer',
		        'numeroTelefonicoNegocio' => 'required|string|max: 20 ',
		        'vendeAlcohol' => 'required|boolean',
		        'tienePublicidad' => 'required| boolean'
            ]);

            // Mandamos la informacion del negocio a insertar, y regresamos el id_negocio con el que fue insertado
            $responseInsertar = Negocio::agregarNegocio($datosValidados);

            // Seteamos el id a $idNegocio
            $idNegocio = $responseInsertar[0]->insert_negocios;

            // var_dump($request["servicios"][0]);
            // Validamos que la request tenga la propiedad servicios
            if(isset($request["servicios"])){
                // echo " tiene array, osea inserta servicios ";
                // Recorremos el array de servicios asignados.
                foreach ($request["servicios"] as $key) {
                    // var_dump($key);
                    if($key){
                        // echo($key);
                        Negocio::insertarServiciosNegocio($idNegocio, $key);
                    }
                }
            }else{
                Negocio::insertarServiciosNegocio($idNegocio, 69);
            }
            return $this->updateResponse("Insertado con exito", 200);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function actualizarServiciosDeNegocio(Request $request)
    {
        try{
            $idNegocio = $request['idNegocio'];
            if(isset($response['servicios'])){
                foreach ($request["servicios"] as $key) {
                    // var_dump($key);
                    if($key){
                        // echo($key);
                        Negocio::insertarServiciosNegocio($idNegocio, $key);
                    }
                }
                return $this->updateResponse("Insertado con exito", 200);
            }else{
                Negocio::insertarServiciosNegocio($idNegocio, 69);
            }
            return $this->updateResponse("Insertado con exito", 200);
        }catch(Exception $ex){
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
