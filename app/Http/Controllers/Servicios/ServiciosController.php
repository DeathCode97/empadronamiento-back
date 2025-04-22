<?php

namespace App\Http\Controllers\Servicios;

use App\ApiResponse as AppApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicios\Servicios;
use App\Models\Negocio\Negocio;
use Exception;
use PhpParser\Node\Expr\Cast\Array_;
use PhpParser\Node\Stmt\Return_;
use stdClass;
use Symfony\Component\VarDumper\VarDumper;

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


    public function obtenerServicios()
    {
        $response = null;
        try {
            $response = Servicios::obtenerServicios();
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function obtenerServiciosPorNegocio(Request $request){
        $response = null;
        try{
            $data = $request->validate([
                'folioNegocio' => 'required|integer'
            ]);
            $response = Negocio::obtenerServiciosPorNegocio($data);
            return $this->successResponse($response);
        }catch(Exception $ex){
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

    //FUNCION PARA REGRESAR LOS CHECKS MARCADOS Y NO MARCADOS
    public function serviciosAsignadosDesasignados(Request $request)
    {
        $response = null;
        $assigned = null;
        $serviciosAll = null;
        try {
            $datosValidados = $request->validate([
                'folioNegocio' => 'required|integer',
            ]);
            // Se obtienen servicios asignados
            $assigned = Negocio::obtenerServiciosPorNegocio($datosValidados); // manda a traer servicios asignados por id
            $serviciosAll = Servicios::obtenerServicios(); //manda a traer todos los servicios
            foreach ($assigned as $key => $obj) {
                // var_dump($obj->id_servicio);
                // unset($serviciosAll);
                foreach($serviciosAll as $keyx => $objx){
                    if($objx->id_servicio === $obj->id_servicio){
                        // echo  "key: " .$keyx ;
                        unset($serviciosAll[$keyx]);
                    }
                }
            }
            $serviciosAll = array_values($serviciosAll); //Aqui vienen los servicios que NO TIENE AGREGADO EL NEGOCIO

            foreach ($assigned as $key => $objeto) {
                array_push($serviciosAll, $objeto); //Aqui pusheamos los objetos que si tiene asignado
            }

            return  $this->successResponse($serviciosAll);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    //Funcion para traer las entidades y agrupar sus categorias y subcategorias para mostrar servicios.
    public function obtenerNodosEntidades()
    {
        $response = null;
        try {
            $response = Servicios::obtenerNodosEntidades();
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function obtenerServiciosTodos()
    {
        $response = null;
        try {
            $response["PROTECCION_CIVIL"] = Servicios::obtenerServiciosPC();
            $response["USO_SUELO"] = Servicios::obtenerServiciosUsodeSuelo();
            $response["BEBIDAS"] = Servicios::obtenerServiciosBebidasAlc();
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }


}
