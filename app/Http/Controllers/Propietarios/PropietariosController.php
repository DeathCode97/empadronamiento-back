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

    // public function insertarPropietarios(Request $request)
    // {
    //     $response = null;
    //     try {

    //         $datosValidados = $request->validate([
    //             'nombre' => 'required|string|max:200'
    //         ]);
    //         $response = Propietarios::insertarPropietarios($datosValidados);
    //         return $this->successResponse($response);
    //     } catch (\Exception $ex) {
    //         return $this->errorResponse($ex->getMessage(), 500);
    //     }
    // }

    public function insertarPropietarios(Request $request)
    {

        $response = null;
        try {

            $datosValidados = $request->validate([
                "nombre" => 'required|string|max:200'
            ]);

            $response = Propietarios::insertarPropietarios($datosValidados);

            return $this->successResponse($response, "Insertado con exito");

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

}
