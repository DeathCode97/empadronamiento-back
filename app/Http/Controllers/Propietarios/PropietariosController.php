<?php

namespace App\Http\Controllers\Propietarios;

use App\ApiResponse as AppApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Propietarios\Propietarios;
use App\Traits\ApiResponse;

class PropietariosController extends Controller
{

    use AppApiResponse;

    public function obtenerFecha(Request $request)
    {
        $response = null;
        try {
            $response = Propietarios::obtenerFecha();
            return [
                "SUCCESS" => true,
                "DATA" => $response,
                "MESSAGE" => "Obtenido con exito"
            ];
        } catch (\Exception $ex) {
            return [
                "SUCCESS" => false,
                "DATA" => $ex->getMessage(),
                "MESSAGE" => "Verficar el error y manejarlo correctamente..."
            ];
        }
    }

    public function insertarPropietarios(Request $request)
    {

        $response = null;
        try {

            $datosValidados = $request->validate([
                "nombre" => 'required|string|max:200',
                'numeroPropietario' => 'required|string|max:20'
            ]);

            Propietarios::insertarPropietarios($datosValidados);

            return $this->updateResponse("Insertado con exito");

        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
        // return "Hola Perro";
        // return $request->Apellido . " " . $request->nombre;

    }

    public function obtenerPropietarios(Request $request)
    {
        $response = null;
        try {

            // $datosValidados = $request->validate([
            //     'nombre' => 'required|string|max:200'
            // ]);
            $response = Propietarios::obtenerPropietarios();
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function editarPropietario(Request $request)
    {
        $response = null;
        try {

            $datosValidados = $request->validate([
                'nombrePropietario' => 'required|string|max:200',
                'numeroPropietario' => 'required|string|max:20',
                'idPropietario' => 'required|int'
            ]);

            Propietarios::editarPropietario($datosValidados);
            return $this->updateResponse();
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function eliminarPropietario(Request $request)
    {
        $response = null;
        try {

            $datosValidados = $request->validate([
                'idPropietario' => 'required|int'
            ]);

            Propietarios::eliminarPropietario($datosValidados);
            return $this->updateResponse("Eliminado con exito");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function obtenerNegociosPorPropietario(Request $request)
    {
        $response = null;
        try {

            $datosValidados = $request->validate([
                'idPropietario' => 'required|int'
            ]);

            $response = Propietarios::obtenerNegociosPorPropietario($datosValidados);
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }
}
