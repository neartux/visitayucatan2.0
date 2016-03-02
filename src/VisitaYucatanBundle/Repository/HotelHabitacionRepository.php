<?php

namespace VisitaYucatanBundle\Repository;
use Doctrine\ORM\EntityNotFoundException;
use VisitaYucatanBundle\Entity\HotelHabitacion;
use VisitaYucatanBundle\utils\Estatuskeys;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\HotelUtils;

/**
 * HotelHabitacionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class HotelHabitacionRepository extends \Doctrine\ORM\EntityRepository {

    public function findHabitacionHotel($idHotel) {
        $em = $this->getEntityManager();
        $sql = "SELECT *
                FROM hotel_habitacion
                WHERE hotel_habitacion.id_hotel= :hotel
                AND hotel_habitacion.id_estatus = :estatus";
        $params['estatus'] = Estatuskeys::ESTATUS_ACTIVO;
        $params['hotel'] = $idHotel;
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getHabitacionTOById($idHabitacion){
        $habitacion = $this->find($idHabitacion);
        if(! $habitacion){
            throw new EntityNotFoundException('No se encontro la habitacion seleccionada');
        }
        return HotelUtils::getHotelHabitacion($habitacion);
    }

    public function createHabitacion($habitacionTO){
        $em = $this->getEntityManager();
        $habitacion = new HotelHabitacion();
        $habitacion->setNombre($habitacionTO->getNombre());
        $habitacion->setDescripcion($habitacionTO->getDescripcion());
        $habitacion->setAllotment($habitacionTO->getAllotment());
        $habitacion->setCapacidadMaxima($habitacionTO->getCapacidadMaxima());
        $habitacion->setMaximoAdultos($habitacionTO->getMaximoAdultos());
        $habitacion->setMaximoInfantes(Generalkeys::NUMBER_ZERO);
        $habitacion->setMaximoJuniors(Generalkeys::NUMBER_ZERO);
        $habitacion->setMaximoMenores($habitacionTO->getMaximoMenores());
        $habitacion->setHotel($em->getReference('VisitaYucatanBundle:Hotel', $habitacionTO->getIdHotel()));
        $habitacion->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));

        $em->persist($habitacion);
        $em->flush($habitacion);
    }

    public function updateHabitacion($habitacionTO){
        $em = $this->getEntityManager();

        $habitacion = $this->find($habitacionTO->getId());
        if(! $habitacion){
            throw new EntityNotFoundException('La habitacion no se pudo actualizar');
        }

        $habitacion->setNombre($habitacionTO->getNombre());
        $habitacion->setDescripcion($habitacionTO->getDescripcion());
        $habitacion->setAllotment($habitacionTO->getAllotment());
        $habitacion->setCapacidadMaxima($habitacionTO->getCapacidadMaxima());
        $habitacion->setMaximoAdultos($habitacionTO->getMaximoAdultos());
        $habitacion->setMaximoInfantes(Generalkeys::NUMBER_ZERO);
        $habitacion->setMaximoJuniors(Generalkeys::NUMBER_ZERO);
        $habitacion->setMaximoMenores($habitacionTO->getMaximoMenores());

        $em->persist($habitacion);
        $em->flush($habitacion);
    }
}
