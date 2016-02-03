<?php

namespace VisitaYucatanBundle\Repository;

use VisitaYucatanBundle\utils\Estatuskeys;
use VisitaYucatanBundle\utils\Generalkeys;

/**
 * TourRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TourRepository extends \Doctrine\ORM\EntityRepository
{

    public function findAllTours() {
        $em = $this->getEntityManager();
        $sql = "SELECT *
                FROM tour
                WHERE tour.id_estatus = :estatus";
        $params['estatus'] = Estatuskeys::ESTATUS_ACTIVO;
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function createTour($tour) {
        $em = $this->getEntityManager();
        $tour->setPromovido(Generalkeys::BOOLEAN_FALSE);
        $tour->setVendido(Generalkeys::NUMBER_ZERO);
        $tour->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));

        $em->persist($tour);
        $em->flush();
    }

    public function updateTour($tour) {
        $em = $this->getEntityManager();
        $tourUpdate = $em->getRepository('VisitaYucatanBundle:Tour')->find($tour->getId());
        if (!$tourUpdate) {
            throw new EntityNotFoundException('El tour con id ' . $tour->getId() . " no se encontro");
        }
        // Actualiza la informacion del tour
        $tourUpdate->setDescripcion($tour->getDescripcion());
        $tourUpdate->setCircuito($tour->getCircuito());
        $tourUpdate->setTarifaadulto($tour->getTarifaadulto());
        $tourUpdate->setTarifamenor($tour->getTarifamenor());
        $tourUpdate->setMinimopersonas($tour->getMinimopersonas());

        $em->persist($tourUpdate);
        $em->flush();
    }

    public function deleteTour($idTour) {
        $em = $this->getEntityManager();
        $tour = $em->getRepository('VisitaYucatanBundle:Tour')->find($idTour);
        if (!$tour) {
            throw new EntityNotFoundException('La moneda con id ' . $idTour . " no se encontro");
        }
        $tour->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_INACTIVO));
        $em->persist($tour);
        $em->flush();
    }

    public function promoveOrNotPromoveTour($idTour, $boobleanPromove) {
        $em = $this->getEntityManager();
        $tour = $em->getRepository('VisitaYucatanBundle:Tour')->find($idTour);
        if (!$tour) {
            throw new EntityNotFoundException('El tour con id ' . $idTour . " no se encontro");
        }
        $tour->setPromovido($boobleanPromove);

        $em->persist($tour);
        $em->flush();
    }
}
