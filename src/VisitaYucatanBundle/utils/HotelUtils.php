<?php
/**
 * User: ricardo
 * Date: 3/02/16
 */

namespace VisitaYucatanBundle\utils;

use Doctrine\Common\Collections\ArrayCollection;
use VisitaYucatanBundle\utils\to\ContractTO;
use VisitaYucatanBundle\utils\to\HotelidiomaTO;
use VisitaYucatanBundle\utils\to\ImagenTO;

class HotelUtils {

    public static function convertEntityHotelIdiomaToHotelidiomaTO($hotelEntity) {
        $hotelIdioma = new HotelidiomaTO();
        if(! is_null($hotelEntity)){
            $hotelIdioma->setId($hotelEntity->getId());
            $hotelIdioma->setIdIdioma($hotelEntity->getIdioma()->getId());
            $hotelIdioma->setIdHotel($hotelEntity->getHotel()->getId());
            $hotelIdioma->setNombreHotel($hotelEntity->getNombrehotel());
            $hotelIdioma->setDescripcion($hotelEntity->getDescripcion());
        }

        return $hotelIdioma;
    }

    public static function getListImagenTO($imagesApp){
        $imageList = new ArrayCollection();
        if(count($imagesApp) > Generalkeys::NUMBER_ZERO){
            foreach($imagesApp as $imageApp){
                $image = new ImagenTO();
                $image->setId($imageApp->getId());
                $image->setIdHotel($imageApp->getHotel()->getId());
                $image->setNombreOriginal($imageApp->getNombreoriginal());
                $image->setNombre($imageApp->getNombre());
                $image->setPath($imageApp->getPath());
                $image->setTipoArchivo($imageApp->getTipoarchivo());
                $image->setPrincipal($imageApp->getPrincipal());

                $imageList->add($image);
            }
        }
        return $imageList;

    }

    public static function getHotelContract($contrato){
        $contratoTO = new ContractTO();
        $contratoTO->setId($contrato->getId());
        $contratoTO->setIdHotel($contrato->getHotel()->getId());
        $contratoTO->setIdHotelPlan($contrato->getHotelPlan()->getId());
        $contratoTO->setIdEstatus($contrato->getEstatus()->getId());
        $contratoTO->setFechaInicio($contrato->getFechaInicio());
        $contratoTO->setFechaFin($contrato->getFechaFin());
        $contratoTO->setEdadMenor($contrato->getEdadMenor());
        $contratoTO->setAplicaImpuesto($contrato->getAplicaImpuesto());
        $contratoTO->setIsh($contrato->getIsh());
        $contratoTO->setMarkup($contrato->getMarkup());
        $contratoTO->setIva($contrato->getIva());
        $contratoTO->setFee($contrato->getFee());

        return $contratoTO;
    }
}