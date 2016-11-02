<?php

namespace VisitaYucatanBundle\Repository;
use VisitaYucatanBundle\Entity\DatosPago;
use VisitaYucatanBundle\utils\Generalkeys;

/**
 * DatosPagoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DatosPagoRepository extends \Doctrine\ORM\EntityRepository {
    
    public function createDatosPago(){
        $datosPago = new DatosPago();
        $datosPago->setPagado(Generalkeys::BOOLEAN_FALSE);
        return $datosPago;
    }
    
    public function updateDatosPagoVenta($idDatoPago, $pagado, $numeroOperacion, $numeroAutorizacion, $tipoTarjeta){
        $em = $this->getEntityManager();
	return $em->getConnection()->exec('UPDATE datos_pago SET pagado = TRUE, numeroautorizacion = '.$numeroAutorizacion.', numerooperacion = '.$numeroOperacion.', tipotarjeta = "'.$tipoTarjeta.'" WHERE datos_pago.id = '.$idDatoPago);
    }
}
