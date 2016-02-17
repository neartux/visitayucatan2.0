<?php

namespace VisitaYucatanBundle\Repository;

use VisitaYucatanBundle\Entity\Touridioma;
use VisitaYucatanBundle\utils\Estatuskeys;
use VisitaYucatanBundle\utils\Generalkeys;

/**
 * TouridiomaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TouridiomaRepository extends \Doctrine\ORM\EntityRepository {

    public function findTourByIdAndIdLanguage($idTour, $idIdioma) {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT touridioma
                        FROM VisitaYucatanBundle:Touridioma touridioma
                        WHERE touridioma.estatus = :estatusActivo
                        AND touridioma.tour = :idTour
                        AND touridioma.idioma = :idIdioma'
        )->setParameter('estatusActivo', Estatuskeys::ESTATUS_ACTIVO)->setParameter('idTour', $idTour)->setParameter('idIdioma', $idIdioma);

        return $query->getOneOrNullResult();
    }

    public function saveTourLanguage($tourIdiomaTO) {
        $em = $this->getEntityManager();
        $tourIdioma = $this->findTourByIdAndIdLanguage($tourIdiomaTO->getIdTour(), $tourIdiomaTO->getIdIdioma());
        $isNew = Generalkeys::BOOLEAN_FALSE;
        if (is_null($tourIdioma)) {
            $isNew = Generalkeys::BOOLEAN_TRUE;
            $tourIdioma = new Touridioma();
            $tourIdioma->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));
            $tourIdioma->setTour($em->getReference('VisitaYucatanBundle:Tour', $tourIdiomaTO->getIdTour()));
            $tourIdioma->setIdioma($em->getReference('VisitaYucatanBundle:Idioma', $tourIdiomaTO->getIdIdioma()));
        }
        $tourIdioma->setNombretour($tourIdiomaTO->getNombretour());
        $tourIdioma->setCircuito($tourIdiomaTO->getCircuito());
        $tourIdioma->setDescripcion($tourIdiomaTO->getDescripcion());
        // Valida que slo adultos no sea null
        if(is_null($tourIdiomaTO->getSoloadultos()) || $tourIdiomaTO->getSoloadultos() == Generalkeys::BOOLEAN_FALSE){
            $tourIdioma->setSoloadultos(Generalkeys::BOOLEAN_FALSE);
        }else{
            $tourIdioma->setSoloadultos(Generalkeys::BOOLEAN_TRUE);
        }

        $em->persist($tourIdioma);
        $em->flush();

        return $isNew;
    }

}
