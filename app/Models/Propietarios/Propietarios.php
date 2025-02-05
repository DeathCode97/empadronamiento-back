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
        $query = "CALL insertar_nuevo_propietario(?)";
        $statement = $db->prepare($query);
        $statement->execute([$args["nombre"]]);
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
}

