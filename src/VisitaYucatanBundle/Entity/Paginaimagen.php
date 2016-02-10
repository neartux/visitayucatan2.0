<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paginaimagen
 *
 * @ORM\Table(name="pagina_imagen")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\PaginaimagenRepository")
 */
class Paginaimagen {
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
     * @ORM\Column(name="nombre_original", type="string", length=255)
     */
    private $nombreOriginal;

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
     * @ORM\Column(name="tipo_archivo", type="string", length=50)
     */
    private $tipoArchivo;

    /**
     * @var int
     *
     * @ORM\Column(name="folio", type="integer")
     */
    private $folio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime")
     */
    private $fechaCreacion;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="paginaImagen")
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
     * Set nombreOriginal
     *
     * @param string $nombreOriginal
     *
     * @return Paginaimagen
     */
    public function setNombreOriginal($nombreOriginal)
    {
        $this->nombreOriginal = $nombreOriginal;

        return $this;
    }

    /**
     * Get nombreOriginal
     *
     * @return string
     */
    public function getNombreOriginal()
    {
        return $this->nombreOriginal;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Paginaimagen
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
     * @return Paginaimagen
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
     * Set tipoArchivo
     *
     * @param string $tipoArchivo
     *
     * @return Paginaimagen
     */
    public function setTipoArchivo($tipoArchivo)
    {
        $this->tipoArchivo = $tipoArchivo;

        return $this;
    }

    /**
     * Get tipoArchivo
     *
     * @return string
     */
    public function getTipoArchivo()
    {
        return $this->tipoArchivo;
    }

    /**
     * Set folio
     *
     * @param integer $folio
     *
     * @return Paginaimagen
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Paginaimagen
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return Paginaimagen
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
