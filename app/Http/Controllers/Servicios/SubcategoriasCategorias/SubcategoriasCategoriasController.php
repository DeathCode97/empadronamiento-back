<?php

namespace App\Http\Controllers\Servicios\SubcategoriasCategorias;

use App\ApiResponse as AppApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicios\SubcategoriasCategorias\SubcategoriasCategorias;

class   SubcategoriasCategoriasController extends Controller
{
    use AppApiResponse;
    public function obtenerSubcategoriasCategorias(Request $request)
    {
        $response = null;
        try {
            $response = SubcategoriasCategorias::obtenerSubcategoriasCategorias();
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function agregarSubcategoriaCategoria(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'nombreSubcategoria' => 'required|string|max:200',
                'descripcionSubcategoria' => 'required|string|max:200',
                'categoriaId' => 'required|integer',
            ]);
            $response = SubcategoriasCategorias::agregarSubcategoriaCategoria($datosValidados);
            return $this->successResponse($response, "Insertado con exito");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function actualizarSubcategoriaCategoria(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'idSubcategoria' => 'required|integer',
                'nombreSubcategoria' => 'required|string|max:200',
                'descripcionSubcategoria' => 'required|string|max:200',
                'categoriaId' => 'required|integer',
            ]);
            SubcategoriasCategorias::actualizarSubcategoriaCategoria($datosValidados);
            return $this->successResponse(($response));
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function eliminarSubcategoriaCategoria(Request $request)
    {
        $response = null;
        try {
            $datosValidados = $request->validate([
                'idSubcategoria' => 'required|integer',
            ]);
            SubcategoriasCategorias::eliminarSubcategoriaCategoria($datosValidados);
            return $this->successResponse($response);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }
}
