<?php

namespace VisitaYucatanBundle\Repository;
use VisitaYucatanBundle\Entity\Estatus;
use VisitaYucatanBundle\Entity\VentaDetalle;
use VisitaYucatanBundle\utils\Estatuskeys;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\to\VentaCompletaTO;

/**
 * VentaDetalleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VentaDetalleRepository extends \Doctrine\ORM\EntityRepository {

    public function createVentaDetalleTour (VentaCompletaTO $ventaCompletaTO, $tipoProducto, $idVenta) {
        $em = $this->getEntityManager();
        
        $ventaDetalle = new VentaDetalle();
        $ventaDetalle->setVenta($em->getReference('VisitaYucatanBundle:Venta', $idVenta));
        $ventaDetalle->setTour($em->getReference('VisitaYucatanBundle:Tour', $ventaCompletaTO->getIdTour()));
        $ventaDetalle->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));
        $ventaDetalle->setTipoProducto($tipoProducto);
        $ventaDetalle->setSubtotal($ventaCompletaTO->getCostoTotal());
        $ventaDetalle->setTotal($ventaCompletaTO->getCostoTotal());
        $ventaDetalle->setNumeroAdultos($ventaCompletaTO->getNumeroAdultos());
        $ventaDetalle->setNumeroMenores($ventaCompletaTO->getNumeroMenores());
        $ventaDetalle->setCostoAdulto($ventaCompletaTO->getCostoAdulto());
        $ventaDetalle->setCostoMenor($ventaCompletaTO->getCostoMenor());
        $ventaDetalle->setImpuesto(Generalkeys::NUMBER_ZERO);

        $em->persist($ventaDetalle);
        $em->flush();
        
    }

    public function createVentaDetallePackage(VentaCompletaTO $ventaCompletaTO, $tipoProducto, $idVenta) {
        $em = $this->getEntityManager();

        $ventaDetalle = new VentaDetalle();
        $ventaDetalle->setVenta($em->getReference('VisitaYucatanBundle:Venta', $idVenta));
        $ventaDetalle->setPaquete($em->getReference('VisitaYucatanBundle:Paquete', $ventaCompletaTO->getIdPaquete()));
        $ventaDetalle->setHotel($em->getReference('VisitaYucatanBundle:Hotel', $ventaCompletaTO->getIdHotel()));
        $ventaDetalle->setPaqueteCombinacionHotel($em->getReference('VisitaYucatanBundle:PaqueteCombinacionHotel', $ventaCompletaTO->getIdCombinacion()));
        $ventaDetalle->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));
        $ventaDetalle->setTipoProducto($tipoProducto);
        $ventaDetalle->setSubtotal($ventaCompletaTO->getCostoTotal());
        $ventaDetalle->setTotal($ventaCompletaTO->getCostoTotal());
        $ventaDetalle->setNumeroAdultos($ventaCompletaTO->getNumeroAdultos());
        $ventaDetalle->setNumeroMenores($ventaCompletaTO->getNumeroMenores());
        $ventaDetalle->setCostoAdulto($ventaCompletaTO->getCostoAdulto());
        $ventaDetalle->setCostoMenor($ventaCompletaTO->getCostoMenor());
        $ventaDetalle->setImpuesto(Generalkeys::NUMBER_ZERO);

        $em->persist($ventaDetalle);
        $em->flush();

    }

    public function createVentaDetalleHotel (VentaCompletaTO $ventaCompletaTO, $tipoProducto, $idVenta) {
        $em = $this->getEntityManager();

        $ventaDetalle = new VentaDetalle();
        $ventaDetalle->setVenta($em->getReference('VisitaYucatanBundle:Venta', $idVenta));
        $ventaDetalle->setHotel($em->getReference('VisitaYucatanBundle:Hotel', $ventaCompletaTO->getIdHotel()));
        $ventaDetalle->setHotelHabitacion($em->getReference('VisitaYucatanBundle:HotelHabitacion', $ventaCompletaTO->getIdHabitacion()));
        $ventaDetalle->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));
        $ventaDetalle->setTipoProducto($tipoProducto);
        $ventaDetalle->setSubtotal($ventaCompletaTO->getCostoTotal());
        $ventaDetalle->setTotal($ventaCompletaTO->getCostoTotal());
        $ventaDetalle->setNumeroAdultos($ventaCompletaTO->getNumeroAdultos());
        $ventaDetalle->setNumeroMenores($ventaCompletaTO->getNumeroMenores());
        $ventaDetalle->setCostoAdulto($ventaCompletaTO->getCostoAdulto());
        $ventaDetalle->setCostoMenor($ventaCompletaTO->getCostoMenor());
        $ventaDetalle->setImpuesto(Generalkeys::NUMBER_ZERO);

        $em->persist($ventaDetalle);
        $em->flush();

    }
}
