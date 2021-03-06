<?php

namespace VisitaYucatanBundle\Repository;
use Doctrine\ORM\EntityNotFoundException;
use VisitaYucatanBundle\Entity\Datosubicacion;
use VisitaYucatanBundle\Entity\Hotel;
use VisitaYucatanBundle\utils\Estatuskeys;
use VisitaYucatanBundle\utils\Generalkeys;

/**
 * HotelRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class HotelRepository extends \Doctrine\ORM\EntityRepository {

    public function getHotelsByDestino($idioma, $idMoneda, $ciudad, $offset, $limit){
        $em = $this->getEntityManager();

        $sql = "SELECT hotel.id,hotel.estrellas,hotel_idioma.nombrehotel,hotel_idioma.descripcion,hotel_imagen.path AS imagen,moneda.simbolo,hotel_tarifa.doble
                ,(min(hotel_tarifa.doble)/moneda.tipo_cambio) AS tarifa,
                (SELECT hotel_contrato.aplicaimpuesto FROM hotel_contrato WHERE hotel_contrato.id_hotel = hotel.id AND hotel_contrato.id_estatus = 1 ORDER BY id DESC LIMIT 1) AS aplicaimpuesto,
  (SELECT hotel_contrato.fee FROM hotel_contrato WHERE hotel_contrato.id_hotel = hotel.id AND hotel_contrato.id_estatus = 1 ORDER BY id DESC LIMIT 1) AS fee,
  (SELECT hotel_contrato.iva FROM hotel_contrato WHERE hotel_contrato.id_hotel = hotel.id AND hotel_contrato.id_estatus = 1 ORDER BY id DESC LIMIT 1) AS iva,
  (SELECT hotel_contrato.ish FROM hotel_contrato WHERE hotel_contrato.id_hotel = hotel.id AND hotel_contrato.id_estatus = 1 ORDER BY id DESC LIMIT 1) AS ish,
  (SELECT hotel_contrato.markup FROM hotel_contrato WHERE hotel_contrato.id_hotel = hotel.id AND hotel_contrato.id_estatus = 1 ORDER BY id DESC LIMIT 1) AS markup
                FROM hotel
                INNER JOIN hotel_tarifa ON hotel.id = hotel_tarifa.id_hotel AND hotel_tarifa.fecha = curdate() AND hotel_tarifa.id_estatus = :estatusActivo
                INNER JOIN hotel_idioma ON hotel.id = hotel_idioma.id_hotel AND hotel_idioma.id_idioma = :idioma AND hotel_idioma.id_estatus = :estatusActivo
                INNER JOIN idioma ON idioma.id = hotel_idioma.id_idioma AND idioma.id = :idioma AND idioma.id_estatus = :estatusActivo
                INNER JOIN ciudad ON hotel.id_ciudad = ciudad.id AND ciudad.id = :ciudad
                INNER JOIN moneda ON moneda.id = :moneda AND moneda.id_estatus = :estatusActivo
                LEFT JOIN hotel_imagen ON hotel.id = hotel_imagen.id_hotel AND hotel_imagen.principal = TRUE  AND hotel_imagen.id_estatus = :estatusActivo
                WHERE hotel.id_estatus = :estatusActivo
                AND hotel.promovido = TRUE
                GROUP BY hotel_tarifa.id_hotel ORDER BY hotel_tarifa.doble ASC LIMIT ". $limit ." OFFSET ".$offset;

        $params['estatusActivo'] = Estatuskeys::ESTATUS_ACTIVO;
        $params['idioma'] = $idioma;
        $params['moneda'] = $idMoneda;
        $params['ciudad'] = $ciudad;

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getHotelById($idHotel, $idioma, $moneda){
        $em = $this->getEntityManager();

        $sql = "SELECT hotel.id,hotel.estrellas,hotel_idioma.nombrehotel,hotel_idioma.descripcion,hotel_imagen.path,moneda.simbolo,hotel.mapa
                FROM hotel
                INNER JOIN hotel_idioma ON hotel.id = hotel_idioma.id_hotel AND hotel_idioma.id_idioma = :idioma AND hotel_idioma.id_estatus = :estatusActivo
                LEFT JOIN hotel_imagen ON hotel.id = hotel_imagen.id_hotel AND hotel_imagen.principal = TRUE AND hotel_imagen.id_estatus = :estatusActivo
                INNER JOIN moneda ON moneda.id = :moneda AND moneda.id_estatus = :estatusActivo
                WHERE hotel.id = :idHotel
                AND hotel.id_estatus = :estatusActivo
                AND hotel.promovido = TRUE;";

        $params['estatusActivo'] = Estatuskeys::ESTATUS_ACTIVO;
        $params['idioma'] = $idioma;
        $params['moneda'] = $moneda;
        $params['idHotel'] = $idHotel;

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }

    public function findAllHotels() {
        $em = $this->getEntityManager();
        $sql = "SELECT hotel.id,hotel.descripcion,hotel.estrellas,hotel.promovido,datos_ubicacion.direccion, 
                datos_ubicacion.telefono,ciudad.nombre AS ciudad,ciudad.id AS city,estado.id As state,hotel.mapa
                FROM hotel
                INNER JOIN datos_ubicacion ON datos_ubicacion.id = hotel.id_datosubicacion
                INNER JOIN ciudad ON hotel.id_ciudad = ciudad.id
                INNER JOIN estado ON estado.id = ciudad.id_estado
                WHERE hotel.id_estatus = :estatus";
        $params['estatus'] = Estatuskeys::ESTATUS_ACTIVO;
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function createHotel($hotelTO) {
        $em = $this->getEntityManager();

        $datosUbicacion = new Datosubicacion();
        $datosUbicacion->setDireccion($hotelTO->getDireccion());
        $datosUbicacion->setTelefono($hotelTO->getTelefono());
        $em->persist($datosUbicacion);

        $hotel = new Hotel();
        $hotel->setDescripcion($hotelTO->getDescripcion());
        $hotel->setEstrellas($hotelTO->getEstrellas());
        $hotel->setPromovido(Generalkeys::BOOLEAN_FALSE);
        $hotel->setDatosUbicacion($datosUbicacion);
        //$hotel->setDestino($em->getReference('VisitaYucatanBundle:Destino', $hotelTO->getIdDestino()));
        $hotel->setCiudad($em->getReference('VisitaYucatanBundle:Ciudad', $hotelTO->getCity()));
        $hotel->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));
        $hotel->setMapa($hotelTO->getMapa());

        $em->persist($hotel);
        $em->flush();
    }

    public function updateHotel($hotelTO) {
        $em = $this->getEntityManager();
        $hotelUpdate = $this->find($hotelTO->getId());
        if (!$hotelUpdate) {
            throw new EntityNotFoundException('El hotel con id ' . $hotelTO->getId() . " no se encontro");
        }
        // Actualiza la informacion del tour
        $hotelUpdate->setDescripcion($hotelTO->getDescripcion());
        $hotelUpdate->setEstrellas($hotelTO->getEstrellas());
        $hotelUpdate->getDatosUbicacion()->setDireccion($hotelTO->getDireccion());
        $hotelUpdate->getDatosUbicacion()->setTelefono($hotelTO->getTelefono());
        $hotelUpdate->setCiudad($em->getReference('VisitaYucatanBundle:Ciudad', $hotelTO->getCity()));
        $hotelUpdate->setMapa($hotelTO->getMapa());

        $em->persist($hotelUpdate);
        $em->flush();
    }

    public function deleteHotel($idHotel) {
        $em = $this->getEntityManager();
        $hotel = $this->find($idHotel);
        if (!$hotel) {
            throw new EntityNotFoundException('El Hotel con id ' . $idHotel . " no se encontro");
        }
        $hotel->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_INACTIVO));
        $em->persist($hotel);
        $em->flush();
    }

    public function promoveOrNotPromoveHotel($idHotel, $boobleanPromove) {
        $em = $this->getEntityManager();
        $hotel = $this->find($idHotel);
        if (!$hotel) {
            throw new EntityNotFoundException('El Hotel con id ' . $idHotel . " no se encontro");
        }
        $hotel->setPromovido($boobleanPromove);

        $em->persist($hotel);
        $em->flush();
    }
}
