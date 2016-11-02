<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Venta
 *
 * @ORM\Table(name="venta")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\VentaRepository")
 */
class Venta {
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
     * @ORM\Column(name="fechaventa", type="datetime")
     */
    private $fechaVenta;

    /**
     * @var float
     *
     * @ORM\Column(name="subtotal", type="float")
     */
    private $subtotal;

    /**
     * @var float
     *
     * @ORM\Column(name="impuesto", type="float", nullable=true)
     */
    private $impuesto;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;

    /**
     * @var float
     *
     * @ORM\Column(name="tipocambio", type="float")
     */
    private $tipoCambio;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="venta")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\ManyToOne(targetEntity="Idioma", inversedBy="venta")
     * @ORM\JoinColumn(name="id_idioma", referencedColumnName="id", nullable=false)
     */
    private $idioma;

    /**
     * @ORM\ManyToOne(targetEntity="Moneda", inversedBy="venta")
     * @ORM\JoinColumn(name="id_moneda", referencedColumnName="id", nullable=false)
     */
    private $moneda;

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
     * @ORM\OneToOne(targetEntity="DatosVuelo")
     * @ORM\JoinColumn(name="id_datosvuelo", referencedColumnName="id", nullable=true)
     */
    private $datosVuelo;

    /**
     * @ORM\OneToOne(targetEntity="DatosReserva")
     * @ORM\JoinColumn(name="id_datosreserva", referencedColumnName="id", nullable=true)
     */
    private $datosReserva;

    /**
     * @ORM\OneToOne(targetEntity="DatosPago")
     * @ORM\JoinColumn(name="id_datospago", referencedColumnName="id", nullable=false)
     */
    private $datosPago;

    /**
     * @ORM\OneToMany(targetEntity="VentaDetalle", mappedBy="venta")
     */
    private $ventaDetalle;


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
     * Set fechaVenta
     *
     * @param \DateTime $fechaVenta
     *
     * @return Venta
     */
    public function setFechaVenta($fechaVenta)
    {
        $this->fechaVenta = $fechaVenta;

        return $this;
    }

    /**
     * Get fechaVenta
     *
     * @return \DateTime
     */
    public function getFechaVenta()
    {
        return $this->fechaVenta;
    }

    /**
     * Set subtotal
     *
     * @param float $subtotal
     *
     * @return Venta
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
     * @return Venta
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
     * @return Venta
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
     * Set tipoCambio
     *
     * @param float $tipoCambio
     *
     * @return Venta
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
     * @return Venta
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
     * Set idioma
     *
     * @param \VisitaYucatanBundle\Entity\Idioma $idioma
     *
     * @return Venta
     */
    public function setIdioma(\VisitaYucatanBundle\Entity\Idioma $idioma)
    {
        $this->idioma = $idioma;

        return $this;
    }

    /**
     * Get idioma
     *
     * @return \VisitaYucatanBundle\Entity\Idioma
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * Set moneda
     *
     * @param \VisitaYucatanBundle\Entity\Moneda $moneda
     *
     * @return Venta
     */
    public function setMoneda(\VisitaYucatanBundle\Entity\Moneda $moneda)
    {
        $this->moneda = $moneda;

        return $this;
    }

    /**
     * Get moneda
     *
     * @return \VisitaYucatanBundle\Entity\Moneda
     */
    public function getMoneda()
    {
        return $this->moneda;
    }

    /**
     * Set datosPersonales
     *
     * @param \VisitaYucatanBundle\Entity\Datospersonales $datosPersonales
     *
     * @return Venta
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
     * @return Venta
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
     * Set datosVuelo
     *
     * @param \VisitaYucatanBundle\Entity\DatosVuelo $datosVuelo
     *
     * @return Venta
     */
    public function setDatosVuelo(\VisitaYucatanBundle\Entity\DatosVuelo $datosVuelo = null)
    {
        $this->datosVuelo = $datosVuelo;

        return $this;
    }

    /**
     * Get datosVuelo
     *
     * @return \VisitaYucatanBundle\Entity\DatosVuelo
     */
    public function getDatosVuelo()
    {
        return $this->datosVuelo;
    }

    /**
     * Set datosPago
     *
     * @param \VisitaYucatanBundle\Entity\DatosPago $datosPago
     *
     * @return Venta
     */
    public function setDatosPago(\VisitaYucatanBundle\Entity\DatosPago $datosPago)
    {
        $this->datosPago = $datosPago;

        return $this;
    }

    /**
     * Get datosPago
     *
     * @return \VisitaYucatanBundle\Entity\DatosPago
     */
    public function getDatosPago()
    {
        return $this->datosPago;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ventaDetalle = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ventaDetalle
     *
     * @param \VisitaYucatanBundle\Entity\VentaDetalle $ventaDetalle
     *
     * @return Venta
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
     * Set datosReserva
     *
     * @param \VisitaYucatanBundle\Entity\DatosReserva $datosReserva
     *
     * @return Venta
     */
    public function setDatosReserva(\VisitaYucatanBundle\Entity\DatosReserva $datosReserva = null)
    {
        $this->datosReserva = $datosReserva;

        return $this;
    }

    /**
     * Get datosReserva
     *
     * @return \VisitaYucatanBundle\Entity\DatosReserva
     */
    public function getDatosReserva()
    {
        return $this->datosReserva;
    }
}
