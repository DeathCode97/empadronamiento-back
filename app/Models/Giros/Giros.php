<?php

namespace App\Models\Giros;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

class Giros extends Model
{
    public static function agregarGiro($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL insert_giro(?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["nombreGiro"]]);
    }

    public static function obtenerGiros()
    {
        $db = DB::connection()->getPdo();
        $query = "SELECT * FROM obtener_giros();";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function actualizarGiro($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL actualizar_giro(?,?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["nombreGiro"], $args["idGiro"]]);
    }

    public static function eliminarGiro($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL eliminar_giro(?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["idGiro"]]);
    }
}
