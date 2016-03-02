<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HotelContrato
 *
 * @ORM\Table(name="hotel_contrato")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\HotelContratoRepository")
 */
class HotelContrato {
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
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechainicio", type="date")
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechafin", type="date")
     */
    private $fechaFin;

    /**
     * @var int
     *
     * @ORM\Column(name="edadmenor", type="integer")
     */
    private $edadMenor;

    /**
     * @var bool
     *
     * @ORM\Column(name="aplicaimpuesto", type="boolean")
     */
    private $aplicaImpuesto;

    /**
     * @var float
     *
     * @ORM\Column(name="ish", type="float")
     */
    private $ish;

    /**
     * @var float
     *
     * @ORM\Column(name="markup", type="float")
     */
    private $markup;

    /**
     * @var float
     *
     * @ORM\Column(name="iva", type="float")
     */
    private $iva;

    /**
     * @var float
     *
     * @ORM\Column(name="fee", type="float")
     */
    private $fee;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel", inversedBy="hotelContrato")
     * @ORM\JoinColumn(name="id_hotel", referencedColumnName="id", nullable=false)
     */
    private $hotel;

    /**
     * @ORM\ManyToOne(targetEntity="HotelPlan", inversedBy="hotelContrato")
     * @ORM\JoinColumn(name="id_plan", referencedColumnName="id", nullable=false)
     */
    private $hotelPlan;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="hotelContrato")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\OneToMany(targetEntity="HotelTarifa", mappedBy="hotelContrato")
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return HotelContrato
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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return HotelContrato
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return HotelContrato
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set ish
     *
     * @param float $ish
     *
     * @return HotelContrato
     */
    public function setIsh($ish)
    {
        $this->ish = $ish;

        return $this;
    }

    /**
     * Get ish
     *
     * @return float
     */
    public function getIsh()
    {
        return $this->ish;
    }

    /**
     * Set markup
     *
     * @param float $markup
     *
     * @return HotelContrato
     */
    public function setMarkup($markup)
    {
        $this->markup = $markup;

        return $this;
    }

    /**
     * Get markup
     *
     * @return float
     */
    public function getMarkup()
    {
        return $this->markup;
    }

    /**
     * Set aplicaImpuesto
     *
     * @param boolean $aplicaImpuesto
     *
     * @return HotelContrato
     */
    public function setAplicaImpuesto($aplicaImpuesto)
    {
        $this->aplicaImpuesto = $aplicaImpuesto;

        return $this;
    }

    /**
     * Get aplicaImpuesto
     *
     * @return bool
     */
    public function getAplicaImpuesto()
    {
        return $this->aplicaImpuesto;
    }

    /**
     * Set iva
     *
     * @param float $iva
     *
     * @return HotelContrato
     */
    public function setIva($iva)
    {
        $this->iva = $iva;

        return $this;
    }

    /**
     * Get iva
     *
     * @return float
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set fee
     *
     * @param float $fee
     *
     * @return HotelContrato
     */
    public function setFee($fee)
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * Get fee
     *
     * @return float
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * Set edadMenor
     *
     * @param integer $edadMenor
     *
     * @return HotelContrato
     */
    public function setEdadMenor($edadMenor)
    {
        $this->edadMenor = $edadMenor;

        return $this;
    }

    /**
     * Get edadMenor
     *
     * @return int
     */
    public function getEdadMenor()
    {
        return $this->edadMenor;
    }

    /**
     * Set hotel
     *
     * @param \VisitaYucatanBundle\Entity\Hotel $hotel
     *
     * @return HotelContrato
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
     * Set hotelPlan
     *
     * @param \VisitaYucatanBundle\Entity\HotelPlan $hotelPlan
     *
     * @return HotelContrato
     */
    public function setHotelPlan(\VisitaYucatanBundle\Entity\HotelPlan $hotelPlan)
    {
        $this->hotelPlan = $hotelPlan;

        return $this;
    }

    /**
     * Get hotelPlan
     *
     * @return \VisitaYucatanBundle\Entity\HotelPlan
     */
    public function getHotelPlan()
    {
        return $this->hotelPlan;
    }

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return HotelContrato
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
