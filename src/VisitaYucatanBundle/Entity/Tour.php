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
class Tour {
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
     * @ORM\Column(name="mapa", type="text")
     */
    private $mapa;

    /**
     * @var int
     *
     * @ORM\Column(name="minimopersonas", type="integer")
     */
    private $minimopersonas;

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
     * @ORM\OneToMany(targetEntity="Touridioma", mappedBy="tour")
     */
    private $tourIdioma;

    /**
     * @ORM\OneToMany(targetEntity="TourOrigen", mappedBy="tour")
     */
    private $tourOrigen;

    /**
     * @ORM\OneToMany(targetEntity="VentaDetalle", mappedBy="tour")
     */
    private $ventaDetalle;

    /**
     * Constructor
     */
    public function __construct(){
        $this->tourImagen = new ArrayCollection();
        $this->tourIdioma = new ArrayCollection();
        $this->tourOrigen = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
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
     * @return integer
     */
    public function getMinimopersonas()
    {
        return $this->minimopersonas;
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
     * @return boolean
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

    /**
     * Add tourIdioma
     *
     * @param \VisitaYucatanBundle\Entity\Touridioma $tourIdioma
     *
     * @return Tour
     */
    public function addTourIdioma(\VisitaYucatanBundle\Entity\Touridioma $tourIdioma)
    {
        $this->tourIdioma[] = $tourIdioma;

        return $this;
    }

    /**
     * Remove tourIdioma
     *
     * @param \VisitaYucatanBundle\Entity\Touridioma $tourIdioma
     */
    public function removeTourIdioma(\VisitaYucatanBundle\Entity\Touridioma $tourIdioma)
    {
        $this->tourIdioma->removeElement($tourIdioma);
    }

    /**
     * Get tourIdioma
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTourIdioma()
    {
        return $this->tourIdioma;
    }

    /**
     * Add tourOrigen
     *
     * @param \VisitaYucatanBundle\Entity\TourOrigen $tourOrigen
     *
     * @return Tour
     */
    public function addTourOrigen(\VisitaYucatanBundle\Entity\TourOrigen $tourOrigen)
    {
        $this->tourOrigen[] = $tourOrigen;

        return $this;
    }

    /**
     * Remove tourOrigen
     *
     * @param \VisitaYucatanBundle\Entity\TourOrigen $tourOrigen
     */
    public function removeTourOrigen(\VisitaYucatanBundle\Entity\TourOrigen $tourOrigen)
    {
        $this->tourOrigen->removeElement($tourOrigen);
    }

    /**
     * Get tourOrigen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTourOrigen()
    {
        return $this->tourOrigen;
    }

    /**
     * Add ventaDetalle
     *
     * @param \VisitaYucatanBundle\Entity\VentaDetalle $ventaDetalle
     *
     * @return Tour
     */
    public function addVentaDetalle(\VisitaYucatanBundle\Entity\VentaDetalle $ventaDetalle)
    {
        $this->ventaDetalle[] = $ventaDetalle;

        return $this;
    }

    /**
     * Remove ventaDetalle
     *
     * @param \VisitaYucatanBundle\Entity\VentaDetalle $ventaDetalle
     */
    public function removeVentaDetalle(\VisitaYucatanBundle\Entity\VentaDetalle $ventaDetalle)
    {
        $this->ventaDetalle->removeElement($ventaDetalle);
    }

    /**
     * Get ventaDetalle
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVentaDetalle()
    {
        return $this->ventaDetalle;
    }

    /**
     * Set mapa
     *
     * @param string $mapa
     *
     * @return Tour
     */
    public function setMapa($mapa)
    {
        $this->mapa = $mapa;

        return $this;
    }

    /**
     * Get mapa
     *
     * @return string
     */
    public function getMapa()
    {
        return $this->mapa;
    }
}
