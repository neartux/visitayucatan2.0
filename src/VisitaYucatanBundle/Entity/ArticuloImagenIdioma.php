<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticuloImagenIdioma
 *
 * @ORM\Table(name="articulo_imagen_descripcion")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\ArticuloImagenIdiomaRepository")
 */
class ArticuloImagenIdioma {
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
     * @ORM\ManyToOne(targetEntity="ArticuloImagen", inversedBy="articuloImagenIdioma")
     * @ORM\JoinColumn(name="id_articulo_imagen", referencedColumnName="id", nullable=false)
     */
    private $articuloImagen;

    /**
     * @ORM\ManyToOne(targetEntity="Idioma", inversedBy="articuloImagenIdioma")
     * @ORM\JoinColumn(name="id_imagen_idioma", referencedColumnName="id", nullable=false)
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
     * Set articuloImagen
     *
     * @param \VisitaYucatanBundle\Entity\ArticuloImagen $articuloImagen
     *
     * @return ArticuloImagenIdioma
     */
    public function setArticuloImagen(\VisitaYucatanBundle\Entity\ArticuloImagen $articuloImagen)
    {
        $this->articuloImagen = $articuloImagen;

        return $this;
    }

    /**
     * Get articuloImagen
     *
     * @return \VisitaYucatanBundle\Entity\ArticuloImagen
     */
    public function getArticuloImagen()
    {
        return $this->articuloImagen;
    }

    /**
     * Set idioma
     *
     * @param \VisitaYucatanBundle\Entity\Idioma $idioma
     *
     * @return ArticuloImagenIdioma
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
