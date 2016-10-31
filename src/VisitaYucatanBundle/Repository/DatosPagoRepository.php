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
        echo "** = ".$pagado." ".$numeroOperacion." ".$tipoTarjeta." ".$numeroAutorizacion." ".$idDatoPago." **:)";
        $em = $this->getEntityManager();
        
        $datosPago = parent::find($idDatoPago);
        $datosPago->setPagado($pagado);
        $datosPago->setNumeroOperacion($numeroOperacion);
        $datosPago->setNumeroAutorizacion($numeroAutorizacion);
        $datosPago->setTipoTarjeta($tipoTarjeta);
        
        $em->persist($datosPago);
        $em->flush();
    }
}
