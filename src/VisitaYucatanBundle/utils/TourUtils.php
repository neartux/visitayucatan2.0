<?php
/**
 * User: ricardo
 * Date: 23/01/16
 */

namespace VisitaYucatanBundle\utils;
use VisitaYucatanBundle\utils\to\TouridiomaTO;

class TourUtils {

    public static function convertEntityTouriomaToTouridiomaTO($tourEntity) {
        $tourIdioma = new TouridiomaTO();
        $tourIdioma->setId($tourEntity->getId());
        $tourIdioma->setIdIdioma($tourEntity->getIdioma()->getId());
        $tourIdioma->setIdTour($tourEntity->getTour()->getId());
        $tourIdioma->setNombretour($tourEntity->getNombretour());
        $tourIdioma->setCircuito($tourEntity->getCircuito());
        $tourIdioma->setDescripcion($tourEntity->getDescripcion());
        $tourIdioma->setSoloadultos($tourEntity->getSoloadultos());

        return $tourIdioma;
    }
}