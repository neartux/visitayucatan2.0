<?php

namespace VisitaYucatanBundle\Repository;
use Doctrine\ORM\EntityNotFoundException;
use VisitaYucatanBundle\Entity\HotelContrato;
use VisitaYucatanBundle\utils\Estatuskeys;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\HotelUtils;

/**
 * HotelContratoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class HotelContratoRepository extends \Doctrine\ORM\EntityRepository {
    
    public function findIdContractActiveByHotel($idHotel){
        $em = $this->getEntityManager();
        $sql = "SELECT hotel_contrato.id
                FROM hotel_contrato
                WHERE hotel_contrato.id_hotel = :hotel
                AND hotel_contrato.fechainicio <= DATE(now())
                AND hotel_contrato.fechafin >= DATE(now())
                AND hotel_contrato.id_estatus = :estatus
                ORDER BY hotel_contrato.id DESC LIMIT 1;";
        $params['hotel'] = $idHotel;
        $params['estatus'] = Estatuskeys::ESTATUS_ACTIVO;

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn(Generalkeys::NUMBER_ZERO);
    }

    public function esFechaEnRangoDeContrato($idContrato, $fechaInicio, $fechaFin){
        $em = $this->getEntityManager();
        $sql = "SELECT *
FROM hotel_contrato
WHERE hotel_contrato.id = :contrato
      AND hotel_contrato.fechainicio <= :fechaInicio
      AND hotel_contrato.fechafin >= :fechaFin
      AND hotel_contrato.id_estatus = 1";
        $params['contrato'] = $idContrato;
        $params['fechaInicio'] = $fechaInicio;
        $params['fechaFin'] = $fechaFin;

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $valor =  $stmt->fetchColumn(0);
        return $valor != null && ! empty($valor) && $valor > 0;
    }

    public function findAgeMinorByContract($idContract) {
        $em = $this->getEntityManager();
        $sql = "SELECT hotel_contrato.edadmenor
                FROM hotel_contrato
                WHERE hotel_contrato.id = :idContract
                AND hotel_contrato.id_estatus = :estatus;";
        $params['idContract'] = $idContract;
        $params['estatus'] = Estatuskeys::ESTATUS_ACTIVO;

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn(Generalkeys::NUMBER_ZERO);
    }

    public function findPlanAlimentosByContract($idContract) {
        $em = $this->getEntityManager();
        $sql = "SELECT hotel_plan.descripcion
                FROM hotel_contrato
                INNER JOIN hotel_plan ON hotel_contrato.id_plan = hotel_plan.id
                WHERE hotel_contrato.id = :idContract
                AND hotel_contrato.id_estatus = :estatus;";
        $params['idContract'] = $idContract;
        $params['estatus'] = Estatuskeys::ESTATUS_ACTIVO;

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn(Generalkeys::NUMBER_ZERO);
    }

    public function findContracts($idHotel) {
        $em = $this->getEntityManager();
        $sql = "SELECT hotel_contrato.id, hotel_contrato.descripcion
                FROM hotel_contrato
                WHERE hotel_contrato.id_hotel = :hotel AND hotel_contrato.id_estatus = 1";
        $params['hotel'] = $idHotel;
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getContractTOById($idContract){
        $contrato = $this->find($idContract);
        if(! $contrato){
            throw new EntityNotFoundException('No se encontro el contacto seleccionado');
        }
        return HotelUtils::getHotelContract($contrato);
    }

    public function createContract($contractTO){
        $em = $this->getEntityManager();

        $contrato = new HotelContrato();
        $contrato->setDescripcion($contractTO->getDescripcion());
        $contrato->setFechaInicio(new \DateTime($contractTO->getFechaInicio()));
        $contrato->setFechaFin(new \DateTime($contractTO->getFechaFin()));
        $contrato->setEdadMenor($contractTO->getEdadMenor());
        $applyTax = $contractTO->getAplicaImpuesto();
        if(is_null($contractTO->getAplicaImpuesto())){
            $applyTax =Generalkeys::BOOLEAN_FALSE;
        }
        $contrato->setAplicaImpuesto($applyTax);
        $contrato->setIsh($contractTO->getIsh());
        $contrato->setMarkup($contractTO->getMarkup());
        $contrato->setIva($contractTO->getIva());
        $contrato->setFee($contractTO->getFee());
        $contrato->setHotel($em->getReference('VisitaYucatanBundle:Hotel', $contractTO->getIdHotel()));
        $contrato->setHotelPlan($em->getReference('VisitaYucatanBundle:HotelPlan', $contractTO->getIdHotelPlan()));
        $contrato->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));

        $em->persist($contrato);
        $em->flush($contrato);
    }

    public function updateContract($contractTO) {
        $em = $this->getEntityManager();

        $contrato = $this->find($contractTO->getId());
        if(! $contrato){
            throw new EntityNotFoundException('No se encontro el contacto seleccionado');
        }
        $contrato->setDescripcion($contractTO->getDescripcion());
        $contrato->setFechaInicio(new \DateTime($contractTO->getFechaInicio()));
        $contrato->setFechaFin(new \DateTime($contractTO->getFechaFin()));
        $contrato->setEdadMenor($contractTO->getEdadMenor());
        $contrato->setAplicaImpuesto($contractTO->getAplicaImpuesto());
        $contrato->setIsh($contractTO->getIsh());
        $contrato->setMarkup($contractTO->getMarkup());
        $contrato->setIva($contractTO->getIva());
        $contrato->setFee($contractTO->getFee());
        $contrato->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', $contractTO->getIdEstatus()));

        $em->persist($contrato);
        $em->flush($contrato);
    }

    public function isHotelNameAvailableByHotel($idHotel, $descripcion) {
        $em = $this->getEntityManager();
        $sql = "SELECT hotel_contrato.id
                FROM hotel_contrato
                WHERE hotel_contrato.id_estatus = :estatus
                AND hotel_contrato.descripcion = ".$descripcion."
                AND hotel_contrato.id_hotel != :idHotel;";
        $params['idHotel'] = $idHotel;
        $params['estatus'] = Estatuskeys::ESTATUS_ACTIVO;

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $valor =  $stmt->fetchColumn(Generalkeys::NUMBER_ZERO);
        if(is_null($valor) || is_nan($valor) || !$valor) {
            return true;
        }
        return false;
    }
}
