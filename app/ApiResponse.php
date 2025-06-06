<?php

namespace App;

trait ApiResponse
{
    protected function successResponse($data, $message = 'Exito!', $statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    // Respuesta de error
    protected function errorResponse($message, $statusCode = 500, $data = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    protected function updateResponse($message = 'Actualizado con exito...', $statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message
        ], $statusCode);
    }
}

// Hola perrota diego
