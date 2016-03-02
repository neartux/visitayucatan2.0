<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HotelHabitacion
 *
 * @ORM\Table(name="hotel_habitacion")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\HotelHabitacionRepository")
 */
class HotelHabitacion {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var int
     *
     * @ORM\Column(name="maximoinfantes", type="integer", nullable=true)
     */
    private $maximoInfantes;

    /**
     * @var int
     *
     * @ORM\Column(name="maximomenores", type="integer")
     */
    private $maximoMenores;

    /**
     * @var int
     *
     * @ORM\Column(name="maximojuniors", type="integer", nullable=true)
     */
    private $maximoJuniors;

    /**
     * @var int
     *
     * @ORM\Column(name="maximoadultos", type="integer")
     */
    private $maximoAdultos;

    /**
     * @var int
     *
     * @ORM\Column(name="capacidadmaxima", type="integer")
     */
    private $capacidadMaxima;

    /**
     * @var int
     *
     * @ORM\Column(name="allotment", type="integer")
     */
    private $allotment;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel", inversedBy="hotelHabitacion")
     * @ORM\JoinColumn(name="id_hotel", referencedColumnName="id", nullable=false)
     */
    private $hotel;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="hotelHabitacion")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\OneToMany(targetEntity="HotelHabitacionIdioma", mappedBy="hotelHabitacion")
     */
    private $hotelHabitacionIdioma;

    /**
     * @ORM\OneToMany(targetEntity="HotelTarifa", mappedBy="hotelHabitacion")
     */
    private $hotelTarifa;

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return HotelHabitacion
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return HotelHabitacion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set maximoInfantes
     *
     * @param integer $maximoInfantes
     *
     * @return HotelHabitacion
     */
    public function setMaximoInfantes($maximoInfantes)
    {
        $this->maximoInfantes = $maximoInfantes;

        return $this;
    }

    /**
     * Get maximoInfantes
     *
     * @return int
     */
    public function getMaximoInfantes()
    {
        return $this->maximoInfantes;
    }

    /**
     * Set maximoMenores
     *
     * @param integer $maximoMenores
     *
     * @return HotelHabitacion
     */
    public function setMaximoMenores($maximoMenores)
    {
        $this->maximoMenores = $maximoMenores;

        return $this;
    }

    /**
     * Get maximoMenores
     *
     * @return int
     */
    public function getMaximoMenores()
    {
        return $this->maximoMenores;
    }

    /**
     * Set maximoJuniors
     *
     * @param integer $maximoJuniors
     *
     * @return HotelHabitacion
     */
    public function setMaximoJuniors($maximoJuniors)
    {
        $this->maximoJuniors = $maximoJuniors;

        return $this;
    }

    /**
     * Get maximoJuniors
     *
     * @return int
     */
    public function getMaximoJuniors()
    {
        return $this->maximoJuniors;
    }

    /**
     * Set maximoAdultos
     *
     * @param integer $maximoAdultos
     *
     * @return HotelHabitacion
     */
    public function setMaximoAdultos($maximoAdultos)
    {
        $this->maximoAdultos = $maximoAdultos;

        return $this;
    }

    /**
     * Get maximoAdultos
     *
     * @return int
     */
    public function getMaximoAdultos()
    {
        return $this->maximoAdultos;
    }

    /**
     * Set capacidadMaxima
     *
     * @param integer $capacidadMaxima
     *
     * @return HotelHabitacion
     */
    public function setCapacidadMaxima($capacidadMaxima)
    {
        $this->capacidadMaxima = $capacidadMaxima;

        return $this;
    }

    /**
     * Get capacidadMaxima
     *
     * @return int
     */
    public function getCapacidadMaxima()
    {
        return $this->capacidadMaxima;
    }

    /**
     * Set allotment
     *
     * @param integer $allotment
     *
     * @return HotelHabitacion
     */
    public function setAllotment($allotment)
    {
        $this->allotment = $allotment;

        return $this;
    }

    /**
     * Get allotment
     *
     * @return int
     */
    public function getAllotment()
    {
        return $this->allotment;
    }

    /**
     * Set hotel
     *
     * @param \VisitaYucatanBundle\Entity\Hotel $hotel
     *
     * @return HotelHabitacion
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
     * @return HotelHabitacion
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hotelHabitacionIdioma = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add hotelHabitacionIdioma
     *
     * @param \VisitaYucatanBundle\Entity\HotelHabitacionIdioma $hotelHabitacionIdioma
     *
     * @return HotelHabitacion
     */
    public function addHotelHabitacionIdioma(\VisitaYucatanBundle\Entity\HotelHabitacionIdioma $hotelHabitacionIdioma)
    {
        $this->hotelHabitacionIdioma[] = $hotelHabitacionIdioma;

        return $this;
    }

    /**
     * Remove hotelHabitacionIdioma
     *
     * @param \VisitaYucatanBundle\Entity\HotelHabitacionIdioma $hotelHabitacionIdioma
     */
    public function removeHotelHabitacionIdioma(\VisitaYucatanBundle\Entity\HotelHabitacionIdioma $hotelHabitacionIdioma)
    {
        $this->hotelHabitacionIdioma->removeElement($hotelHabitacionIdioma);
    }

    /**
     * Get hotelHabitacionIdioma
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotelHabitacionIdioma()
    {
        return $this->hotelHabitacionIdioma;
    }
}
