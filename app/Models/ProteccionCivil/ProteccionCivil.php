<?php

namespace App\Models\ProteccionCivil;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PDO;

class ProteccionCivil extends Model
{
     use HasFactory;
    public static function insertarRevisionPc($args)
    {
        $db = DB::connection()->getPdo();
        // var_dump($args);
        // echo $args["nombre"];
        $query = "call insertar_revision_pc(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $statement = $db->prepare($query);
        $statement->execute([
            $args['idNegocio'],
            $args['calle'],
            $args['numero'],
            $args['colonia'],
            $args['municipio'],
            $args['metrajeFrente'],
            $args['metrajeLargo'],
            $args['metrajeTotal'],
            $args['tipoAnuncio'],
            $args['medidaFrenteAnuncio'],
            $args['medidaLargoAnuncio'],
            $args['metrajeAnuncioTotal'],
            $args['observacion1'],
            $args['observacion2'],
            $args['nombrePropietario'],
            $args['numeroPropietario'],
            $args['nombreNegocio']
        ]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function obtenerRevisonPcPorIdNegocio($args)
    {
        $db = DB::connection()->getPdo();
        // var_dump($args);
        // echo $args["nombre"];
        $query = "select * from obtener_revision_pc(?)";
        $statement = $db->prepare($query);
        $statement->execute([$args['idNegocio']]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }


}
