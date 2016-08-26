<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaqueteCombinacionHotel
 *
 * @ORM\Table(name="paquete_combinacion_hotel")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\PaqueteCombinacionHotelRepository")
 */
class PaqueteCombinacionHotel {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="noches", type="integer")
     */
    private $noches;

    /**
     * @var int
     *
     * @ORM\Column(name="dias", type="integer")
     */
    private $dias;

    /**
     * @var float
     *
     * @ORM\Column(name="costosencillo", type="float")
     */
    private $costoSencillo;

    /**
     * @var float
     *
     * @ORM\Column(name="costodoble", type="float")
     */
    private $costoDoble;

    /**
     * @var float
     *
     * @ORM\Column(name="costotriple", type="float")
     */
    private $costoTriple;

    /**
     * @var float
     *
     * @ORM\Column(name="costocuadruple", type="float")
     */
    private $costoCuadruple;

    /**
     * @var float
     *
     * @ORM\Column(name="costomenor", type="float")
     */
    private $costoMenor;

    /**
     * @ORM\ManyToOne(targetEntity="Paquete", inversedBy="paqueteCombinacionHotel")
     * @ORM\JoinColumn(name="id_paquete", referencedColumnName="id", nullable=false)
     */
    private $paquete;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="paqueteCombinacionHotel")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel", inversedBy="paqueteCombinacionHotel")
     * @ORM\JoinColumn(name="id_hotel", referencedColumnName="id", nullable=false)
     */
    private $hotel;

    /**
     * @ORM\OneToMany(targetEntity="VentaDetalle", mappedBy="paqueteCombinacionHotel")
     */
    private $ventaDetalle;


    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

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
     * Set noches
     *
     * @param integer $noches
     *
     * @return PaqueteCombinacionHotel
     */
    public function setNoches($noches)
    {
        $this->noches = $noches;

        return $this;
    }

    /**
     * Get noches
     *
     * @return int
     */
    public function getNoches()
    {
        return $this->noches;
    }

    /**
     * Set dias
     *
     * @param integer $dias
     *
     * @return PaqueteCombinacionHotel
     */
    public function setDias($dias)
    {
        $this->dias = $dias;

        return $this;
    }

    /**
     * Get dias
     *
     * @return int
     */
    public function getDias()
    {
        return $this->dias;
    }

    /**
     * Set costoSencillo
     *
     * @param float $costoSencillo
     *
     * @return PaqueteCombinacionHotel
     */
    public function setCostoSencillo($costoSencillo)
    {
        $this->costoSencillo = $costoSencillo;

        return $this;
    }

    /**
     * Get costoSencillo
     *
     * @return float
     */
    public function getCostoSencillo()
    {
        return $this->costoSencillo;
    }

    /**
     * Set costoDoble
     *
     * @param float $costoDoble
     *
     * @return PaqueteCombinacionHotel
     */
    public function setCostoDoble($costoDoble)
    {
        $this->costoDoble = $costoDoble;

        return $this;
    }

    /**
     * Get costoDoble
     *
     * @return float
     */
    public function getCostoDoble()
    {
        return $this->costoDoble;
    }

    /**
     * Set costoTriple
     *
     * @param float $costoTriple
     *
     * @return PaqueteCombinacionHotel
     */
    public function setCostoTriple($costoTriple)
    {
        $this->costoTriple = $costoTriple;

        return $this;
    }

    /**
     * Get costoTriple
     *
     * @return float
     */
    public function getCostoTriple()
    {
        return $this->costoTriple;
    }

    /**
     * Set costoCuadruple
     *
     * @param float $costoCuadruple
     *
     * @return PaqueteCombinacionHotel
     */
    public function setCostoCuadruple($costoCuadruple)
    {
        $this->costoCuadruple = $costoCuadruple;

        return $this;
    }

    /**
     * Get costoCuadruple
     *
     * @return float
     */
    public function getCostoCuadruple()
    {
        return $this->costoCuadruple;
    }

    /**
     * Set costoMenor
     *
     * @param float $costoMenor
     *
     * @return PaqueteCombinacionHotel
     */
    public function setCostoMenor($costoMenor)
    {
        $this->costoMenor = $costoMenor;

        return $this;
    }

    /**
     * Get costoMenor
     *
     * @return float
     */
    public function getCostoMenor()
    {
        return $this->costoMenor;
    }

    /**
     * Set paquete
     *
     * @param \VisitaYucatanBundle\Entity\Paquete $paquete
     *
     * @return PaqueteCombinacionHotel
     */
    public function setPaquete(\VisitaYucatanBundle\Entity\Paquete $paquete)
    {
        $this->paquete = $paquete;

        return $this;
    }

    /**
     * Get paquete
     *
     * @return \VisitaYucatanBundle\Entity\Paquete
     */
    public function getPaquete()
    {
        return $this->paquete;
    }

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return PaqueteCombinacionHotel
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
     * Set hotel
     *
     * @param \VisitaYucatanBundle\Entity\Hotel $hotel
     *
     * @return PaqueteCombinacionHotel
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
}
