<?php

namespace App\Models\Servicios\Entidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

class Entidades extends Model
{
    public static function obtenerEntidades()
    {
        $db = DB::connection()->getPdo();
        $query = "select * from obtener_entidades();";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function agregarEntidad($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL insert_entidad(?,?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["nombreEntidad"], $args["descripcionEntidad"]]);
    }

    public static function actualizarEntidad($args)
    {
        $db = DB::connection()->getPdo();
        $query = "call actualizar_entidad(?, ?,?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["nombreEntidad"], $args["descripcionEntidad"], $args["idEntidad"]]);
    }

    public static function eliminarEntidad($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL eliminar_entidad(?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["idEntidad"]]);
    }
}
