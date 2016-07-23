<?php

namespace VisitaYucatanBundle\Repository;

/**
 * CiudadRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CiudadRepository extends \Doctrine\ORM\EntityRepository{
    public function findCitiesByState($idState){
        $em = $this->getEntityManager();
        $sql = "SELECT ciudad.id, ciudad.nombre FROM ciudad WHERE ciudad.id_estado =  :state";
        $params['state'] = $idState;
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}