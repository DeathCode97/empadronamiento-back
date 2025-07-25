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
        $query = "SELECT * FROM notificaciones where para = ? and visto = FALSE order by fecha_notificacion asc;";
        $statement = $db->prepare($query);
        $statement->execute([$args["usuario"]]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function vistearNorificacion($args)
    {
        $db = DB::connection()->getPdo();
        $query = "update notificaciones set visto = true where id_notification = ?";
        $statement = $db->prepare($query);
        $statement->execute([$args["folioNotificacion"]]);
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
