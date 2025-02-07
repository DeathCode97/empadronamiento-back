<?php

namespace App\Models\HistorialPagos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

class HistorialPagos extends Model
{
    public static function generarHistorialPagos($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL insert_historial_pagos(?,now(), ?, ?, ?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["cost"], $args["nextPayment"], $args["idNegocio"], $args["idServicio"]]);
    }

    public static function obtenerHistorialPagos()
    {
        $db = DB::connection()->getPdo();
        $query = "SELECT * FROM obtener_historial_pagos();";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function actualizarHistorialPagos($args)
    {
        $db = DB::connection()->getPdo();
        //         $query = "update historialpagos set costo = ?, fecha_pago = now(), siguiente_pago = ?, folio_negocio = ?, 
        // id_servicio = ? where folio_pago = ?;";
        $query = "CALL actualizar_historial_pagos(?,now(), ?, ?, ?, ?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["cost"], $args["nextPayment"], $args["idNegocio"], $args["idServicio"], $args["id"]]);
    }

    public static function eliminarHistorialPagos($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL eliminar_historial_pagos(?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["id"]]);
    }
}
