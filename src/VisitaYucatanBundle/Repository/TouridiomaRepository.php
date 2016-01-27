<?php

namespace VisitaYucatanBundle\Repository;

use VisitaYucatanBundle\utils\Estatuskeys;

/**
 * TouridiomaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TouridiomaRepository extends \Doctrine\ORM\EntityRepository
{

    public function findTourImagesByIdTour($idTour){
        return $this->findBy(array('tour' => $idTour, 'estatus' => Estatuskeys::ESTATUS_ACTIVO));
    }

    public function findTourByIdAndIdLanguage($idTour, $idIdioma)
    {
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

    public function create($tourIdioma, $idTour, $idLanguage)
    {
        $em = $this->getEntityManager();
        $tourIdioma->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));
        $tourIdioma->setTour($em->getReference('VisitaYucatanBundle:Tour', $idTour));
        $tourIdioma->setIdioma($em->getReference('VisitaYucatanBundle:Idioma', $idLanguage));

        $em->persist($tourIdioma);
        $em->flush();
    }

    public function update($tourIdiomaTO)
    {
        $em = $this->getEntityManager();
        $tourIdioma = $this->findTourByIdAndIdLanguage($tourIdiomaTO->getIdTour(), $tourIdiomaTO->getIdIdioma());
        if (is_null($tourIdioma)) {
            throw new EntityNotFoundException('No se pudo encontrar el tour con id el ' . $tourIdiomaTO->getIdTour() . ' y el idioma ' . $tourIdiomaTO->getIdIdioma());
        }
        $tourIdioma->setNombretour($tourIdiomaTO->getNombretour());
        $tourIdioma->setCircuito($tourIdiomaTO->getCircuito());
        $tourIdioma->setDescripcion($tourIdiomaTO->getDescripcion());
        $tourIdioma->setSoloadultos($tourIdiomaTO->getSoloadultos());

        $em->persist($tourIdioma);
        $em->flush();
    }

}
