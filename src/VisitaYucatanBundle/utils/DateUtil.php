<?php
/**
 * User: ricardo
 * Date: 4/03/16
 * Time: 09:09 PM
 */

namespace VisitaYucatanBundle\utils;


class DateUtil {
    // Metodo que convierte las fechas de formato dd/mm/yyyy a formato mm/dd/yyyy parametros en string return array con nuevos strings de fechas
    public static function getDates($fechaInicio, $fechaFin) {
        // dd/mm/yyyy
        $fechaInicioParts = explode('/', $fechaInicio);
        $fechaFinParts = explode('/', $fechaFin);

        // mm/dd/yyyy
        $newInicio = $fechaInicioParts[Generalkeys::NUMBER_ONE] . Generalkeys::STRING_SLASH . $fechaInicioParts[Generalkeys::NUMBER_ZERO] . Generalkeys::STRING_SLASH . $fechaInicioParts[Generalkeys::NUMBER_TWO];
        $newFin = $fechaFinParts[Generalkeys::NUMBER_ONE] . Generalkeys::STRING_SLASH . $fechaFinParts[Generalkeys::NUMBER_ZERO] . Generalkeys::STRING_SLASH . $fechaFinParts[Generalkeys::NUMBER_TWO];
        $fechas = Array();
        $fechas[Generalkeys::NUMBER_ZERO] = $newInicio;
        $fechas[Generalkeys::NUMBER_ONE] = $newFin;

        return $fechas;
    }

    public static function isSammeDate($fecha1, $fecha2){
        $date1 = new \DateTime($fecha1);
        $date2 = new \DateTime($fecha2);

        if($date1 == $date2){
            return true;
        }
        return false;
    }

    public static function stringToDate($dateString) {
        return new \DateTime($dateString);
    }

    public static function summDaysToDate($date, $daysToSumm) {
        $dateXplode = explode("/", $date); // mm/dd/yyyy

        $newDate = getdate(mktime(0, 0, 0, $dateXplode[1], $dateXplode[2], $dateXplode[0]) + 24 * 60 * 60 * $daysToSumm);
        return $newDate['mon'] . Generalkeys::STRING_SLASH . $newDate['day'] . Generalkeys::STRING_SLASH . $newDate['year'];
    }
}