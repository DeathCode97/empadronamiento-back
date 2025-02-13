<?php

namespace App\Models\ActividadEconomica;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;


class ActividadEconomica extends Model
{
    public static function insertarActividadEconomica($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL insert_sector(?,?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["sectorName"], $args["fromGiroId"]]);
    }

    public static function obtenerActividadEconomica()
    {
        $db = DB::connection()->getPdo();
        $query = "SELECT * FROM obtener_actividad_economica();";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }


    public static function actualizarActividadEconomica($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL actualizar_actividad_economica(?,?,?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["sectorName"], $args["fromGiroId"], $args["id"]]);
    }

    public static function eliminarActividadEconomica($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL eliminar_actividad_economica(?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["id"]]);
    }
}
