<?php

namespace App\Models\Servicios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

class Servicios extends Model
{
    public static function agregarServicios($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL insert_servicio(?,?,?)";
        $statement = $db->prepare($query);
        $statement->execute([$args["nombreServicio"], $args["descripcionServicio"], $args["frecuenciaServicio"]]);
    }

    public static function obtenerServicios()
    {
        $db = DB::connection()->getPdo();
        $query = "SELECT * FROM obtener_servicios();";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function actualizarServicios($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL actualizar_servicio(?,?,?,?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["nombreServicio"], $args["descripcionServicio"], $args["frecuenciaServicio"], $args["id"]]);
    }
    public static function eliminarServicios($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL eliminar_servicio(?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["id"]]);
    }
}
