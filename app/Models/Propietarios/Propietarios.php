<?php

namespace App\Models\Propietarios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use PDO;

class Propietarios extends Model
{
    use HasFactory;

    public static function obtenerFecha()
    {
        $db = DB::connection()->getPdo();
        $query = "select now();";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function insertarPropietarios($args)
    {
        $db = DB::connection()->getPdo();
        // var_dump($args);
        // echo $args["nombre"];
        $query = "CALL insertar_nuevo_propietario(?, ?)";
        $statement = $db->prepare($query);
        $statement->execute([$args["nombre"], $args["numeroPropietario"]]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }


    public static function obtenerPropietarios()
    {
        $db = DB::connection()->getPdo();
        // var_dump($args);
        // echo $args["nombre"];
        $query = "SELECT * FROM obtener_propietarios();";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function editarPropietario($args)
    {
        $db = DB::connection()->getPdo();
        $query = "call editar_propietario(?, ?, ?)";
        $statement = $db->prepare($query);
        $statement->execute([$args["nombrePropietario"], $args["numeroPropietario"], $args["idPropietario"]]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function eliminarPropietario($args)
    {
        $db = DB::connection()->getPdo();
        $query = "call eliminar_propietario(?)";
        $statement = $db->prepare($query);
        $statement->execute([$args["idPropietario"]]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function obtenerNegociosPorPropietario($args)
    {
        $db = DB::connection()->getPdo();
        // var_dump($args["idPropietario"]);
        $query = "SELECT * FROM obtener_negocios_por_propietario(:idprop)";
        $statement = $db->prepare($query);
        $statement->bindParam(':idprop', $args["idPropietario"], PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
}


