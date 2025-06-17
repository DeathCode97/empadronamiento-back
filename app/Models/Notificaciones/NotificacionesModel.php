<?php

namespace App\Models\Notificaciones;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificacionesModel extends Model
{
     use HasFactory;

    public static function consultarNotificacionesPorUsuario($args)
    {
        $db = DB::connection()->getPdo();
        $query = "SELECT * FROM notificaciones where para = ?;";
        $statement = $db->prepare($query);
        $statement->execute($args["usuario"]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function consultarNotificacionPorUsuario($args)
    {
        $db = DB::connection()->getPdo();
        $query = "SELECT info AS label FROM notificaciones where para = ?;";
        $statement = $db->prepare($query);
        $statement->execute([$args["usuario"]]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function insertarNotificacionHacienda()
    {
        $db = DB::connection()->getPdo();
        $query = "select now();";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
}
