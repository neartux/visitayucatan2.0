<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosLlegada
 *
 * @ORM\Table(name="datos_llegada")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\DatosLlegadaRepository")
 */
class DatosLlegada {
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
     * @ORM\Column(name="numerovuelo", type="integer", nullable=true)
     */
    private $numeroVuelo;

    /**
     * @var string
     *
     * @ORM\Column(name="aerolinea", type="string", length=255, nullable=true)
     */
    private $aerolinea;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechallegada", type="date", nullable=true)
     */
    private $fechaLlegada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horallegada", type="date", nullable=true)
     */
    private $horaLlegada;


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
     * Set numeroVuelo
     *
     * @param integer $numeroVuelo
     *
     * @return DatosLlegada
     */
    public function setNumeroVuelo($numeroVuelo)
    {
        $this->numeroVuelo = $numeroVuelo;

        return $this;
    }

    /**
     * Get numeroVuelo
     *
     * @return int
     */
    public function getNumeroVuelo()
    {
        return $this->numeroVuelo;
    }

    /**
     * Set aerolinea
     *
     * @param string $aerolinea
     *
     * @return DatosLlegada
     */
    public function setAerolinea($aerolinea)
    {
        $this->aerolinea = $aerolinea;

        return $this;
    }

    /**
     * Get aerolinea
     *
     * @return string
     */
    public function getAerolinea()
    {
        return $this->aerolinea;
    }

    /**
     * Set fechaLlegada
     *
     * @param \DateTime $fechaLlegada
     *
     * @return DatosLlegada
     */
    public function setFechaLlegada($fechaLlegada)
    {
        $this->fechaLlegada = $fechaLlegada;

        return $this;
    }

    /**
     * Get fechaLlegada
     *
     * @return \DateTime
     */
    public function getFechaLlegada()
    {
        return $this->fechaLlegada;
    }

    /**
     * Set horaLlegada
     *
     * @param \DateTime $horaLlegada
     *
     * @return DatosLlegada
     */
    public function setHoraLlegada($horaLlegada)
    {
        $this->horaLlegada = $horaLlegada;

        return $this;
    }

    /**
     * Get horaLlegada
     *
     * @return \DateTime
     */
    public function getHoraLlegada()
    {
        return $this->horaLlegada;
    }
}

