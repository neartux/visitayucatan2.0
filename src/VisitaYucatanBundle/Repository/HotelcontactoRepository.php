<?php

namespace VisitaYucatanBundle\Repository;
use Doctrine\ORM\EntityNotFoundException;
use VisitaYucatanBundle\Entity\Datospersonales;
use VisitaYucatanBundle\Entity\Datosubicacion;
use VisitaYucatanBundle\Entity\Hotelcontacto;
use VisitaYucatanBundle\utils\Estatuskeys;
use VisitaYucatanBundle\utils\to\ContactoTO;

/**
 * HotelcontactoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class HotelcontactoRepository extends \Doctrine\ORM\EntityRepository {

    public function findContactoByIdHotel($idHotel) {
        $em = $this->getEntityManager();
        $sql = "SELECT hotel_contacto.id, datos_personales.nombres, datos_personales.apellidos, datos_ubicacion.email
                FROM hotel_contacto
                INNER JOIN datos_personales ON datos_personales.id = hotel_contacto.id_datospersonales
                INNER JOIN datos_ubicacion ON datos_ubicacion.id = hotel_contacto.id_datosubicacion
                WHERE hotel_contacto.id_hotel = :hotel
                AND hotel_contacto.id_estatus = :estatus";
        $params['estatus'] = Estatuskeys::ESTATUS_ACTIVO;
        $params['hotel'] = $idHotel;
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function createHotelContacto($contactoTO){
        $em = $this->getEntityManager();

        $datosPersonales = new Datospersonales();
        $datosPersonales->setNombres($contactoTO->getNombres());
        $datosPersonales->setApellidos($contactoTO->getApellidos());
        $em->persist($datosPersonales);

        $datosUbicacion = new Datosubicacion();
        $datosUbicacion->setEmail($contactoTO->getEmail());
        $em->persist($datosUbicacion);

        $hotelContacto = new Hotelcontacto();
        $hotelContacto->setDatosPersonales($datosPersonales);
        $hotelContacto->setDatosUbicacion($datosUbicacion);
        $hotelContacto->setHotel($em->getReference('VisitaYucatanBundle:Hotel', $contactoTO->getIdHotel()));
        $hotelContacto->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));

        $em->persist($hotelContacto);
        $em->flush();
    }

    public function updateHotelContacto(ContactoTO $contactoTO){

        $contacto = $this->find($contactoTO->getId());
        if (!$contacto) {
            throw new EntityNotFoundException('El contacto con id ' . $contactoTO->getId() . " no se encontro");
        }


        $em = $this->getEntityManager();


        $contacto->getDatosPersonales()->setNombres($contactoTO->getNombres());
        $contacto->getDatosPersonales()->setApellidos($contactoTO->getApellidos());

        $contacto->getDatosUbicacion()->setEmail($contactoTO->getEmail());

        $em->persist($contacto);
        $em->flush();
    }

    public function deleteContactHotel($idContacto){
        $contacto = $this->find($idContacto);
        if (!$contacto) {
            throw new EntityNotFoundException('El contacto con id ' . $idContacto . " no se encontro");
        }
        $em = $this->getEntityManager();

        $contacto->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_INACTIVO));
        $em->persist($contacto);
        $em->flush();
    }
}
