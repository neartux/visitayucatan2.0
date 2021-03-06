<?php

namespace VisitaYucatanBundle\Repository;
use Doctrine\ORM\EntityNotFoundException;
use VisitaYucatanBundle\Entity\HotelFechaCierre;
use VisitaYucatanBundle\utils\Estatuskeys;

/**
 * HotelFechaCierreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class HotelFechaCierreRepository extends \Doctrine\ORM\EntityRepository {

    // TODO pasar contrato, ya que pasados los años, siempre traera las fechas de cierre que ya no son validas actualmente
    public function findFechasCierreByHotel($idHotel) {
        $em = $this->getEntityManager();
        $sql = "SELECT * FROM hotel_fecha_cierre WHERE hotel_fecha_cierre.id_hotel = :hotel AND hotel_fecha_cierre.id_estatus = :estatus ORDER BY hotel_fecha_cierre.id DESC";
        $params['estatus'] = Estatuskeys::ESTATUS_ACTIVO;
        $params['hotel'] = $idHotel;
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function findClosingDateByContractAndHotel($idHotel, $idContrato) {
        $em = $this->getEntityManager();
        $sql = "SELECT hotel_fecha_cierre.id, hotel_fecha_cierre.fechainicio, hotel_fecha_cierre.fechafin
                FROM hotel_fecha_cierre
                INNER JOIN hotel_contrato ON hotel_contrato.id = :contrato AND hotel_contrato.id_hotel = :hotel AND hotel_contrato.id_estatus = :estatus
                WHERE hotel_fecha_cierre.id_hotel = :hotel
                AND hotel_fecha_cierre.id_estatus = :estatus";
        $params['estatus'] = Estatuskeys::ESTATUS_ACTIVO;
        $params['hotel'] = $idHotel;
        $params['contrato'] = $idContrato;
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function createFechaCierre($idHotel, $fechaInicio, $fechaFin){
        $em = $this->getEntityManager();

        $fechaCierre = new HotelFechaCierre();
        $fechaCierre->setFechaInicio(new \DateTime($fechaInicio));
        $fechaCierre->setFechaFin(new \DateTime($fechaFin));
        $fechaCierre->setHotel($em->getReference('VisitaYucatanBundle:Hotel', $idHotel));
        $fechaCierre->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));

        $em->persist($fechaCierre);
        $em->flush();
    }

    public function updateFechaCierre($idFechaCierre, $fechaInicio, $fechaFin){
        $em = $this->getEntityManager();

        $fechaCierre = $this->find($idFechaCierre);
        if(! $fechaCierre){
            throw new EntityNotFoundException('La fecha cierre ' . $idFechaCierre . " no se pudo actualizar");
        }
        $fechaCierre->setFechaInicio(new \DateTime($fechaInicio));
        $fechaCierre->setFechaFin(new \DateTime($fechaFin));

        $em->persist($fechaCierre);
        $em->flush();
    }

    public function deleteFechaCierre($idFechaCierre){
        $em = $this->getEntityManager();

        $fechaCierre = $this->find($idFechaCierre);
        if(! $fechaCierre){
            throw new EntityNotFoundException('La fecha cierre ' . $idFechaCierre . " no se pudo eliminar");
        }
        $fechaCierre->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_INACTIVO));

        $em->persist($fechaCierre);
        $em->flush();
    }
}
