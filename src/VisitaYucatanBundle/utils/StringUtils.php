<?php
/**
 * User: ricardo
 * Date: 18/02/16
 * Time: 10:12 PM
 */

namespace VisitaYucatanBundle\utils;


class StringUtils {

    public static function cutText($texto, $start, $limit, $colilla, $cierre){
        // Si la longitud del texto es menor a la del limite devuelve el texto completo
        if (strlen($texto) <= $limit){
            return $texto;
        }
        // corta el texto al limite pasado le concatena la colilla y el cierre de etiqueta
        $texto = substr($texto, $start, $limit).$colilla;
        return strip_tags($texto, $cierre);
    }

}