<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Pagina
 *
 * @ORM\Table(name="articulo")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\ArticuloRepository")
 */
class Articulo {
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
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipoarticulo", type="text")
     */
    private $tipoArticulo;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="articulo")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\OneToMany(targetEntity="ArticuloIdioma", mappedBy="articulo")
     */
    private $articuloIdioma;

    /**
     * @ORM\OneToMany(targetEntity="ArticuloImagen", mappedBy="articulo")
     */
    private $articuloImagen;

    public function __construct(){
        $this->articuloIdioma = new ArrayCollection();
        $this->articuloImagen = new ArrayCollection();
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
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return string
     */
    public function getTipoArticulo()
    {
        return $this->tipoArticulo;
    }

    /**
     * @param string $tipoArticulo
     */
    public function setTipoArticulo($tipoArticulo)
    {
        $this->tipoArticulo = $tipoArticulo;
    }


    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return Articulo
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
     * Add articuloIdioma
     *
     * @param \VisitaYucatanBundle\Entity\ArticuloIdioma $articuloIdioma
     *
     * @return Articulo
     */
    public function addArticuloIdioma(\VisitaYucatanBundle\Entity\ArticuloIdioma $articuloIdioma)
    {
        $this->articuloIdioma[] = $articuloIdioma;

        return $this;
    }

    /**
     * Remove articuloIdioma
     *
     * @param \VisitaYucatanBundle\Entity\ArticuloIdioma $articuloIdioma
     */
    public function removeArticuloIdioma(\VisitaYucatanBundle\Entity\ArticuloIdioma $articuloIdioma)
    {
        $this->articuloIdioma->removeElement($articuloIdioma);
    }

    /**
     * Get articuloIdioma
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticuloIdioma()
    {
        return $this->articuloIdioma;
    }

    /**
     * Add articuloImagen
     *
     * @param \VisitaYucatanBundle\Entity\ArticuloImagen $articuloImagen
     *
     * @return Articulo
     */
    public function addArticuloImagen(\VisitaYucatanBundle\Entity\ArticuloImagen $articuloImagen)
    {
        $this->articuloImagen[] = $articuloImagen;

        return $this;
    }

    /**
     * Remove articuloImagen
     *
     * @param \VisitaYucatanBundle\Entity\ArticuloImagen $articuloImagen
     */
    public function removeArticuloImagen(\VisitaYucatanBundle\Entity\ArticuloImagen $articuloImagen)
    {
        $this->articuloImagen->removeElement($articuloImagen);
    }

    /**
     * Get articuloImagen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticuloImagen()
    {
        return $this->articuloImagen;
    }
}
