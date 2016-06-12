<?php

namespace VisitaYucatanBundle\Repository;
use VisitaYucatanBundle\Entity\Datosubicacion;
use VisitaYucatanBundle\utils\to\VentaCompletaTO;

/**
 * DatosubicacionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DatosubicacionRepository extends \Doctrine\ORM\EntityRepository{
    
    public function createDataLocation(VentaCompletaTO $ventaCompletaTO) {
        $dataLocation = new Datosubicacion();
        $dataLocation->setLada($ventaCompletaTO->getLada());
        $dataLocation->setTelefono($ventaCompletaTO->getTelefono());
        $dataLocation->setEmail($ventaCompletaTO->getEmail());
        $dataLocation->setCiudad($ventaCompletaTO->getCiudad());

        return $dataLocation;
    }
}
