<?php
/**
 * User: ricardo
 * Date: 18/02/16
 * Time: 10:12 PM
 */

namespace VisitaYucatanBundle\utils;


class StringUtils {

    public static function cutText($texto, $start, $limit, $colilla, $cierre){
        $index=stripos($texto, '>');
        echo ("index adjfñasdkjfasdf = ".$index);
        //$texto=substr($texto, 0, $limit);
        $texto=substr($texto,$index, $limit);
        $texto.=$colilla;
        return $texto;

        // Si el texto a recortar es menor o igual al limite de recorte regresamos el texto completo sin cortar
        if(strlen($texto) <= $limit){
            return $texto;
        }
        // si pasa el numero de limit
        return substr($texto, $start, $limit).$colilla.$cierre;
    }

}