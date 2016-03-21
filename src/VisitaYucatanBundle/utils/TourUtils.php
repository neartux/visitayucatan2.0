<?php
/**
 * User: ricardo
 * Date: 23/01/16
 */

namespace VisitaYucatanBundle\utils;
use Doctrine\Common\Collections\ArrayCollection;
use VisitaYucatanBundle\utils\to\ImagenTO;
use VisitaYucatanBundle\utils\to\TouridiomaTO;
use VisitaYucatanBundle\utils\to\TourTO;

class TourUtils {

    public static function convertEntityTouriomaToTouridiomaTO($tourEntity) {
        $tourIdioma = new TouridiomaTO();
        if(! is_null($tourEntity)){
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
            foreach($imagesApp as $imageApp){
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
        }
        return $imageList;

    }

    public static function getTours($tours){
        // Valida que existan tours
        if(count($tours) >= Generalkeys::NUMBER_ONE){
            // Crea un array para colocar una coleccion de objetos TourTO
            $toursColeccion = new ArrayCollection();
            // Itera los tours encontrados
            foreach($tours as $tour){
                // Se crea un nuevo objeto para colocal la informacion de cada uno de los tours como array
                $tourTO = new TourTO();

                //Se anexa la invformacion
                $tourTO->setId($tour['id']);
                $tourTO->setNombreTour($tour['nombre']);
                $tourTO->setCircuito($tour['circuito']);
                $tourTO->setDescripcionTour(StringUtils::cutText($tour['descripcion'], Generalkeys::NUMBER_ZERO, Generalkeys::NUMBER_TWO_HUNDRED, Generalkeys::COLILLA_TEXT, Generalkeys::CIERRE_HTML_P));
                $tourTO->setTarifaadulto(number_format(ceil($tour['tarifaadulto'])));
                $tourTO->setTarifamenor(number_format(ceil($tour['tarifamenor'])));
                $tourTO->setSimboloMoneda($tour['simbolomoneda']);
                // Valida imagen tour si es null coloca imagen not found de lo contrario coloca la imagen
                if(is_null($tour['imagen'])){
                    $tourTO->setPrincipalImage(Generalkeys::PATH_IMAGE_NOT_FOUND);
                }else{
                    $tourTO->setPrincipalImage($tour['imagen']);
                }

                //Se agrega el objeto a la coleccion
                $toursColeccion->add($tourTO);
            }

            return $toursColeccion;
        }
    }

    public static function getTourTO($tour, $imagesTour){
        // Se crea un nuevo objeto para colocal la informacion de cada uno de los tours como array
        $tourTO = new TourTO();

        //Se anexa la invformacion
        $tourTO->setId($tour['id']);
        $tourTO->setNombreTour($tour['nombre']);
        $tourTO->setCircuito($tour['circuito']);
        $tourTO->setDescripcionTour($tour['descripcion']);
        $tourTO->setTarifaadulto(ceil($tour['tarifaadulto']));
        $tourTO->setTarifamenor(ceil($tour['tarifamenor']));
        $tourTO->setSimboloMoneda($tour['simbolomoneda']);
        $tourTO->setSoloAdultos($tour['soloadultos']);
        $tourTO->setMinimopersonas($tour['minimopersonas']);
        $tourTO->setOrigen($tour['origen']);
        // Valida imagen tour si es null coloca imagen not found de lo contrario coloca la imagen
        if(is_null($tour['imagen'])){
            $tourTO->setPrincipalImage(Generalkeys::PATH_IMAGE_NOT_FOUND);
        }else{
            $tourTO->setPrincipalImage($tour['imagen']);
        }

        // si tienes imagens el tour las colocal
        if(count($imagesTour) > Generalkeys::NUMBER_ZERO){
            $tourTO->setImagesTour($imagesTour);
        }

        return $tourTO;
    }
}