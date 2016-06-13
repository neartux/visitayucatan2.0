<?php
/**
 * User: ricardo
 * Date: 13/06/16
 */

namespace VisitaYucatanBundle\utils;


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
}