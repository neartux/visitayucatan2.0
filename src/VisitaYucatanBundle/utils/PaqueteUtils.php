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
use VisitaYucatanBundle\utils\to\PaquetecombinacionhotelTO;

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
            $paqueteIdioma->setItinerario($paqueteEntity->getItinerario());
            $paqueteIdioma->setDias($paqueteEntity->getDias());
            $paqueteIdioma->setIncluye($paqueteEntity->getIncluye());
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
                //$paqueteTO->setDescripcionLarga($paquete['descripcionlarga']);
                $paqueteTO->setDescripcionLarga(StringUtils::cutText($paquete['descripcionlarga'], Generalkeys::NUMBER_ZERO, Generalkeys::NUMBER_TWO_HUNDRED, Generalkeys::COLILLA_TEXT, Generalkeys::CIERRE_HTML_P));
                $paqueteTO->setIncluye($paquete['incluye']);
                $paqueteTO->setSimboloMoneda($paquete['simbolo']);
                $paqueteTO->setCostoSencilla(number_format($paquete['sencilla']));
                $paqueteTO->setCostoDoble(number_format($paquete['doble']));
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

    public static function getListPaqueteCombinacionTO($paqueteCombinacion){
        $paqueteCombiList = new ArrayCollection();
        //print_r($paqueteCombinacion);
        if(count($paqueteCombinacion)>Generalkeys::NUMBER_ZERO){
            foreach ($paqueteCombinacion as $pc) {
                $paqCombi = new PaquetecombinacionhotelTO();
                $paqCombi->setId($pc['id']);
                $paqCombi->setIdEstatus($pc['id_estatus']);
                $paqCombi->setIdHotel($pc['id_hotel']);
                $paqCombi->setIdPaquete($pc['id_paquete']);
                $paqCombi->setNomhotel($pc['nomhotel']);
                $paqCombi->setNoches($pc['noches']);
                $paqCombi->setDias($pc['dias']);
                $paqCombi->setCostoSencillo($pc['costosencillo']);
                $paqCombi->setCostoDoble($pc['costodoble']);
                $paqCombi->setCostoTriple($pc['costotriple']);
                $paqCombi->setCostoCuadruple($pc['costocuadruple']);
                $paqCombi->setCostoMenor($pc['costomenor']);
                $paqueteCombiList->add($paqCombi);
            }
        }

        return $paqueteCombiList;
    }

    public static function getPaqueteTO($paquete, $imagesPaquete,$combinacionesPaquete){
        // Se crea un nuevo objeto para colocal la informacion de cada uno de los tours como array
        $paqueteTO = new PaqueteTO();

        //Se anexa la invformacion
        $paqueteTO->setId($paquete['id']);
        $paqueteTO->setNombrePaquete($paquete['nombre']);
        $paqueteTO->setCircuito($paquete['circuito']);
        $paqueteTO->setDescripcionCorta($paquete['descripcioncorta']);
        $paqueteTO->setDescripcionLarga($paquete['descripcionlarga']);
        $paqueteTO->setCircuito($paquete['circuito']);
        $paqueteTO->setItinerario($paquete['itinerario']);
        $paqueteTO->setIncluye($paquete['incluye']);
        $paqueteTO->setCircuito($paquete['circuito']);
        $paqueteTO->setSimboloMoneda($paquete['simbolo']);
        $paqueteTO->setDias($paquete['dias']);
        $paqueteTO->setNoches((int)$paquete['dias']- Generalkeys::NUMBER_ONE);
        $paqueteTO->setIdIdioma($paquete['ididioma']);
        $paqueteTO->setIdMoneda($paquete['idmoneda']);

        // Valida imagen tour si es null coloca imagen not found de lo contrario coloca la imagen
        if(is_null($paquete['imagen'])){
            $paqueteTO->setPrincipalImage(Generalkeys::PATH_IMAGE_NOT_FOUND);
        }else{
            $paqueteTO->setPrincipalImage($paquete['imagen']);
        }

        // si tienes imagens el paquete las colocal

        if(count($imagesPaquete) > Generalkeys::NUMBER_ZERO){
            
            $paqueteTO->setImagesPaquete($imagesPaquete);
        }
        
        if(count($combinacionesPaquete) > Generalkeys::NUMBER_ZERO){
            
            $paqueteTO->setCombinacionesPaquete(self::mangerCombinacionesPaquetes($combinacionesPaquete));

        }

        return $paqueteTO;
    }
    
    public static function mangerCombinacionesPaquetes($combinaciones){
        $combinacionesArray = new ArrayCollection();
        $imagenes = new ArrayCollection();
        if (count($combinaciones) > Generalkeys::NUMBER_ZERO){
            $idHotel = $combinaciones[0]['id_hotel'];
            $comTmp = null;
            $cont = 0;
            foreach ($combinaciones as $combinacion) {
                $cont++;
                if ((int)$combinacion['id_hotel'] == $idHotel){
                    $comTmp = $combinacion;
                    $imagenes->add($combinacion['path']);
                } else {
                    $comTmp["imageneshotel"] = $imagenes->getValues();
                    $combinacionesArray->add($comTmp);
                    $imagenes = new ArrayCollection();
                    $comTmp = $combinacion;
                    $imagenes->add($combinacion['path']);
                }
                $idHotel = $combinacion['id_hotel'];
                if (count($combinaciones) == $cont){
                    $comTmp["imageneshotel"] = $imagenes->getValues();
                    $combinacionesArray->add($comTmp);
                }
            }
        }

        return $combinacionesArray->getValues();
    }
}