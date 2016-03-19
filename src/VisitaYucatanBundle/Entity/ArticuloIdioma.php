<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticuloIdioma
 *
 * @ORM\Table(name="articulo_idioma")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\ArticuloIdiomaRepository")
 */
class ArticuloIdioma {
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
     * @ORM\Column(name="nombre", type="text")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_corta", type="text")
     */
    private $descripcionCorta;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Articulo", inversedBy="articuloIdioma")
     * @ORM\JoinColumn(name="id_articulo", referencedColumnName="id", nullable=false)
     */
    private $articulo;

    /**
     * @ORM\ManyToOne(targetEntity="Idioma", inversedBy="articuloIdioma")
     * @ORM\JoinColumn(name="id_idioma", referencedColumnName="id", nullable=false)
     */
    private $idioma;

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
    public function getDescripcionCorta()
    {
        return $this->descripcionCorta;
    }

    /**
     * @param string $descripcionCorta
     */
    public function setDescripcionCorta($descripcionCorta)
    {
        $this->descripcionCorta = $descripcionCorta;
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
     * Set articulo
     *
     * @param \VisitaYucatanBundle\Entity\Articulo $articulo
     *
     * @return ArticuloIdioma
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
     * Set idioma
     *
     * @param \VisitaYucatanBundle\Entity\Idioma $idioma
     *
     * @return ArticuloIdioma
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
}
