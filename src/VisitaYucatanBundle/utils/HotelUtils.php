<?php
/**
 * User: ricardo
 * Date: 3/02/16
 */

namespace VisitaYucatanBundle\utils;

use Doctrine\Common\Collections\ArrayCollection;
use Proxies\__CG__\VisitaYucatanBundle\Entity\Hotel;
use VisitaYucatanBundle\utils\to\ContractTO;
use VisitaYucatanBundle\utils\to\HabitacionTO;
use VisitaYucatanBundle\utils\to\HotelidiomaTO;
use VisitaYucatanBundle\utils\to\HotelTarifaTO;
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

    public static function getHotels($hotels) {
        // Crea un array para colocar una coleccion de objetos HotelTO
        $hotelsColeccion = new ArrayCollection();

        // Valida que existan hoteles
        if(count($hotels) >= Generalkeys::NUMBER_ONE){
            // Itera los hoteles encontrados
            foreach($hotels as $hotel){
                // Se crea un nuevo objeto para colocal la informacion de cada uno de los hoteles como array
                $hotelTO = new HotelTO();

                //Se anexa la informacion
                $hotelTO->setId($hotel['id']);
                $hotelTO->setNombreHotel($hotel['nombrehotel']);
                $hotelTO->setDescripcion(StringUtils::cutText($hotel['descripcion'], Generalkeys::NUMBER_ZERO, Generalkeys::NUMBER_TWO_HUNDRED, Generalkeys::COLILLA_TEXT, Generalkeys::CIERRE_HTML_P));
                $hotelTO->setTarifa(number_format(ceil($hotel['tarifa'])));
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
        }
        return $hotelsColeccion;
    }

    public static function getArrayClosingDates($fechasCierre){
        $closingDate = new ArrayCollection();
        // Trato la información si tiene fechas
        if (count($fechasCierre) > Generalkeys::NUMBER_ZERO){

            foreach($fechasCierre as $fecha){
                $fechaInicio = $fecha['fechainicio'];
                $fechaFin = $fecha['fechafin'];
                $isLastDate = false;

                while(! $isLastDate){

                    $closingDate->add($fechaInicio);

                    if(DateUtil::isSammeDate($fechaInicio, $fechaFin)){
                        $isLastDate = true;
                    }else{
                        $fechaInicio = DateUtil::summOneDayToDate($fechaInicio);
                    }
                }
            }
        }

        return $closingDate;
    }


    // TODO pendiente , aun hay duda de como manejar las tarifas de las habitaciones, va a ser una lista de habitaciones con otra lista de tarifas
    public static function getCotizationRoom($roomsCosts, $numAdults, $numMinors, $fechasCierre, Hotel $hotel){
        $finaliCost = new ArrayCollection();
        if (count($roomsCosts) > Generalkeys::NUMBER_ZERO){
            // Variable para sumar costo de todos los dias de habitacion
            $grandTotal = Generalkeys::NUMBER_ZERO;
            // Obtiene el array de las fechas cierre
            $closingDates = self::getArrayClosingDates($fechasCierre);
            // Array temporal de costos por habitaciones
            $dateCostTmp = new ArrayCollection();
            // Variable para habitacion tmp
            $idRoomTmp = Generalkeys::NUMBER_ZERO;
            // Para contar los registros
            $cont = Generalkeys::NUMBER_ZERO;
            //
            $habitacionTO = new HabitacionTO();
            // Itera las fechas y sus costos
            foreach ($roomsCosts as $cost) {
                $nameRoom = $cost["nombre"];
                $descriptionRoom = $cost["descripcion"];
                // Convierte el registro en objeto
                $tarifaTO = self::getDetailCost($cost);
                
                // si es el primer registro 
                if ($idRoomTmp == Generalkeys::NUMBER_ZERO) {
                    $habitacionTO->setNombre($nameRoom);
                    $habitacionTO->setDescripcion($descriptionRoom);
                }
                // si es cambio de habitacion y la lista de fechas costos no esta vacia
                if ($idRoomTmp != $tarifaTO->getIdHabitacion() && ! $dateCostTmp->isEmpty()){
                    // agrega las fechas a la habitacion
                    $habitacionTO->setHotelTarifasTOCollection($dateCostTmp);
                    
                    $habitacionTO = new HabitacionTO();
                    $habitacionTO->setNombre($nameRoom);
                    $habitacionTO->setDescripcion($descriptionRoom);
                }

                if($closingDates->contains($tarifaTO->getFecha()) || $tarifaTO->getAllotment() == Generalkeys::NUMBER_ZERO) {
                    // La fecha no esta disponible
                    $tarifaTO->setIsAvailable(Generalkeys::BOOLEAN_FALSE);
                    // Coloca mensaje de no disponible
                    $tarifaTO->setMsjAvailable(Generalkeys::NOT_AVAILABLE_MSJ);
                    // Agrega obj a lista
                    $dateCostTmp->add($tarifaTO);
                    continue;
                }
                // si esta disponible la fecha
                $tarifaTO->setIsAvailable(Generalkeys::BOOLEAN_TRUE);
                // calcula numero de habitaciones a ocupar
                $numRooms = ceil(($numAdults + $numMinors) / $tarifaTO->getCapacidadMaxima());

                // Si la habitacion es uno TODO aqui es la parte a mejorar cuando sean mas de una habitacion requerida
                if($numRooms == Generalkeys::NUMBER_ONE) {
                    // Obtiene el costo de la habitacion
                    $rate = self::getRateByPersons($numAdults, $tarifaTO->getSencillo(), $tarifaTO->getDoble(), $tarifaTO->getTriple(), $tarifaTO->getCuadruple());
                    // Calcula impuestos y suma a gran total
                    $grandTotal += self::getTotalRate($rate, $tarifaTO->getIsh(), $tarifaTO->getMarkup(), $tarifaTO->getIva(), $tarifaTO->getFee(), $tarifaTO->getAplicaImpuesto());
                    
                }
                // Agrega obj a lista
                $dateCostTmp->add($tarifaTO);
                // Si es el ultimo registro
                if(count($roomsCosts) == $cont) {
                    $habitacionTO->setHotelTarifasTOCollection($dateCostTmp);
                }
            }
        }
        return $finaliCost;
    }

    private static function getDetailCost($cost){
        $habitacionTarifaTO = new HotelTarifaTO();
        $habitacionTarifaTO->setAplicaImpuesto($cost["aplicaimpuesto"]);
        $habitacionTarifaTO->setSencillo($cost["costosencillo"]);
        $habitacionTarifaTO->setDoble($cost["costodoble"]);
        $habitacionTarifaTO->setTriple($cost["costotriple"]);
        $habitacionTarifaTO->setCuadruple($cost["costocuadruple"]);
        $habitacionTarifaTO->setFecha($cost["fecha"]);
        $habitacionTarifaTO->setIsh($cost["ish"]);
        $habitacionTarifaTO->setIva($cost["iva"]);
        $habitacionTarifaTO->setMarkup($cost["markup"]);
        $habitacionTarifaTO->setFee($cost["fee"]);
        $habitacionTarifaTO->setCapacidadMaxima($cost["capacidadmaxima"]);
        $habitacionTarifaTO->setAllotment($cost["allotment"]);
        $habitacionTarifaTO->setIdHabitacion($cost["idhabitacion"]);
        
        return $habitacionTarifaTO;
    }
    // TODO la tarifa es con respecto al numero de personas que reservan, se calcula por la habitacion ocupada
    private static function getTotalRate($tarifa, $ish, $markup, $iva, $fee, $appyTax){
        $finalyRate = floatval($tarifa);
        if($appyTax){

            $totalTax = floatval($iva) + floatval($ish);

            $finalyRate = floatval($tarifa) + ($tarifa * ($totalTax / Generalkeys::NUMBER_ONE_HUNDRED));
        }

        // Sumamos el markup
        $finalyRate = $finalyRate / (Generalkeys::NUMBER_ONE - (floatval($markup)/ Generalkeys::NUMBER_ONE_HUNDRED));

        return $finalyRate;
    }

    private static function getRateByPersons($numAdults, $tarifaSencilla, $tarifaDoble, $tarifaTriple, $tarifaCuadruple){
        $tarifa = Generalkeys::NUMBER_ZERO;
        switch ($numAdults){
            case Generalkeys::RATE_SIMPLE:
                $tarifa = $tarifaSencilla;
                break;
            case Generalkeys::RATE_DOUBLE:
                $tarifa = $tarifaDoble;
                break;
            case Generalkeys::RATE_TRIPLE:
                $tarifa = $tarifaTriple;
                break;
            case Generalkeys::RATE_QUADRUPLE:
                $tarifa = $tarifaCuadruple;
                break;
        }

        return $tarifa;
    }

    public static function getDetailHotel($hotel, $imagenes){
        $hotelTO = new HotelTO();
        $hotelTO->setId($hotel['id']);
        $hotelTO->setEstrellas($hotel['estrellas']);
        $hotelTO->setNombreHotel($hotel['nombrehotel']);
        $hotelTO->setDescripcion($hotel['descripcion']);
        $hotelTO->setPrincipalImage($hotel['path']);
        if(count($imagenes) > Generalkeys::NUMBER_ZERO){
            $hotelTO->setImagenesHotel($imagenes);
        }

        return $hotelTO;
    }
}