<?php
/**
 * User: ricardo
 * Date: 21/03/16
 * Time: 11:41 AM
 */

namespace VisitaYucatanBundle\utils;


use Doctrine\Common\Collections\ArrayCollection;
use VisitaYucatanBundle\utils\to\PaqueteTO;
use VisitaYucatanBundle\utils\to\PaqueteidiomaTO;

class PaqueteUtils {

    public static function convertEntityPaqueteiomaToPaqueteidiomaTO($paqueteEntity) {
        $paqueteIdioma = new PaqueteidiomaTO();
        if(! is_null($paqueteEntity)){
            $paqueteIdioma->setId($paqueteEntity->getId());
            $paqueteIdioma->setIdIdioma($paqueteEntity->getIdioma()->getId());
            $paqueteIdioma->setIdPaquete($paqueteEntity->getPaquete()->getId());
            $paqueteIdioma->setDescripcion($paqueteEntity->getDescripcion());
            //$paqueteIdioma->setCircuito($paqueteEntity->getCircuito());
            $paqueteIdioma->setDescripcionLarga($paqueteEntity->getDescripcionLarga());
            //$paqueteIdioma->setSoloadultos($paqueteEntity->getSoloadultos());
        }

        return $paqueteIdioma;
    }

    public static function convertArrayPaqueteToArrayPaqueteTO($paquetes){
        $paquetesTO = new ArrayCollection();

        if(count($paquetes) > Generalkeys::NUMBER_ZERO){

            foreach($paquetes as $paquete){
                $paqueteTO = new PaqueteTO();

                $paqueteTO->setId($paquete['id']);
                $paqueteTO->setNombrePaquete($paquete['nombrepaquete']);
                $paqueteTO->setCircuito($paquete['circuito']);
                $paqueteTO->setDescripcionCorta($paquete['descripcioncorta']);
                $paqueteTO->setDescripcionLarga($paquete['descripcionlarga']);
                $paqueteTO->setIncluye($paquete['incluye']);
                $paqueteTO->setSimboloMoneda($paquete['simbolo']);
                $paqueteTO->setCostoSencilla(number_format($paquete['sencilla']));
                if(is_null($paquete['imagen'])){
                    $paqueteTO->setPrincipalImage(Generalkeys::PATH_IMAGE_NOT_FOUND);
                }else{
                    $paqueteTO->setPrincipalImage($paquete['imagen']);
                }

                $paquetesTO->add($paqueteTO);
            }
        }

        return $paquetesTO;
    }

}