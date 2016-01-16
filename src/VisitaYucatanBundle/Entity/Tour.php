<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tour
 *
 * @ORM\Table(name="tour")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\TourRepository")
 */
class Tour
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
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="circuito", type="text", nullable=true)
     */
    private $circuito;

    /**
     * @var float
     *
     * @ORM\Column(name="tarifaadulto", type="float")
     */
    private $tarifaadulto;

    /**
     * @var float
     *
     * @ORM\Column(name="tarifamenor", type="float")
     */
    private $tarifamenor;

    /**
     * @var int
     *
     * @ORM\Column(name="minimopersonas", type="integer")
     */
    private $minimopersonas;

    /**
     * @var int
     *
     * @ORM\Column(name="vendido", type="integer", nullable=true)
     */
    private $vendido;

    /**
     * @var bool
     *
     * @ORM\Column(name="promovido", type="boolean")
     */
    private $promovido;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="tour")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\OneToMany(targetEntity="Tourimagen", mappedBy="tour")
     */
    private $tourImagen;

    /**
     * Constructor
     */
    public function __construct(){
        $this->tourImagen = new ArrayCollection();
    }

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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Tour
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
     * Set circuito
     *
     * @param string $circuito
     *
     * @return Tour
     */
    public function setCircuito($circuito)
    {
        $this->circuito = $circuito;

        return $this;
    }

    /**
     * Get circuito
     *
     * @return string
     */
    public function getCircuito()
    {
        return $this->circuito;
    }

    /**
     * Set tarifaadulto
     *
     * @param float $tarifaadulto
     *
     * @return Tour
     */
    public function setTarifaadulto($tarifaadulto)
    {
        $this->tarifaadulto = $tarifaadulto;

        return $this;
    }

    /**
     * Get tarifaadulto
     *
     * @return float
     */
    public function getTarifaadulto()
    {
        return $this->tarifaadulto;
    }

    /**
     * Set tarifamenor
     *
     * @param float $tarifamenor
     *
     * @return Tour
     */
    public function setTarifamenor($tarifamenor)
    {
        $this->tarifamenor = $tarifamenor;

        return $this;
    }

    /**
     * Get tarifamenor
     *
     * @return float
     */
    public function getTarifamenor()
    {
        return $this->tarifamenor;
    }

    /**
     * Set minimopersonas
     *
     * @param integer $minimopersonas
     *
     * @return Tour
     */
    public function setMinimopersonas($minimopersonas)
    {
        $this->minimopersonas = $minimopersonas;

        return $this;
    }

    /**
     * Get minimopersonas
     *
     * @return int
     */
    public function getMinimopersonas()
    {
        return $this->minimopersonas;
    }

    /**
     * Set vendido
     *
     * @param integer $vendido
     *
     * @return Tour
     */
    public function setVendido($vendido)
    {
        $this->vendido = $vendido;

        return $this;
    }

    /**
     * Get vendido
     *
     * @return int
     */
    public function getVendido()
    {
        return $this->vendido;
    }

    /**
     * Set promovido
     *
     * @param boolean $promovido
     *
     * @return Tour
     */
    public function setPromovido($promovido)
    {
        $this->promovido = $promovido;

        return $this;
    }

    /**
     * Get promovido
     *
     * @return bool
     */
    public function getPromovido()
    {
        return $this->promovido;
    }

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return Tour
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
     * Add tourImagen
     *
     * @param \VisitaYucatanBundle\Entity\Tourimagen $tourImagen
     *
     * @return Tour
     */
    public function addTourImagen(\VisitaYucatanBundle\Entity\Tourimagen $tourImagen)
    {
        $this->tourImagen[] = $tourImagen;

        return $this;
    }

    /**
     * Remove tourImagen
     *
     * @param \VisitaYucatanBundle\Entity\Tourimagen $tourImagen
     */
    public function removeTourImagen(\VisitaYucatanBundle\Entity\Tourimagen $tourImagen)
    {
        $this->tourImagen->removeElement($tourImagen);
    }

    /**
     * Get tourImagen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTourImagen()
    {
        return $this->tourImagen;
    }
}
