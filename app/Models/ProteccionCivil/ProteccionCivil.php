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
        $query = "call insertar_revision_pc(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
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
            $args['nombreNegocio'],
            $args['vendeAlcohol'],
            $args['tieneAnuncio'],
            $args['tipoLicenciaAlcohol']
        ]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function obtenerRevisonPcPorIdNegocio($args)
    {
        $db = DB::connection()->getPdo();
        // var_dump($args);
        // echo $args["nombre"];
        $query = "select*from revision_proteccion_civil where folio_negocio = ? and revision_activa = true";
        $statement = $db->prepare($query);
        $statement->execute([$args['idNegocio']]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function actualizarRevisionPc($args)
    {
        $db = DB::connection()->getPdo();
        $query = "update revision_proteccion_civil set
                    calle = ?,
                    numero = ?,
                    colonia = ?,
                    municipio = ?,
                    metraje_frente = ?,
                    metraje_largo = ?,
                    metraje_total = ?,
                    tipo_anuncio = ?,
                    medida_frente_anuncio = ?,
                    medida_largo_anuncio = ?,
                    metraje_anuncio_total = ?,
                    observacion1 = ?,
                    observacion2 = ?,
                    folio_negocio = ?,
                    vende_alcohol = ?,
                    tiene_publicidad = ?,
                    tipo_licencia_alcohol = ?";
        $statement = $db->prepare($query);
        $statement->execute([
            $args["calle_pc"],
            $args["numero_pc"],
            $args["colonia_pc"],
            $args["municipio_pc"],
            $args["metraje_frente_pc"],
            $args["metraje_largo_pc"],
            $args["metraje_total_pc"],
            $args["tipo_anuncio_pc"],
            $args["medida_frente_anuncio_pc"],
            $args["medida_largo_anuncio_pc"],
            $args["metraje_anuncio_total_pc"],
            $args["observacion1_pc"],
            $args["observacion2_pc"],
            $args["folio_negocio_pc"],
            $args["vende_alcohol_pc"],
            $args["tiene_publicidad_pc"],
            $args["tipo_licencia_alcohol_pc"],
        ]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function autorizarRevisionPc($args)
    {
        $db = DB::connection()->getPdo();
        // var_dump($args);
        // echo $args["nombre"];
        $query = "CALL autorizar_revision_pc(?)";
        $statement = $db->prepare($query);
        $statement->execute([$args['idNegocio']]);
        // return $statement->fetchAll(PDO::FETCH_OBJ);
    }

}
