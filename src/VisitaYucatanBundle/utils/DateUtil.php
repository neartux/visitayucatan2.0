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

    public static function summDaysToDate($date, $daysToSumm) {
        $dateXplode = explode("-", $date); // yyyy//mm/dd

        $newDate = getdate(mktime(0, 0, 0, $dateXplode[1], $dateXplode[2], $dateXplode[0]) + 24 * 60 * 60 * $daysToSumm);
        return self::stringToDate($newDate['mon'] . Generalkeys::STRING_DASH . $newDate['day'] . Generalkeys::STRING_DASH . $newDate['year']);
    }
}