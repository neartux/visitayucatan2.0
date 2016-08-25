<?php
/**
 * User: ricardo
 * Date: 4/03/16
 * Time: 09:09 PM
 */

namespace VisitaYucatanBundle\utils;


class DateUtil {

    private static $month = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
    private static $months = ["", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

    public static function getMonth($numberMonth) {
        return self::$month[$numberMonth];
    }

    public static function getFullNameMonth($numMonth){
        return self::$months[(int)$numMonth];
    }

    public static function getDateReserveRoom($date) {
        $month = self::getNumberMonth($date);
        $nameMonth = self::getMonth((int)$month - Generalkeys::NUMBER_ONE);
        return self::getDayFromDate($date)." ".$nameMonth;
    }
    
    public static function getNumberMonth($date) {
        // yyyy-mm-dd
        $dateParts = explode("-", $date);
        return $dateParts[Generalkeys::NUMBER_ONE];
    }

    public static function getDayFromDate($date) {
        $dateParts = explode("-", $date);
        return $dateParts[Generalkeys::NUMBER_TWO];
    }

    public static function diffDays($fechaInicio, $fechaFin){
        $isLastDate = false;
        $numDays = Generalkeys::NUMBER_ZERO;
        while(! $isLastDate){
            $numDays ++;
            if(self::isSammeDate($fechaInicio, $fechaFin)){
                $isLastDate = true;
            }else{
                $fechaInicio = self::summOneDayToDate($fechaInicio);
            }
        }

        return $numDays;
    }

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

    public static function summDayToDate($date, $dias){
        return date ( Generalkeys::PATTERN_DATE_MYSQL , strtotime ( '+'.$dias.' day' , strtotime ($date) ) );
    }

    public static function Now(){
        return date('Y-m-d');
    }

    public static function formatDateToString($fecha){
        // yyyy-mm-dd
        $fechaParts = explode('-', trim($fecha));

        // dd/mm/yyyy
        return $fechaParts[Generalkeys::NUMBER_TWO] . Generalkeys::STRING_SLASH . $fechaParts[Generalkeys::NUMBER_ONE] . Generalkeys::STRING_SLASH . $fechaParts[Generalkeys::NUMBER_ZERO];
    }

    public static function formatDateMysql($fecha){
        // dd/mm/yyyy
        $fechaParts = explode('/', trim($fecha));
        // yyyy-mm-dd
        return $fechaParts[Generalkeys::NUMBER_TWO] . Generalkeys::STRING_DASH . $fechaParts[Generalkeys::NUMBER_ONE] . Generalkeys::STRING_DASH . $fechaParts[Generalkeys::NUMBER_ZERO];
    }
}