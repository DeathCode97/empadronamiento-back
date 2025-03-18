<?php

namespace App\Models\Servicios\SubcategoriasCategorias;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

class SubcategoriasCategorias extends Model
{
    public static function obtenerSubcategoriasCategorias()
    {
        $db = DB::connection()->getPdo();
        $query = "select * from obtener_subcategorias_categorias();";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public static function agregarSubcategoriaCategoria($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL insert_subcategoria_categoria(?,?,?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["nombreSubcategoria"],  $args["descripcionSubcategoria"], $args["categoriaId"]]);
    }

    public static function actualizarSubcategoriaCategoria($args)
    {
        $db = DB::connection()->getPdo();
        $query = "call actualizar_subcategoria_categoria(?, ?,?,?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["nombreSubcategoria"],  $args["descripcionSubcategoria"], $args["categoriaId"], $args["idSubcategoria"]]);
    }

    public static function eliminarSubcategoriaCategoria($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL eliminar_subcategoria_categoria(?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["idSubcategoria"]]);
    }
}
