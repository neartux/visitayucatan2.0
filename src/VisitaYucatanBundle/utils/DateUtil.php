<?php
/**
 * User: ricardo
 * Date: 4/03/16
 * Time: 09:09 PM
 */

namespace VisitaYucatanBundle\utils;


class DateUtil
{
    // Metodo que convierte las fechas de formato dd/mm/yyyy a formato mm/dd/yyyy parametros en string return array con nuevos strings de fechas
    public static function getDates($fechaInicio, $fechaFin) {
        // dd/mm/yyyy
        $fechaInicioParts = explode('/', $fechaInicio);
        $fechaFinParts = explode('/', $fechaFin);

        // mm/dd/yyyy
        $newInicio = $fechaInicioParts[Generalkeys::NUMBER_ONE] . Generalkeys::STRING_SLASH . $fechaInicioParts[Generalkeys::NUMBER_ZERO] . Generalkeys::STRING_SLASH . $fechaInicioParts[Generalkeys::NUMBER_TWO];
        $newFin = $fechaFinParts[Generalkeys::NUMBER_ONE] . Generalkeys::STRING_SLASH . $fechaFinParts[Generalkeys::NUMBER_ZERO] . Generalkeys::STRING_SLASH . $fechaFinParts[Generalkeys::NUMBER_TWO];
        $fechas = Array();
        $fechas[Generalkeys::NUMBER_ZERO] = date(Generalkeys::PATTERN_DATE_MYSQL, strtotime($newInicio));
        $fechas[Generalkeys::NUMBER_ONE] = date(Generalkeys::PATTERN_DATE_MYSQL, strtotime($newFin));

        return $fechas;
    }

    public static function formatDate($fecha){
        // dd/mm/yyyy
        $fechaParts = explode('/', trim($fecha));

        // yyyy/mm/dd
        return $fechaParts[Generalkeys::NUMBER_TWO] . Generalkeys::STRING_DASH . $fechaParts[Generalkeys::NUMBER_ONE] . Generalkeys::STRING_DASH . $fechaParts[Generalkeys::NUMBER_ZERO];
    }

    public static function isSammeDate($fecha1, $fecha2) {
        if ($fecha1 == $fecha2) {
            return true;
        }
        return false;
    }

    public static function stringToDate($dateString) {
        //return date in format yyyy-mm-dd
        return date(Generalkeys::PATTERN_DATE_MYSQL, strtotime($dateString));
    }

    public static function summOneDayToDate($date) {
        return date ( Generalkeys::PATTERN_DATE_MYSQL , strtotime ( '+1 day' , strtotime ($date) ) );
    }
}