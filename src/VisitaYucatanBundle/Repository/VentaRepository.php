<?php

namespace VisitaYucatanBundle\Repository;
use VisitaYucatanBundle\Entity\DatosPago;
use VisitaYucatanBundle\Entity\Datospersonales;
use VisitaYucatanBundle\Entity\DatosReserva;
use VisitaYucatanBundle\Entity\Datosubicacion;
use VisitaYucatanBundle\Entity\Estatus;
use VisitaYucatanBundle\Entity\Idioma;
use VisitaYucatanBundle\Entity\Moneda;
use VisitaYucatanBundle\Entity\Venta;
use VisitaYucatanBundle\utils\Estatuskeys;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\to\VentaCompletaTO;

/**
 * VentaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VentaRepository extends \Doctrine\ORM\EntityRepository {

    public function createSaleHotel(VentaCompletaTO $ventaCompletaTO){
        $em = $this->getEntityManager();

        $venta = new Venta();

        $personalData = $em->getRepository('VisitaYucatanBundle:Datospersonales')->createPersonalData($ventaCompletaTO);
        $em->persist($personalData);
        $dataLocation = $em->getRepository('VisitaYucatanBundle:Datosubicacion')->createDataLocation($ventaCompletaTO);
        $em->persist($dataLocation);
        $dataReservation = $em->getRepository('VisitaYucatanBundle:DatosReserva')->createDataReserva(null, $ventaCompletaTO->getCheckIn(), $ventaCompletaTO->getCheckOut());
        $em->persist($dataReservation);
        $datosPago = $em->getRepository('VisitaYucatanBundle:DatosPago')->createDatosPago();
        $em->persist($datosPago);

        $venta->setDatosPersonales($personalData);
        $venta->setDatosUbicacion($dataLocation);
        $venta->setDatosReserva($dataReservation);
        $venta->setDatosPago($datosPago);
        $venta->setFechaVenta(new \DateTime());
        $venta->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));
        $venta->setIdioma($em->getReference('VisitaYucatanBundle:Idioma', $ventaCompletaTO->getIdIdioma()));
        $venta->setMoneda($em->getReference('VisitaYucatanBundle:Moneda', $ventaCompletaTO->getIdMoneda()));
        $venta->setTipoCambio($ventaCompletaTO->getTipoCambio());
        $venta->setSubtotal($ventaCompletaTO->getCostoTotal()); //TODO recordar el el total se debe guardar en mxn, si esta en otra moneda convertir antes
        $venta->setTotal($ventaCompletaTO->getCostoTotal());

        $em->persist($venta);
        $em->flush();

        $em->getRepository('VisitaYucatanBundle:VentaDetalle')->createVentaDetalleHotel($ventaCompletaTO, Generalkeys::TIPO_PRODUCTO_HOTEL, $venta->getId());

        return $venta->getId();
    }

    public function createSaleTour(VentaCompletaTO $ventaCompletaTO) {
        $em = $this->getEntityManager();

        $venta = new Venta();

        $personalData = $em->getRepository('VisitaYucatanBundle:Datospersonales')->createPersonalData($ventaCompletaTO);
        $em->persist($personalData);
        $dataLocation = $em->getRepository('VisitaYucatanBundle:Datosubicacion')->createDataLocation($ventaCompletaTO);
        $em->persist($dataLocation);
        $dataReservation = $em->getRepository('VisitaYucatanBundle:DatosReserva')->createDataReserva($ventaCompletaTO->getHotelPickup(), $ventaCompletaTO->getCheckIn(), null);
        $em->persist($dataReservation);
        $datosPago = $em->getRepository('VisitaYucatanBundle:DatosPago')->createDatosPago();
        $em->persist($datosPago);

        $venta->setDatosPersonales($personalData);
        $venta->setDatosUbicacion($dataLocation);
        $venta->setDatosReserva($dataReservation);
        $venta->setDatosPago($datosPago);
        $venta->setFechaVenta(new \DateTime());
        $venta->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));
        $venta->setIdioma($em->getReference('VisitaYucatanBundle:Idioma', $ventaCompletaTO->getIdIdioma()));
        $venta->setMoneda($em->getReference('VisitaYucatanBundle:Moneda', $ventaCompletaTO->getIdMoneda()));
        $venta->setTipoCambio($ventaCompletaTO->getTipoCambio());
        $venta->setSubtotal($ventaCompletaTO->getCostoTotal()); //TODO recordar el el total se debe guardar en mxn, si esta en otra moneda convertir antes
        $venta->setTotal($ventaCompletaTO->getCostoTotal());

        $em->persist($venta);
        $em->flush();

        $em->getRepository('VisitaYucatanBundle:VentaDetalle')->createVentaDetalleTour($ventaCompletaTO, Generalkeys::TIPO_PRODUCTO_TOUR, $venta->getId());

        return $venta->getId();

    }

    public function createSalePackage(VentaCompletaTO $ventaCompletaTO) {



        $em = $this->getEntityManager();

        $venta = new Venta();

        $personalData = $em->getRepository('VisitaYucatanBundle:Datospersonales')->createPersonalData($ventaCompletaTO);
        $em->persist($personalData);
        $dataLocation = $em->getRepository('VisitaYucatanBundle:Datosubicacion')->createDataLocation($ventaCompletaTO);
        $em->persist($dataLocation);
        $dataReservation = $em->getRepository('VisitaYucatanBundle:DatosReserva')->createDataReserva($ventaCompletaTO->getHotelPickup(), $ventaCompletaTO->getCheckIn(), null);
        $em->persist($dataReservation);
        $datosPago = $em->getRepository('VisitaYucatanBundle:DatosPago')->createDatosPago();
        $em->persist($datosPago);
        $datosVuelo = $em->getRepository('VisitaYucatanBundle:DatosVuelo')->createDatosVuelo($ventaCompletaTO);
        $em->persist($datosVuelo);

        $venta->setDatosPersonales($personalData);
        $venta->setDatosUbicacion($dataLocation);
        $venta->setDatosReserva($dataReservation);
        $venta->setDatosPago($datosPago);
        $venta->setDatosVuelo($datosVuelo);
        $venta->setFechaVenta(new \DateTime());
        $venta->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));
        $venta->setIdioma($em->getReference('VisitaYucatanBundle:Idioma', $ventaCompletaTO->getIdIdioma()));
        $venta->setMoneda($em->getReference('VisitaYucatanBundle:Moneda', $ventaCompletaTO->getIdMoneda()));
        $venta->setTipoCambio($ventaCompletaTO->getTipoCambio());
        $venta->setSubtotal($ventaCompletaTO->getCostoTotal()); //TODO recordar el el total se debe guardar en mxn, si esta en otra moneda convertir antes
        $venta->setTotal($ventaCompletaTO->getCostoTotal());

        $em->persist($venta);
        $em->flush();

        $em->getRepository('VisitaYucatanBundle:VentaDetalle')->createVentaDetallePackage($ventaCompletaTO, Generalkeys::TIPO_PRODUCTO_PAQUETE, $venta->getId());

        return $venta->getId();

    }
    
    public function getDetailsSaleHotel($idVenta, $idContract){
        $em = $this->getEntityManager();
        $sql = "SELECT venta.id AS idventa,venta.fechaventa,venta.total,venta_detalle.numeroadultos,venta_detalle.numeromenores,venta_detalle.total AS totaldetalle
              ,hotel_idioma.nombrehotel,datos_pago.pagado,datos_pago.numeroautorizacion,datos_pago.numerooperacion,
              hotel_plan.descripcion AS plan,datos_reserva.checkin,datos_reserva.checkout,
              hotel_habitacion.nombre AS tipohabitacion,
              datos_personales.nombres,datos_personales.apellidos,
            datos_ubicacion.lada,datos_ubicacion.telefono,datos_ubicacion.email,datos_ubicacion.ciudad
            FROM venta
            INNER JOIN venta_detalle ON venta.id = venta_detalle.id_venta AND venta_detalle.id_estatus = :estatus
            INNER JOIN idioma ON idioma.id = venta.id_idioma
            INNER JOIN hotel ON venta_detalle.id_hotel = hotel.id
            INNER JOIN hotel_idioma ON hotel.id = hotel_idioma.id_hotel AND idioma.id = hotel_idioma.id_idioma
            INNER JOIN hotel_contrato ON hotel.id = hotel_contrato.id_hotel AND hotel_contrato.id = :contrato
            INNER JOIN hotel_plan ON hotel_contrato.id_plan = hotel_plan.id
            INNER JOIN datos_pago ON datos_pago.id = venta.id_datospago
            INNER JOIN datos_reserva ON datos_reserva.id = venta.id_datosreserva
            INNER JOIN hotel_habitacion ON venta_detalle.id_hotel_habitacion = hotel_habitacion.id,
            datos_personales,datos_ubicacion
            WHERE venta.id = :idVenta
            AND venta.id_estatus = :estatus
            AND venta.id_datospersonales = datos_personales.id
            AND venta.id_datosubicacion = datos_ubicacion.id;";
        $params['idVenta'] = $idVenta;
        $params['estatus'] = Estatuskeys::ESTATUS_ACTIVO;
        $params['contrato'] = $idContract;

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }

    public function findVentaById($idVenta){ // todo no se esta utilizando
        $em = $this->getEntityManager();
        $sql = "SELECT venta.id AS idreserva,venta.fechaventa,venta.total,venta_detalle.numeromenores,venta_detalle.numeroadultos,venta_detalle.tipoproducto,
                datos_personales.nombres,datos_personales.apellidos,datos_ubicacion.telefono,datos_ubicacion.email,datos_pago.pagado,tour.descripcion AS descripciontour
                FROM venta
                INNER JOIN venta_detalle ON venta.id = venta_detalle.id_venta
                INNER JOIN datos_personales ON venta.id_datospersonales = datos_personales.id
                INNER JOIN datos_ubicacion ON venta.id_datosubicacion = datos_ubicacion.id
                INNER JOIN datos_pago ON venta.id_datospago = datos_pago.id
                INNER JOIN datos_reserva ON venta.id_datosreserva=datos_reserva.id
                LEFT JOIN datos_vuelo ON venta.id_datosvuelo = datos_vuelo.id
                LEFT JOIN hotel ON venta_detalle.id_hotel= hotel.id
                LEFT JOIN tour ON venta_detalle.id_tour = tour.id
                LEFT JOIN paquete ON venta_detalle.id_paquete = paquete.id
                LEFT JOIN hotel_habitacion ON venta_detalle.id_hotel_habitacion = hotel_habitacion.id
                WHERE venta.id_estatus = :estatus
                AND venta.id = :idVenta
                AND venta_detalle.id_estatus = :estatus";
        $params['estatus'] = Estatuskeys::ESTATUS_ACTIVO;
        $params['idVenta'] = $idVenta;
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }
}