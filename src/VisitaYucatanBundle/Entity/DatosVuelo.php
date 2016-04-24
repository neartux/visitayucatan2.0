<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosVuelo
 *
 * @ORM\Table(name="datos_vuelo")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\DatosVueloRepository")
 */
class DatosVuelo
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
     * @var \DateTime
     *
     * @ORM\Column(name="fechallegada", type="date")
     */
    private $fechaLlegada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horallegada", type="time")
     */
    private $horaLlegada;

    /**
     * @var string
     *
     * @ORM\Column(name="numerovuelo", type="string", length=50)
     */
    private $numeroVuelo;

    /**
     * @var string
     *
     * @ORM\Column(name="aerolinea", type="string", length=100)
     */
    private $aerolinea;


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
     * Set fechaLlegada
     *
     * @param \DateTime $fechaLlegada
     *
     * @return DatosVuelo
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
     * @return DatosVuelo
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

    /**
     * Set numeroVuelo
     *
     * @param string $numeroVuelo
     *
     * @return DatosVuelo
     */
    public function setNumeroVuelo($numeroVuelo)
    {
        $this->numeroVuelo = $numeroVuelo;

        return $this;
    }

    /**
     * Get numeroVuelo
     *
     * @return string
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
     * @return DatosVuelo
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
}

