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

    public function findContracts($idHotel) {
        $em = $this->getEntityManager();
        $sql = "SELECT hotel_contrato.id, hotel_contrato.descripcion
                FROM hotel_contrato
                WHERE hotel_contrato.id_hotel = :hotel
                AND hotel_contrato.id_estatus =  :estatus ";
        $params['hotel'] = $idHotel;
        $params['estatus'] = Estatuskeys::ESTATUS_ACTIVO;
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

        $em->persist($contrato);
        $em->flush($contrato);
    }
}
