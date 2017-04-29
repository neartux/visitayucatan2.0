<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotelimagen
 *
 * @ORM\Table(name="hotel_imagen")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\HotelimagenRepository")
 */
class Hotelimagen
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
     * @ORM\Column(name="nombreoriginal", type="string", length=255)
     */
    private $nombreoriginal;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="tipoarchivo", type="string", length=50)
     */
    private $tipoarchivo;

    /**
     * @var int
     *
     * @ORM\Column(name="folio", type="integer")
     */
    private $folio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechacreacion", type="datetime")
     */
    private $fechacreacion;

    /**
     * @var bool
     *
     * @ORM\Column(name="principal", type="boolean")
     */
    private $principal;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel", inversedBy="hotelImagen")
     * @ORM\JoinColumn(name="id_hotel", referencedColumnName="id", nullable=false)
     */
    private $hotel;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="hotelImagen")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;


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
     * Set nombreoriginal
     *
     * @param string $nombreoriginal
     *
     * @return Hotelimagen
     */
    public function setNombreoriginal($nombreoriginal)
    {
        $this->nombreoriginal = $nombreoriginal;

        return $this;
    }

    /**
     * Get nombreoriginal
     *
     * @return string
     */
    public function getNombreoriginal()
    {
        return $this->nombreoriginal;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Hotelimagen
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Hotelimagen
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set tipoarchivo
     *
     * @param string $tipoarchivo
     *
     * @return Hotelimagen
     */
    public function setTipoarchivo($tipoarchivo)
    {
        $this->tipoarchivo = $tipoarchivo;

        return $this;
    }

    /**
     * Get tipoarchivo
     *
     * @return string
     */
    public function getTipoarchivo()
    {
        return $this->tipoarchivo;
    }

    /**
     * Set folio
     *
     * @param integer $folio
     *
     * @return Hotelimagen
     */
    public function setFolio($folio)
    {
        $this->folio = $folio;

        return $this;
    }

    /**
     * Get folio
     *
     * @return int
     */
    public function getFolio()
    {
        return $this->folio;
    }

    /**
     * Set fechacreacion
     *
     * @param \DateTime $fechacreacion
     *
     * @return Hotelimagen
     */
    public function setFechacreacion($fechacreacion)
    {
        $this->fechacreacion = $fechacreacion;

        return $this;
    }

    /**
     * Get fechacreacion
     *
     * @return \DateTime
     */
    public function getFechacreacion()
    {
        return $this->fechacreacion;
    }

    /**
     * Set principal
     *
     * @param boolean $principal
     *
     * @return Hotelimagen
     */
    public function setPrincipal($principal)
    {
        $this->principal = $principal;

        return $this;
    }

    /**
     * Get principal
     *
     * @return bool
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * Set hotel
     *
     * @param \VisitaYucatanBundle\Entity\Hotel $hotel
     *
     * @return Hotelimagen
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

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return Hotelimagen
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
}
