<?php

namespace App\Models\Servicios\CategoriasEntidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

class CategoriasEntidades extends Model
{
    public static function obtenerCategoriasEntidades()
    {
        $db = DB::connection()->getPdo();
        $query = "select * from obtener_categorias_entidades();";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function agregarCategoriaEntidad($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL insert_categoria_entidad(?,?,?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["nombreCategoria"], $args["entidadId"], $args["descripcionCategoria"]]);
    }

    public static function actualizarCategoriaEntidad($args)
    {
        $db = DB::connection()->getPdo();
        $query = "call actualizar_categoria_entidad(?, ?,?,?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["nombreCategoria"], $args["entidadId"], $args["descripcionCategoria"], $args["idCategoria"]]);
    }
    public static function eliminarCategoriaEntidad($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL eliminar_categoria_entidad(?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["idCategoria"]]);
    }
}
