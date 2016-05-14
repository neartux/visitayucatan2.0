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
use VisitaYucatanBundle\utils\to\PaqueteimagenTO;
use VisitaYucatanBundle\utils\to\HotelTO;

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
    public static function getListImagenTO($imagesApp){
        $imageList = new ArrayCollection();
        if(count($imagesApp) > Generalkeys::NUMBER_ZERO){
            foreach($imagesApp as $imageApp){
                $image = new PaqueteimagenTO();
                $image->setId($imageApp->getId());
                $image->setIdPaquete($imageApp->getPaquete()->getId());
                $image->setNombreOriginal($imageApp->getNombreOriginal());
                $image->setNombre($imageApp->getNombre());
                $image->setPath($imageApp->getPath());
                $image->setTipoArchivo($imageApp->getTipoArchivo());
                $image->setPrincipal($imageApp->getPrincipal());
                $image->setFolio($imageApp->getFolio());
                $image->setFechaCreacion($imageApp->getFechaCreacion());
                $imageList->add($image);
            }
        }
        return $imageList;

    }

    public static function getListHotelesTO($hoteles){
        $hotelesList = new ArrayCollection();
        if(count($hoteles)>Generalkeys::NUMBER_ZERO){
            foreach ($hoteles as $h) {
                $hotls = new HotelTO();
                $hotls->setId($h['id']);
                $hotls->setIdEstatus($h['id_estatus']);
                $hotls->setIdDestino($h['id_destino']);
                $hotls->setDescripcion($h['descripcion']);
                $hotls->setEstrellas($h['estrellas']);
                $hotls->setPromovido($h['promovido']);
                $hotelesList->add($hotls);
            }
        }

        return $hotelesList;
    }

}