<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotelcontacto
 *
 * @ORM\Table(name="hotel_contacto")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\HotelcontactoRepository")
 */
class Hotelcontacto
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Datospersonales")
     * @ORM\JoinColumn(name="id_datospersonales", referencedColumnName="id", nullable=false)
     */
    private $datosPersonales;

    /**
     * @ORM\OneToOne(targetEntity="Datosubicacion")
     * @ORM\JoinColumn(name="id_datosubicacion", referencedColumnName="id", nullable=false)
     */
    private $datosUbicacion;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel", inversedBy="hotelContacto")
     * @ORM\JoinColumn(name="id_hotel", referencedColumnName="id", nullable=false)
     */
    private $hotel;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="hotelContacto")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datosPersonales
     *
     * @param \VisitaYucatanBundle\Entity\Datospersonales $datosPersonales
     *
     * @return Hotelcontacto
     */
    public function setDatosPersonales(\VisitaYucatanBundle\Entity\Datospersonales $datosPersonales)
    {
        $this->datosPersonales = $datosPersonales;

        return $this;
    }

    /**
     * Get datosPersonales
     *
     * @return \VisitaYucatanBundle\Entity\Datospersonales
     */
    public function getDatosPersonales()
    {
        return $this->datosPersonales;
    }

    /**
     * Set datosUbicacion
     *
     * @param \VisitaYucatanBundle\Entity\Datosubicacion $datosUbicacion
     *
     * @return Hotelcontacto
     */
    public function setDatosUbicacion(\VisitaYucatanBundle\Entity\Datosubicacion $datosUbicacion)
    {
        $this->datosUbicacion = $datosUbicacion;

        return $this;
    }

    /**
     * Get datosUbicacion
     *
     * @return \VisitaYucatanBundle\Entity\Datosubicacion
     */
    public function getDatosUbicacion()
    {
        return $this->datosUbicacion;
    }

    /**
     * Set hotel
     *
     * @param \VisitaYucatanBundle\Entity\Hotel $hotel
     *
     * @return Hotelcontacto
     */
    public function setHotel(\VisitaYucatanBundle\Entity\Hotel $hotel)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return \VisitaYucatanBundle\Entity\Hotel
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return Hotelcontacto
     */
    public function setEstatus(\VisitaYucatanBundle\Entity\Estatus $estatus)
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * Get estatus
     *
     * @return \VisitaYucatanBundle\Entity\Estatus
     */
    public function getEstatus()
    {
        return $this->estatus;
    }
}
