<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VentaDetalle
 *
 * @ORM\Table(name="venta_detalle")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\VentaDetalleRepository")
 */
class VentaDetalle {
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
     * @ORM\Column(name="tipoproducto", type="integer")
     */
    private $tipoProducto;

    /**
     * @var int
     *
     * @ORM\Column(name="numeroadultos", type="integer", nullable=true)
     */
    private $numeroAdultos;

    /**
     * @var int
     *
     * @ORM\Column(name="numeromenores", type="integer", nullable=true)
     */
    private $numeroMenores;

    /**
     * @var float
     *
     * @ORM\Column(name="costoadulto", type="float", nullable=true)
     */
    private $costoAdulto;

    /**
     * @var float
     *
     * @ORM\Column(name="costomenor", type="float", nullable=true)
     */
    private $costoMenor;

    /**
     * @var float
     *
     * @ORM\Column(name="subtotal", type="float")
     */
    private $subtotal;

    /**
     * @var float
     *
     * @ORM\Column(name="impuesto", type="float")
     */
    private $impuesto;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="ventaDetalle")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\ManyToOne(targetEntity="Venta", inversedBy="ventaDetalle")
     * @ORM\JoinColumn(name="id_venta", referencedColumnName="id", nullable=false)
     */
    private $venta;


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
     * Set tipoProducto
     *
     * @param integer $tipoProducto
     *
     * @return VentaDetalle
     */
    public function setTipoProducto($tipoProducto)
    {
        $this->tipoProducto = $tipoProducto;

        return $this;
    }

    /**
     * Get tipoProducto
     *
     * @return int
     */
    public function getTipoProducto()
    {
        return $this->tipoProducto;
    }

    /**
     * Set numeroAdultos
     *
     * @param integer $numeroAdultos
     *
     * @return VentaDetalle
     */
    public function setNumeroAdultos($numeroAdultos)
    {
        $this->numeroAdultos = $numeroAdultos;

        return $this;
    }

    /**
     * Get numeroAdultos
     *
     * @return int
     */
    public function getNumeroAdultos()
    {
        return $this->numeroAdultos;
    }

    /**
     * Set numeroMenores
     *
     * @param integer $numeroMenores
     *
     * @return VentaDetalle
     */
    public function setNumeroMenores($numeroMenores)
    {
        $this->numeroMenores = $numeroMenores;

        return $this;
    }

    /**
     * Get numeroMenores
     *
     * @return int
     */
    public function getNumeroMenores()
    {
        return $this->numeroMenores;
    }

    /**
     * Set costoAdulto
     *
     * @param float $costoAdulto
     *
     * @return VentaDetalle
     */
    public function setCostoAdulto($costoAdulto)
    {
        $this->costoAdulto = $costoAdulto;

        return $this;
    }

    /**
     * Get costoAdulto
     *
     * @return float
     */
    public function getCostoAdulto()
    {
        return $this->costoAdulto;
    }

    /**
     * Set costoMenor
     *
     * @param float $costoMenor
     *
     * @return VentaDetalle
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
     * Set subtotal
     *
     * @param float $subtotal
     *
     * @return VentaDetalle
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * Get subtotal
     *
     * @return float
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set impuesto
     *
     * @param float $impuesto
     *
     * @return VentaDetalle
     */
    public function setImpuesto($impuesto)
    {
        $this->impuesto = $impuesto;

        return $this;
    }

    /**
     * Get impuesto
     *
     * @return float
     */
    public function getImpuesto()
    {
        return $this->impuesto;
    }

    /**
     * Set total
     *
     * @param float $total
     *
     * @return VentaDetalle
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return VentaDetalle
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
     * Set venta
     *
     * @param \VisitaYucatanBundle\Entity\Venta $venta
     *
     * @return VentaDetalle
     */
    public function setVenta(\VisitaYucatanBundle\Entity\Venta $venta)
    {
        $this->venta = $venta;

        return $this;
    }

    /**
     * Get venta
     *
     * @return \VisitaYucatanBundle\Entity\Venta
     */
    public function getVenta()
    {
        return $this->venta;
    }
}
