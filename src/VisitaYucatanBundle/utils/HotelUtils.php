<?php
/**
 * User: ricardo
 * Date: 3/02/16
 */

namespace VisitaYucatanBundle\utils;

use Doctrine\Common\Collections\ArrayCollection;
use VisitaYucatanBundle\utils\to\ContractTO;
use VisitaYucatanBundle\utils\to\HabitacionTO;
use VisitaYucatanBundle\utils\to\HotelidiomaTO;
use VisitaYucatanBundle\utils\to\HotelTO;
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
        $contratoTO->setDescripcion($contrato->getDescripcion());
        $contratoTO->setIdHotel($contrato->getHotel()->getId());
        $contratoTO->setIdHotelPlan($contrato->getHotelPlan()->getId().'');
        $contratoTO->setIdEstatus($contrato->getEstatus()->getId());
        $contratoTO->setFechaInicio(date_format($contrato->getFechaInicio(), 'd/m/Y'));
        $contratoTO->setFechaFin(date_format($contrato->getFechaFin(), 'd/m/Y'));
        $contratoTO->setEdadMenor($contrato->getEdadMenor());
        $contratoTO->setAplicaImpuesto($contrato->getAplicaImpuesto());
        $contratoTO->setIsh($contrato->getIsh());
        $contratoTO->setMarkup($contrato->getMarkup());
        $contratoTO->setIva($contrato->getIva());
        $contratoTO->setFee($contrato->getFee());

        return $contratoTO;
    }

    public static function getHotelHabitacion($habitacion){
        $habitacionTO = new HabitacionTO();
        $habitacionTO->setId($habitacion->getId().'');
        $habitacionTO->setNombre($habitacion->getNombre());
        $habitacionTO->setDescripcion($habitacion->getDescripcion());
        $habitacionTO->setAllotment($habitacion->getAllotment());
        $habitacionTO->setMaximoMenores($habitacion->getMaximoMenores());
        $habitacionTO->setMaximoAdultos($habitacion->getMaximoAdultos());
        $habitacionTO->setCapacidadMaxima($habitacion->getCapacidadMaxima());

        return $habitacionTO;
    }

    public static function getHotelHabitacionIdioma($habitacion, $idHabitacion, $idIdioma){
        $habitacionIdioma = new HotelidiomaTO();

        if(! is_null($habitacion)){
            $habitacionIdioma->setId($habitacion->getHotelHabitacion()->getId().'');
            $habitacionIdioma->setIdIdioma($habitacion->getIdioma()->getId().'');
            $habitacionIdioma->setDescripcion($habitacion->getDescripcion());
        }else{
            $habitacionIdioma->setId($idHabitacion.'');
            $habitacionIdioma->setIdIdioma($idIdioma.'');
        }

        return $habitacionIdioma;
    }

    public static function getHotels($hotels){
        // Valida que existan tours
        if(count($hotels) >= Generalkeys::NUMBER_ONE){
            // Crea un array para colocar una coleccion de objetos HotelTO
            $hotelsColeccion = new ArrayCollection();
            // Itera los hoteles encontrados
            foreach($hotels as $hotel){
                // Se crea un nuevo objeto para colocal la informacion de cada uno de los hoteles como array
                $hotelTO = new HotelTO();

                //Se anexa la informacion
                $hotelTO->setId($hotel['id']);
                $hotelTO->setNombreHotel($hotel['nombrehotel']);
                $hotelTO->setDescripcion(StringUtils::cutText($hotel['descripcion'], Generalkeys::NUMBER_ZERO, Generalkeys::NUMBER_TWO_HUNDRED, Generalkeys::COLILLA_TEXT, Generalkeys::CIERRE_HTML_P));
                $hotelTO->setTarifa(ceil($hotel['tarifa']));
                $hotelTO->setSimboloMoneda($hotel['simbolo']);
                $hotelTO->setEstrellas($hotel['estrellas']);
                // Valida imagen hotel si es null coloca imagen not found de lo contrario coloca la imagen
                if(is_null($hotel['imagen'])){
                    $hotelTO->setPrincipalImage(Generalkeys::PATH_IMAGE_NOT_FOUND);
                }else{
                    $hotelTO->setPrincipalImage($hotel['imagen']);
                }

                //Se agrega el objeto a la coleccion
                $hotelsColeccion->add($hotelTO);
            }

            return $hotelsColeccion;
        }
    }
}