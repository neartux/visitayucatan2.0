<?php
/**
 * User: ricardo
 * Date: 13/06/16
 */

namespace VisitaYucatanBundle\utils;


use Doctrine\Common\Collections\ArrayCollection;
use VisitaYucatanBundle\Entity\Paquete;
use VisitaYucatanBundle\Entity\Venta;
use VisitaYucatanBundle\utils\to\VentaCompletaTO;

final class VentaUtils {

    public static function getVentaCompletaTOHotel($venta){
        $ventaCompletaTO = new VentaCompletaTO();
        $ventaCompletaTO->setIdVenta($venta['idventa']);
        $ventaCompletaTO->setFechaVenta(new \DateTime($venta['fechaventa']));
        $ventaCompletaTO->setCostoTotal($venta['total']);
        $ventaCompletaTO->setNumeroAdultos($venta['numeroadultos']);
        $ventaCompletaTO->setNumeroMenores($venta['numeromenores']);
        $ventaCompletaTO->setNumeroMenores($venta['numeromenores']);
        $ventaCompletaTO->setNombreHotel($venta['nombrehotel']);
        $ventaCompletaTO->setPagado($venta['pagado']);
        $ventaCompletaTO->setNumeroAutorizacion($venta['numeroautorizacion']);
        $ventaCompletaTO->setNumeroOperacion($venta['numerooperacion']);
        $ventaCompletaTO->setPlanHotelContrato($venta['plan']);
        $ventaCompletaTO->setCheckIn(new \DateTime($venta['checkin']));
        $ventaCompletaTO->setCheckOut(new \DateTime($venta['checkout']));
        $ventaCompletaTO->setNombres($venta['nombres']);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
        $ventaCompletaTO->setApellidos($venta['apellidos']);
        $ventaCompletaTO->setLada($venta['lada']);
        $ventaCompletaTO->setTelefono($venta['telefono']);
        $ventaCompletaTO->setEmail($venta['email']);
        $ventaCompletaTO->setCiudad($venta['ciudad']);

        return $ventaCompletaTO;
    }
    
    public static function getVentaCompleteTOTour(Venta $venta, $tour){
        //print_r($venta->getDatosReserva());
        $ventaCompletaTO = new VentaCompletaTO();
        $ventaCompletaTO->setIdVenta($venta->getId());
        $ventaCompletaTO->setCostoTotal($venta->getTotal());
        $ventaCompletaTO->setNombreTour($tour['nombre']);
        $ventaCompletaTO->setCircuito($tour['circuito']);
        $ventaCompletaTO->setHotelPickup($venta->getDatosReserva()->getHotelPickUp());
        $ventaCompletaTO->setNumeroAdultos($venta->getVentaDetalle()->get(0)->getNumeroAdultos());
        $ventaCompletaTO->setNumeroMenores($venta->getVentaDetalle()->get(0)->getNumeroMenores());
        $ventaCompletaTO->setNombres($venta->getDatosPersonales()->getNombres());
        $ventaCompletaTO->setApellidos($venta->getDatosPersonales()->getApellidos());
        $ventaCompletaTO->setLada($venta->getDatosUbicacion()->getLada());
        $ventaCompletaTO->setTelefono($venta->getDatosUbicacion()->getTelefono());
        $ventaCompletaTO->setEmail($venta->getDatosUbicacion()->getEmail());
        $ventaCompletaTO->setCiudad($venta->getDatosUbicacion()->getCiudad());
        //print_r($venta->getVentaDetalle()->get(0)->getTour()->getDescripcion());
        return $ventaCompletaTO;
    }

    public static function getVentaCompleteTOPackage(Venta $venta, Paquete $package){
        //print_r($venta->getDatosReserva());
        $ventaCompletaTO = new VentaCompletaTO();
        $ventaCompletaTO->setIdVenta($venta->getId());
        $ventaCompletaTO->setCostoTotal($venta->getTotal());
        $ventaCompletaTO->setNombrePaquete($package->getDescripcion());
        $ventaCompletaTO->setCircuito($package->getCircuito());
        $ventaCompletaTO->setHotelPickup($venta->getVentaDetalle()->get(0)->getHotel()->getDescripcion());
        $ventaCompletaTO->setNumeroAdultos($venta->getVentaDetalle()->get(0)->getNumeroAdultos());
        $ventaCompletaTO->setNumeroMenores($venta->getVentaDetalle()->get(0)->getNumeroMenores());
        $ventaCompletaTO->setNombres($venta->getDatosPersonales()->getNombres());
        $ventaCompletaTO->setApellidos($venta->getDatosPersonales()->getApellidos());
        $ventaCompletaTO->setLada($venta->getDatosUbicacion()->getLada());
        $ventaCompletaTO->setTelefono($venta->getDatosUbicacion()->getTelefono());
        $ventaCompletaTO->setEmail($venta->getDatosUbicacion()->getEmail());
        $ventaCompletaTO->setCiudad($venta->getDatosUbicacion()->getCiudad());
        $dias = $package->getPaqueteIdioma()->get(0)->getDias();
        $ventaCompletaTO->setDiasPaquete($package->getPaqueteIdioma()->get(0)->getDias());
        $ventaCompletaTO->setNochePaquete((int)$dias - 1);
        //print_r($venta->getVentaDetalle()->get(0)->getTour()->getDescripcion());
        return $ventaCompletaTO;
    }

    public static function getAllVentas($ventas){
        $ventasTO = new ArrayCollection();
        if(count($ventas) > Generalkeys::NUMBER_ZERO){
            foreach ($ventas as $venta){
                $ventaTO = new VentaCompletaTO();
                $ventaDetalle = $venta->getVentaDetalle()->get(0);
                $ventaTO->setIdVenta($venta->getId());
                $ventaTO->setTipoReserva($ventaDetalle->getTipoProducto());
                $ventaTO->setNombres($venta->getDatosPersonales()->getNombres());
                $ventaTO->setApellidos($venta->getDatosPersonales()->getApellidos());
                $ventaTO->setTelefono($venta->getDatosUbicacion()->getTelefono());
                $ventaTO->setEmail($venta->getDatosUbicacion()->getEmail());
                $ventaTO->setNumeroAdultos($ventaDetalle->getNumeroAdultos());
                $ventaTO->setNumeroMenores($ventaDetalle->getNumeroMenores());
                $ventaTO->setCostoTotal($venta->getTotal());
                $ventaTO->setPagado($venta->getDatosPago()->getPagado());


                $ventasTO->add($ventaTO);
            }
        }
        return $ventasTO->getValues();
    }
}