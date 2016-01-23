<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tourimagen
 *
 * @ORM\Table(name="tour_imagen")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\TourimagenRepository")
 */
class Tourimagen
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
     * @ORM\Column(name="tipoarchivo", type="string", length=20)
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
     * @ORM\Column(name="fechacreacion", type="datetimetz")
     */
    private $fechacreacion;

    /**
     * @var bool
     *
     * @ORM\Column(name="principal", type="boolean")
     */
    private $principal;

    /**
     * @ORM\ManyToOne(targetEntity="Tour", inversedBy="tourImagen")
     * @ORM\JoinColumn(name="id_tour", referencedColumnName="id", nullable=false)
     */
    private $tour;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="tourImagen")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

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
     * Set nombreoriginal
     *
     * @param string $nombreoriginal
     *
     * @return Tourimagen
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
     * @return Tourimagen
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
     * @return Tourimagen
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
     * @return Tourimagen
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
     * @return Tourimagen
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
     * Set principal
     *
     * @param boolean $principal
     *
     * @return Tourimagen
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
     * Set tour
     *
     * @param \VisitaYucatanBundle\Entity\Tour $tour
     *
     * @return Tourimagen
     */
    public function setTour(\VisitaYucatanBundle\Entity\Tour $tour)
    {
        $this->tour = $tour;

        return $this;
    }

    /**
     * Get tour
     *
     * @return \VisitaYucatanBundle\Entity\Tour
     */
    public function getTour()
    {
        return $this->tour;
    }

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return Tourimagen
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
     * Set fechacreacion
     *
     * @param \DateTime $fechacreacion
     *
     * @return Tourimagen
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
}
