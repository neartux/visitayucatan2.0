<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moneda
 *
 * @ORM\Table(name="moneda")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\MonedaRepository")
 */
class Moneda
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
     * @ORM\Column(name="simbolo", type="string", length=255)
     */
    private $simbolo;

    /**
     * @var float
     *
     * @ORM\Column(name="tipo_cambio", type="float")
     */
    private $tipoCambio;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="moneda")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\OneToMany(targetEntity="Venta", mappedBy="moneda")
     */
    private $venta;

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
     * @return Moneda
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
     * Set simbolo
     *
     * @param string $simbolo
     *
     * @return Moneda
     */
    public function setSimbolo($simbolo)
    {
        $this->simbolo = $simbolo;

        return $this;
    }

    /**
     * Get simbolo
     *
     * @return string
     */
    public function getSimbolo()
    {
        return $this->simbolo;
    }

    /**
     * Set tipoCambio
     *
     * @param float $tipoCambio
     *
     * @return Moneda
     */
    public function setTipoCambio($tipoCambio)
    {
        $this->tipoCambio = $tipoCambio;

        return $this;
    }

    /**
     * Get tipoCambio
     *
     * @return float
     */
    public function getTipoCambio()
    {
        return $this->tipoCambio;
    }



    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return Moneda
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
        $this->venta = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ventum
     *
     * @param \VisitaYucatanBundle\Entity\Venta $ventum
     *
     * @return Moneda
     */
    public function addVentum(\VisitaYucatanBundle\Entity\Venta $ventum)
    {
        $this->venta[] = $ventum;

        return $this;
    }

    /**
     * Remove ventum
     *
     * @param \VisitaYucatanBundle\Entity\Venta $ventum
     */
    public function removeVentum(\VisitaYucatanBundle\Entity\Venta $ventum)
    {
        $this->venta->removeElement($ventum);
    }

    /**
     * Get venta
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVenta()
    {
        return $this->venta;
    }
}
