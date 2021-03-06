<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosPago
 *
 * @ORM\Table(name="datos_pago")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\DatosPagoRepository")
 */
class DatosPago {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="pagado", type="boolean")
     */
    private $pagado;

    /**
     * @var string
     *
     * @ORM\Column(name="tipotarjeta", type="string", length=255, nullable=true)
     */
    private $tipoTarjeta;

    /**
     * @var string
     *
     * @ORM\Column(name="numerovoucher", type="string", length=255, nullable=true)
     */
    private $numeroVoucher;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroautorizacion", type="string", length=255, nullable=true)
     */
    private $numeroAutorizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="numerooperacion", type="string", length=255, nullable=true)
     */
    private $numeroOperacion;


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
     * Set pagado
     *
     * @param boolean $pagado
     *
     * @return DatosPago
     */
    public function setPagado($pagado)
    {
        $this->pagado = $pagado;

        return $this;
    }

    /**
     * Get pagado
     *
     * @return bool
     */
    public function getPagado()
    {
        return $this->pagado;
    }

    /**
     * Set numeroAutorizacion
     *
     * @param string $numeroAutorizacion
     *
     * @return DatosPago
     */
    public function setNumeroAutorizacion($numeroAutorizacion)
    {
        $this->numeroAutorizacion = $numeroAutorizacion;

        return $this;
    }

    /**
     * Get numeroAutorizacion
     *
     * @return string
     */
    public function getNumeroAutorizacion()
    {
        return $this->numeroAutorizacion;
    }

    /**
     * Set numeroOperacion
     *
     * @param string $numeroOperacion
     *
     * @return DatosPago
     */
    public function setNumeroOperacion($numeroOperacion)
    {
        $this->numeroOperacion = $numeroOperacion;

        return $this;
    }

    /**
     * Get numeroOperacion
     *
     * @return string
     */
    public function getNumeroOperacion()
    {
        return $this->numeroOperacion;
    }

    /**
     * Set tipoTarjeta
     *
     * @param string $tipoTarjeta
     *
     * @return DatosPago
     */
    public function setTipoTarjeta($tipoTarjeta)
    {
        $this->tipoTarjeta = $tipoTarjeta;

        return $this;
    }

    /**
     * Get tipoTarjeta
     *
     * @return string
     */
    public function getTipoTarjeta()
    {
        return $this->tipoTarjeta;
    }

    /**
     * Set numeroVoucher
     *
     * @param string $numeroVoucher
     *
     * @return DatosPago
     */
    public function setNumeroVoucher($numeroVoucher)
    {
        $this->numeroVoucher = $numeroVoucher;

        return $this;
    }

    /**
     * Get numeroVoucher
     *
     * @return string
     */
    public function getNumeroVoucher()
    {
        return $this->numeroVoucher;
    }
}
