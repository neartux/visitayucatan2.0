<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ArticuloImagen
 *
 * @ORM\Table(name="articulo_imagen")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\ArticuloImagenRepository")
 */
class ArticuloImagen {
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
     * @ORM\ManyToOne(targetEntity="Articulo", inversedBy="articuloImagen")
     * @ORM\JoinColumn(name="id_articulo", referencedColumnName="id", nullable=false)
     */
    private $articulo;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="articuloImagen")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\OneToMany(targetEntity="ArticuloImagenIdioma", mappedBy="articuloImagen")
     */
    private $articuloImagenIdioma;

    public function __construct(){
        $this->articuloImagenIdioma = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNombreOriginal()
    {
        return $this->nombreOriginal;
    }

    /**
     * @param string $nombreOriginal
     */
    public function setNombreOriginal($nombreOriginal)
    {
        $this->nombreOriginal = $nombreOriginal;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getTipoArchivo()
    {
        return $this->tipoArchivo;
    }

    /**
     * @param string $tipoArchivo
     */
    public function setTipoArchivo($tipoArchivo)
    {
        $this->tipoArchivo = $tipoArchivo;
    }

    /**
     * @return int
     */
    public function getFolio()
    {
        return $this->folio;
    }

    /**
     * @param int $folio
     */
    public function setFolio($folio)
    {
        $this->folio = $folio;
    }

    /**
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * @param \DateTime $fechaCreacion
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    /**
     * Set articulo
     *
     * @param \VisitaYucatanBundle\Entity\Articulo $articulo
     *
     * @return ArticuloImagen
     */
    public function setArticulo(\VisitaYucatanBundle\Entity\Articulo $articulo)
    {
        $this->articulo = $articulo;

        return $this;
    }

    /**
     * Get articulo
     *
     * @return \VisitaYucatanBundle\Entity\Articulo
     */
    public function getArticulo()
    {
        return $this->articulo;
    }

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return ArticuloImagen
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
     * Add articuloImagenIdioma
     *
     * @param \VisitaYucatanBundle\Entity\ArticuloImagenIdioma $articuloImagenIdioma
     *
     * @return ArticuloImagen
     */
    public function addArticuloImagenIdioma(\VisitaYucatanBundle\Entity\ArticuloImagenIdioma $articuloImagenIdioma)
    {
        $this->articuloImagenIdioma[] = $articuloImagenIdioma;

        return $this;
    }

    /**
     * Remove articuloImagenIdioma
     *
     * @param \VisitaYucatanBundle\Entity\ArticuloImagenIdioma $articuloImagenIdioma
     */
    public function removeArticuloImagenIdioma(\VisitaYucatanBundle\Entity\ArticuloImagenIdioma $articuloImagenIdioma)
    {
        $this->articuloImagenIdioma->removeElement($articuloImagenIdioma);
    }

    /**
     * Get articuloImagenIdioma
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticuloImagenIdioma()
    {
        return $this->articuloImagenIdioma;
    }
}
