<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HotelTarifa
 *
 * @ORM\Table(name="hotel_tarifa")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\HotelTarifaRepository")
 */
class HotelTarifa {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var float
     *
     * @ORM\Column(name="sencillo", type="float")
     */
    private $sencillo;

    /**
     * @var float
     *
     * @ORM\Column(name="doble", type="float")
     */
    private $doble;

    /**
     * @var float
     *
     * @ORM\Column(name="triple", type="float")
     */
    private $triple;

    /**
     * @var float
     *
     * @ORM\Column(name="cuadruple", type="float")
     */
    private $cuadruple;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel", inversedBy="hotelTarifa")
     * @ORM\JoinColumn(name="id_hotel", referencedColumnName="id", nullable=false)
     */
    private $hotel;

    /**
     * @ORM\ManyToOne(targetEntity="HotelContrato", inversedBy="hotelTarifa")
     * @ORM\JoinColumn(name="id_hotel_contrato", referencedColumnName="id", nullable=false)
     */
    private $hotelContrato;

    /**
     * @ORM\ManyToOne(targetEntity="HotelHabitacion", inversedBy="hotelTarifa")
     * @ORM\JoinColumn(name="id_hotel_habitacion", referencedColumnName="id", nullable=false)
     */
    private $hotelHabitacion;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="hotelTarifa")
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return HotelTarifa
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set sencillo
     *
     * @param float $sencillo
     *
     * @return HotelTarifa
     */
    public function setSencillo($sencillo)
    {
        $this->sencillo = $sencillo;

        return $this;
    }

    /**
     * Get sencillo
     *
     * @return float
     */
    public function getSencillo()
    {
        return $this->sencillo;
    }

    /**
     * Set doble
     *
     * @param float $doble
     *
     * @return HotelTarifa
     */
    public function setDoble($doble)
    {
        $this->doble = $doble;

        return $this;
    }

    /**
     * Get doble
     *
     * @return float
     */
    public function getDoble()
    {
        return $this->doble;
    }

    /**
     * Set triple
     *
     * @param float $triple
     *
     * @return HotelTarifa
     */
    public function setTriple($triple)
    {
        $this->triple = $triple;

        return $this;
    }

    /**
     * Get triple
     *
     * @return float
     */
    public function getTriple()
    {
        return $this->triple;
    }

    /**
     * Set cuadruple
     *
     * @param float $cuadruple
     *
     * @return HotelTarifa
     */
    public function setCuadruple($cuadruple)
    {
        $this->cuadruple = $cuadruple;

        return $this;
    }

    /**
     * Get cuadruple
     *
     * @return float
     */
    public function getCuadruple()
    {
        return $this->cuadruple;
    }
}

