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
    public static function getCotizationRoom($fechasCostos, $numeroPersonas){
        $finaliCost = new ArrayCollection();
        if (count($fechasCostos) > Generalkeys::NUMBER_ZERO){
            $idCurrentRoom = Generalkeys::NUMBER_ZERO;
            $habitacionTO = null;
            $numRoomTotal = Generalkeys::NUMBER_ZERO;
            $noRoomDisponible = false;

            foreach($fechasCostos as $costo){
                // Es cambio de habitacion
                if($idCurrentRoom != $costo['idHabitacion']){
                    if(! is_null($habitacionTO)){
                        $finaliCost->add($habitacionTO);
                    }
                    $habitacionTO = new HabitacionTO();
                    $habitacionTO->setNombre($costo['nombre']);
                    $habitacionTO->setDescripcion($costo['descripcion']);
                    $habitacionTO->setAllotment($costo['allotment']);
                    $habitacionTO->setCapacidadMaxima($costo['capacidadmaxima']);

                    // Calcula el numero de habitaciones que se necesita
                    $numRoomTotal = ceil($numeroPersonas / $habitacionTO->getCapacidadMaxima());

                    // Si hay habitaciones disponible, prosige a calcular tarifas de lo contrario guarda msj de no hay habitaciones disponibles
                    if($numRoomTotal <= $habitacionTO->getAllotment()) {
                        $noRoomDisponible = false;
                    } else{
                        $habitacionTO->setMsjAllotment("El maximo de habitaciones disponibles por el momentos son ".$habitacionTO->getAllotment());
                        $noRoomDisponible = true;
                    }
                }

                // Si hay habitaciones disponibles
                if(! $noRoomDisponible){
                    $tarifaHabitacionTO = new HotelTarifaTO();
                    $tarifaHabitacionTO->setSencillo($costo['costosencillo']);
                    $tarifaHabitacionTO->setDoble($costo['costodoble']);
                    $tarifaHabitacionTO->setTriple($costo['costotriple']);
                    $tarifaHabitacionTO->setCuadruple($costo['costocuadruple']);
                    $tarifaHabitacionTO->setAplicaImpuesto($costo['aplicaimpuesto']);
                    $tarifaHabitacionTO->setIva($costo['iva']);
                    $tarifaHabitacionTO->setIsh($costo['ish']);
                    $tarifaHabitacionTO->setMarkup($costo['markup']);
                    $tarifaHabitacionTO->setFee($costo['fee']);

                    //personas por habitacion llena una habitacion
                    $personPerRoom = floor(($numeroPersonas / $habitacionTO->getCapacidadMaxima()));
                }

            }

        }
        return $finaliCost;
    }
    // TODO la tarifa es con respecto al numero de personas que reservan, se calcula por la habitacion ocupada
    private static function getRateRoomDate($tarifa, $ish, $markup, $iva, $fee, $appyTax){
        $finalyRate = floatval($tarifa);
        if($appyTax){

            $totalTax = floatval($iva) + floatval($ish);

            $finalyRate = floatval($tarifa) + ($tarifa * ($totalTax / 100));
        }

        // Sumamos el markup
        $finalyRate = $finalyRate / (1-(floatval($markup)/100));

        return $finalyRate;
    }

    private static function getRateByPersons($personas, $tarifaSencilla, $tarifaDoble, $tarifaTriple, $tarifaCuadruple){
        $tarifa = Generalkeys::NUMBER_ZERO;
        switch ($personas){
            case 1:
                $tarifa = $tarifaSencilla;
                break;
            case 2:
                $tarifa = $tarifaDoble;
                break;
            case 3:
                $tarifa = $tarifaTriple;
                break;
            case 4:
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