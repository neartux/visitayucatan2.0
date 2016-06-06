<?php

namespace VisitaYucatanBundle\Repository;
use Symfony\Component\Validator\Constraints\Date;
use VisitaYucatanBundle\Entity\HotelTarifa;
use VisitaYucatanBundle\utils\DateUtil;
use VisitaYucatanBundle\utils\Estatuskeys;
use VisitaYucatanBundle\utils\Generalkeys;

/**
 * HotelTarifaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class HotelTarifaRepository extends \Doctrine\ORM\EntityRepository {
    
    public function getRateByRooms($startDate, $endDate, $idHotel, $idIdioma, $idMoneda){
        $em = $this->getEntityManager();
        $sql = "SELECT hotel_habitacion.id AS idhabitacion,hotel_habitacion.allotment,hotel_habitacion.capacidadmaxima,hotel_habitacion.nombre,
                hotel_habitacion_idioma.descripcion,moneda.id AS moneda,moneda.simbolo AS simbolomoneda,moneda.tipo_cambio AS tipocambiomoneda,
                hotel_tarifa.fecha,(hotel_tarifa.sencillo/moneda.tipo_cambio) AS costosencillo,(hotel_tarifa.doble/moneda.tipo_cambio) AS costodoble,
                (hotel_tarifa.triple/moneda.tipo_cambio) AS costotriple,(hotel_tarifa.cuadruple/moneda.tipo_cambio) AS costocuadruple,
                hotel_contrato.id AS idcontrato,hotel_contrato.aplicaimpuesto,hotel_contrato.iva,hotel_contrato.ish,
                hotel_contrato.markup,hotel_contrato.fee
                FROM hotel_habitacion
                INNER JOIN hotel_contrato ON hotel_contrato.id_hotel = hotel_habitacion.id_hotel AND hotel_contrato.id_estatus = :estatusActivo
                INNER JOIN hotel_tarifa ON hotel_habitacion.id = hotel_tarifa.id_hotel_habitacion AND hotel_tarifa.id_hotel = :hotel AND hotel_tarifa.id_estatus = :estatusActivo
                INNER JOIN hotel_habitacion_idioma ON hotel_habitacion.id = hotel_habitacion_idioma.id_hotel_habitacion AND hotel_habitacion.id_estatus = :estatusActivo
                INNER JOIN idioma ON idioma.id = hotel_habitacion_idioma.id_idioma AND idioma.id = :idioma AND idioma.id_estatus = :estatusActivo
                INNER JOIN moneda ON moneda.id = :moneda AND moneda.id_estatus = :estatusActivo
                WHERE hotel_habitacion.id_hotel = :hotel AND hotel_habitacion.id_estatus = :estatusActivo
                AND hotel_habitacion.allotment > 0
                AND hotel_tarifa.fecha BETWEEN :startDate AND :endDate
                ORDER BY hotel_habitacion.id, hotel_tarifa.fecha ASC;";

        $params['estatusActivo'] = Estatuskeys::ESTATUS_ACTIVO;
        $params['hotel'] = $idHotel;
        $params['idioma'] = $idIdioma;
        $params['moneda'] = $idMoneda;
        $params['startDate'] = $startDate;
        $params['endDate'] = $endDate;

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function findDetailHotel($date, $idHotel, $idHabitacion, $idIdioma, $idMoneda){
        $em = $this->getEntityManager();
        $sql = "SELECT hotel_habitacion.id AS idhabitacion,hotel_habitacion.allotment,hotel_habitacion.capacidadmaxima,hotel_habitacion.nombre,
                hotel_habitacion_idioma.descripcion,moneda.id AS moneda,moneda.simbolo AS simbolomoneda,moneda.tipo_cambio AS tipocambiomoneda,
                hotel_tarifa.fecha,(hotel_tarifa.sencillo/moneda.tipo_cambio) AS costosencillo,(hotel_tarifa.doble/moneda.tipo_cambio) AS costodoble,
                (hotel_tarifa.triple/moneda.tipo_cambio) AS costotriple,(hotel_tarifa.cuadruple/moneda.tipo_cambio) AS costocuadruple,
                hotel_contrato.id AS idcontrato,hotel_contrato.aplicaimpuesto,hotel_contrato.iva,hotel_contrato.ish,hotel_contrato.markup,hotel_contrato.fee
                FROM hotel_habitacion
                INNER JOIN hotel_contrato ON hotel_contrato.id_hotel = hotel_habitacion.id_hotel AND hotel_contrato.id_estatus = :estatusActivo
                INNER JOIN hotel_tarifa ON hotel_habitacion.id = hotel_tarifa.id_hotel_habitacion AND hotel_tarifa.id_hotel = :hotel AND hotel_tarifa.id_estatus = :estatusActivo
                INNER JOIN hotel_habitacion_idioma ON hotel_habitacion.id = hotel_habitacion_idioma.id_hotel_habitacion AND hotel_habitacion.id_estatus = :estatusActivo
                INNER JOIN idioma ON idioma.id = hotel_habitacion_idioma.id_idioma AND idioma.id = :idioma AND idioma.id_estatus = :estatusActivo
                INNER JOIN moneda ON moneda.id = :moneda AND moneda.id_estatus = :estatusActivo
                WHERE hotel_habitacion.id_hotel = :hotel
                AND hotel_habitacion.id = :habitacion
                AND hotel_habitacion.id_estatus = :estatusActivo
                AND hotel_habitacion.allotment > 0
                AND hotel_tarifa.fecha = :fecha
                AND hotel_tarifa.id_hotel_habitacion = :habitacion";

        $params['estatusActivo'] = Estatuskeys::ESTATUS_ACTIVO;
        $params['hotel'] = $idHotel;
        $params['idioma'] = $idIdioma;
        $params['moneda'] = $idMoneda;
        $params['fecha'] = $date;
        $params['habitacion'] = $idHabitacion;

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }

    public function findRateByRangeDate($fechaInicio, $fechaFin, $idHotel, $idContrato, $idHabitacion){
        $em = $this->getEntityManager();
        $sql = "SELECT hotel_tarifa.*
                FROM hotel_tarifa
                WHERE hotel_tarifa.id_hotel_habitacion =  :habitacion
                AND hotel_tarifa.id_hotel_contrato = :contrato
                AND hotel_tarifa.id_hotel = :hotel
                AND hotel_tarifa.id_estatus = :estatus
                AND hotel_tarifa.fecha BETWEEN :fechaInicio AND :fechaFin";
        $params['habitacion'] = $idHabitacion;
        $params['contrato'] = $idContrato;
        $params['hotel'] = $idHotel;
        $params['estatus'] = Estatuskeys::ESTATUS_ACTIVO;
        $params['fechaInicio'] = $fechaInicio;
        $params['fechaFin'] = $fechaFin;
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function saveRate($tarifaTO){
        $em = $this->getEntityManager();
        $nextDate = true;
        // asigna primera fecha a guardar
        $fechaActual = $tarifaTO->getFechaInicio();
        // Elimina las tarifas en el rango de fechas seleccionadas
        $eliminado = $this->deleteRateByDates($tarifaTO->getIdContrato(), $tarifaTO->getIdHabitacion(), $tarifaTO->getIdHotel(), $tarifaTO->getFechaInicio(), $tarifaTO->getFechaFin());
        // Si se eliminaron los registro procede a guardar los nuevos
        if($eliminado){
            // Mientras no se llege a la fecha final se crean o modifican los registros
            while($nextDate){
                // Crea la fecha con la informacion capturada
                $this->createRateHotel($tarifaTO->getIdContrato(), $tarifaTO->getIdHabitacion(), $tarifaTO->getIdHotel(), $fechaActual,
                    $tarifaTO->getSencillo(), $tarifaTO->getDoble(), $tarifaTO->getTriple(), $tarifaTO->getCuadruple());
                // Si la fecha actual es la misma a la fecha final sale del ciclo, termina
                if(DateUtil::isSammeDate($fechaActual, $tarifaTO->getFechaFin())){
                    $nextDate = false;
                }else{ // Si no es igual le suma un dia a la fecha actual
                    $fechaActual = DateUtil::summOneDayToDate($fechaActual);
                }
            }
        }
    }

    public function deleteRateByDates($contrato, $habitacion, $hotel, $fechaInicio, $fechaFin){
        $sql = "DELETE FROM hotel_tarifa WHERE hotel_tarifa.id_hotel_contrato = :contrato AND hotel_tarifa.id_hotel_habitacion = :habitacion AND hotel_tarifa.id_hotel = :hotel
                AND hotel_tarifa.fecha BETWEEN :fechaInicio AND :fechaFin";
        $params = array('contrato'=> $contrato, 'habitacion'=> $habitacion, 'hotel' => $hotel, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin);

        $em = $this->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        return $stmt->execute($params);
    }

    public function createRateHotel($contrato, $habitacion, $hotel, $fecha, $sencillo, $doble, $triple, $cuadruple){
        $sql = "INSERT INTO hotel_tarifa (id, id_hotel, id_hotel_contrato, id_hotel_habitacion, id_estatus, fecha, sencillo, doble, triple, cuadruple)
                VALUES (null, :hotel, :contrato, :habitacion, :estatus, :fecha, :sencillo, :doble, :triple, :cuadruple)";
        $params = array('hotel'=> $hotel, 'contrato'=> $contrato, 'habitacion' => $habitacion, 'estatus' => Estatuskeys::ESTATUS_ACTIVO,
            'fecha' => $fecha, 'sencillo' => $sencillo, 'doble' => $doble, 'triple' => $triple, 'cuadruple' => $cuadruple);

        $em = $this->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
    }

}
