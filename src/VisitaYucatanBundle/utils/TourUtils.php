<?php
/**
 * User: ricardo
 * Date: 23/01/16
 */

namespace VisitaYucatanBundle\utils;
use Doctrine\Common\Collections\ArrayCollection;
use VisitaYucatanBundle\utils\to\ImagenTO;
use VisitaYucatanBundle\utils\to\TouridiomaTO;

class TourUtils {

    public static function convertEntityTouriomaToTouridiomaTO($tourEntity) {
        $tourIdioma = new TouridiomaTO();
        if(! is_null($tourIdioma)){
            $tourIdioma->setId($tourEntity->getId());
            $tourIdioma->setIdIdioma($tourEntity->getIdioma()->getId());
            $tourIdioma->setIdTour($tourEntity->getTour()->getId());
            $tourIdioma->setNombretour($tourEntity->getNombretour());
            $tourIdioma->setCircuito($tourEntity->getCircuito());
            $tourIdioma->setDescripcion($tourEntity->getDescripcion());
            $tourIdioma->setSoloadultos($tourEntity->getSoloadultos());
        }

        return $tourIdioma;
    }

    public static function getListImagenTO($imagesApp){
        $imageList = new ArrayCollection();
        if(count($imagesApp) > Generalkeys::NUMBER_ZERO){
            foreach($imagesApp as $imageApp)
            $image = new ImagenTO();
            $image->setId($imageApp->getId());
            $image->setIdTour($imageApp->getTour()->getId());
            $image->setNombreOriginal($imageApp->getNombreoriginal());
            $image->setNombre($imageApp->getNombre());
            $image->setPath($imageApp->getPath());
            $image->setTipoArchivo($imageApp->getTipoarchivo());
            $image->setPrincipal($imageApp->getPrincipal());

            $imageList->add($image);
        }
        return $imageList;

    }
}