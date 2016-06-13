<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paquete
 *
 * @ORM\Table(name="paquete")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\PaqueteRepository")
 */
class Paquete {
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
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="circuito", type="string", length=255, nullable=true)
     */
    private $circuito;

    /**
     * @var bool
     *
     * @ORM\Column(name="promovido", type="boolean")
     */
    private $promovido;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="paquete")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\OneToMany(targetEntity="PaqueteIdioma", mappedBy="paquete")
     */
    private $paqueteIdioma;

    /**
     * @ORM\OneToMany(targetEntity="PaqueteItinerario", mappedBy="paquete")
     */
    private $paqueteItinerario;

    /**
     * @ORM\OneToMany(targetEntity="PaqueteImagen", mappedBy="paquete")
     */
    private $paqueteImagen;

    /**
     * @ORM\OneToMany(targetEntity="PaqueteCombinacionHotel", mappedBy="paquete")
     */
    private $paqueteCombinacionHotel;

    /**
     * @ORM\OneToMany(targetEntity="VentaDetalle", mappedBy="paquete")
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Paquete
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
     * @return Paquete
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
     * Set promovido
     *
     * @param boolean $promovido
     *
     * @return Paquete
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
     * Constructor
     */
    public function __construct()
    {
        $this->paqueteIdioma = new \Doctrine\Common\Collections\ArrayCollection();
        $this->paqueteItinerario = new \Doctrine\Common\Collections\ArrayCollection();
        $this->paqueteImagen = new \Doctrine\Common\Collections\ArrayCollection();
        $this->paqueteCombinacionHotel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return Paquete
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
     * Add paqueteIdioma
     *
     * @param \VisitaYucatanBundle\Entity\PaqueteIdioma $paqueteIdioma
     *
     * @return Paquete
     */
    public function addPaqueteIdioma(\VisitaYucatanBundle\Entity\PaqueteIdioma $paqueteIdioma)
    {
        $this->paqueteIdioma[] = $paqueteIdioma;

        return $this;
    }

    /**
     * Remove paqueteIdioma
     *
     * @param \VisitaYucatanBundle\Entity\PaqueteIdioma $paqueteIdioma
     */
    public function removePaqueteIdioma(\VisitaYucatanBundle\Entity\PaqueteIdioma $paqueteIdioma)
    {
        $this->paqueteIdioma->removeElement($paqueteIdioma);
    }

    /**
     * Get paqueteIdioma
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaqueteIdioma()
    {
        return $this->paqueteIdioma;
    }

    /**
     * Add paqueteItinerario
     *
     * @param \VisitaYucatanBundle\Entity\PaqueteItinerario $paqueteItinerario
     *
     * @return Paquete
     */
    public function addPaqueteItinerario(\VisitaYucatanBundle\Entity\PaqueteItinerario $paqueteItinerario)
    {
        $this->paqueteItinerario[] = $paqueteItinerario;

        return $this;
    }

    /**
     * Remove paqueteItinerario
     *
     * @param \VisitaYucatanBundle\Entity\PaqueteItinerario $paqueteItinerario
     */
    public function removePaqueteItinerario(\VisitaYucatanBundle\Entity\PaqueteItinerario $paqueteItinerario)
    {
        $this->paqueteItinerario->removeElement($paqueteItinerario);
    }

    /**
     * Get paqueteItinerario
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaqueteItinerario()
    {
        return $this->paqueteItinerario;
    }

    /**
     * Add paqueteImagen
     *
     * @param \VisitaYucatanBundle\Entity\PaqueteImagen $paqueteImagen
     *
     * @return Paquete
     */
    public function addPaqueteImagen(\VisitaYucatanBundle\Entity\PaqueteImagen $paqueteImagen)
    {
        $this->paqueteImagen[] = $paqueteImagen;

        return $this;
    }

    /**
     * Remove paqueteImagen
     *
     * @param \VisitaYucatanBundle\Entity\PaqueteImagen $paqueteImagen
     */
    public function removePaqueteImagen(\VisitaYucatanBundle\Entity\PaqueteImagen $paqueteImagen)
    {
        $this->paqueteImagen->removeElement($paqueteImagen);
    }

    /**
     * Get paqueteImagen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaqueteImagen()
    {
        return $this->paqueteImagen;
    }

    /**
     * Add paqueteCombinacionHotel
     *
     * @param \VisitaYucatanBundle\Entity\PaqueteCombinacionHotel $paqueteCombinacionHotel
     *
     * @return Paquete
     */
    public function addPaqueteCombinacionHotel(\VisitaYucatanBundle\Entity\PaqueteCombinacionHotel $paqueteCombinacionHotel)
    {
        $this->paqueteCombinacionHotel[] = $paqueteCombinacionHotel;

        return $this;
    }

    /**
     * Remove paqueteCombinacionHotel
     *
     * @param \VisitaYucatanBundle\Entity\PaqueteCombinacionHotel $paqueteCombinacionHotel
     */
    public function removePaqueteCombinacionHotel(\VisitaYucatanBundle\Entity\PaqueteCombinacionHotel $paqueteCombinacionHotel)
    {
        $this->paqueteCombinacionHotel->removeElement($paqueteCombinacionHotel);
    }

    /**
     * Get paqueteCombinacionHotel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaqueteCombinacionHotel()
    {
        return $this->paqueteCombinacionHotel;
    }

    /**
     * Add ventaDetalle
     *
     * @param \VisitaYucatanBundle\Entity\VentaDetalle $ventaDetalle
     *
     * @return Paquete
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
}
