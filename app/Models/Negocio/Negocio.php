<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

class Negocio extends Model
{
    public static function agregarNegocio($args)
    {
        $db = DB::connection()->getPdo();
        $query = "select insert_negocios(?,?,?,?,?,?,?,?);";
        $statement = $db->prepare($query);
        $statement->execute([
            $args["nombreNegocio"],
            $args["direccion"],
            $args["esAmbulante"],
            $args["idPropietario"],
            $args["actividadEconomica"],
            $args["numeroTelefonicoNegocio"],
            $args["vendeAlcohol"],
            $args["tienePublicidad"]
        ]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function agregarNegocioAmbulante($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL insertar_negocios_ambulantes(?,?,?,?,?,?,?,?,?,?);";
        $statement = $db->prepare($query);
        $statement->execute([
            $args["nombreNegocio"],
            $args["direccion"],
            $args["esAmbulante"],
            $args["idPropietario"],
            $args["actividadEconomica"],
            $args["numeroTelefonicoNegocio"],
            $args["vendeAlcohol"],
            $args["tienePublicidad"],
            $args["tipoPago"],
            $args["cuotaDePago"]
        ]);
    }

    public static function obtenerInformacionNegocioQR($args)
    {
        $db = DB::connection()->getPdo();
        $query = "
            select
	            n.folio_negocio,
	            n.nombre_negocio,
	            n.direccion,
	            n.es_ambulante,
	            n.numero_telefonico_negocio,
	            n.fecha_registro ,
	            n.tipo_pago,
	            n.cuota_ambulantaje,
	            n.revision_proteccion_civil,
	            n.es_negocio_nuevo,
	            n.fecha_pago_servicios,
	            p.nombre_propietario,
	            p.numero_telefonico,
	            ae.nombre_actividad,
	            g.nombre_giro
            from negocio n
	            inner join propietarios p on n.propietario = p.folio_propietario
	            inner join actividad_economica ae on n.actividad_economica = ae.id_actividad
	            inner join giros g on ae.pertenece_giro = g.id_giro
            where n.folio_negocio = ?;";
        $statement = $db->prepare($query);
        $statement->execute([
            $args["folioNegocio"],
        ]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function insertarServiciosNegocio($idNegocio, $idServicio)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL insert_negocios_servicios(?, ?)";
        $statement = $db->prepare($query);
        $statement->execute([$idNegocio, $idServicio]);
        // return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function obtenerNegocio()
    {
        $db = DB::connection()->getPdo();
        $query = "SELECT * FROM obtener_negocio();";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    /*     public static function actualizarNegocio($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL actualizar_negocio(:nombreNegocio,:direccion,:esAmbulante,:idPropietario,:actividadEconomica,:numeroTelefonico,:id);";
        $statement = $db->prepare($query);
        //        $statement->execute([$args["nombreNegocio"], $args["giroComercial"], $args["direccion"], $args["esAmbulante"], $args["idPropietario"], $args["id"]]);

        $statement->execute(
            [
                "nombreNegocio" => $args["nombreNegocio"],
                "direccion" => $args["direccion"],
                "esAmbulante" => $args["esAmbulante"],
                "idPropietario" => $args["idPropietario"],
                "actividadEconomica" => $args["actividadEconomica"],
                "numeroTelefonico" => $args["numeroTelefonico"],
                "id" => $args["id"]
            ]
        );
    } */

    public static function actualizarNegocio($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL actualizar_negocio(?,?,?,now(),?,?,?,?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["nombreNegocio"], $args["direccion"], $args["esAmbulante"], $args["idPropietario"], $args["actividadEconomica"], $args["numeroTelefonico"], $args["id"]]);
    }

    public static function eliminarNegocio($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL eliminar_negocio(?);";
        $statement = $db->prepare($query);
        $statement->execute([$args["id"]]);
    }

    public static function obtenerNegociosConPropietarios()
    {
        $db = DB::connection()->getPdo();
        $query = "select * from obtener_negocio_con_propietario()";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function eliminarNegocioById($args)
    {
        $db = DB::connection()->getPdo();
        $query = "call eliminar_negocio_by_id(?)";
        $statement = $db->prepare($query);
        $statement->execute([$args["folioNegocio"]]);
        // return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function pagarCuotaNegocio($args)
    {
        $db = DB::connection()->getPdo();
        $query = "call registrar_pago_negocio(?)";
        $statement = $db->prepare($query);
        $statement->execute([$args["folioNegocio"]]);
        // return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function obtenerInformacionNegocio($folio_negocio)
    {
        $db = DB::connection()->getPdo();
        $query = "select * from obtener_info_negocio(?);";
        $statement = $db->prepare($query);
        $statement->execute([$folio_negocio]);
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public static function obtenerServiciosPorNegocio($args)
    {
        $db = DB::connection()->getPdo();
        $query = "select * from obtener_servicios_por_negocio(?)";
        $statement = $db->prepare($query);
        $statement->execute([$args["folioNegocio"]]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function obtenerActividadesEconomicas()
    {
        $db = DB::connection()->getPdo();
        $query = "select*from obtener_actividades_economicas()";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function updateNegocio($args)
    {
        $db = DB::connection()->getPdo();
        $query = "CALL actualizar_negocio(:nombreNegocio, :direccion, :esAmbulante, :idPropietario, :actividadEconomica, :numeroNegocio, :idNegocio);";
        $statement = $db->prepare($query);
        /*         $statement->execute([$args["nombreNegocio"], $args["giroComercial"], $args["direccion"], $args["esAmbulante"], $args["idPropietario"], $args["id"]]); */
        $statement->execute(
            [
                "nombreNegocio" => $args["nombreNegocio"],
                "direccion" => $args["direccion"],
                "esAmbulante" => $args["esAmbulante"],
                "idPropietario" => $args["idPropietario"],
                "actividadEconomica" => $args["actividadEconomica"],
                "numeroNegocio" => $args["numeroTelefonicoNegocio"],
                "idNegocio" => $args["idNegocio"],

            ]
        );
    }

    public static function eliminarNegocioPorId()
    {
        $db = DB::connection()->getPdo();
        $query = "";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

}
