<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Touridioma
 *
 * @ORM\Table(name="tour_idioma")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\TouridiomaRepository")
 */
class Touridioma
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
     * @ORM\Column(name="nombretour", type="string", length=255)
     */
    private $nombretour;

    /**
     * @var string
     *
     * @ORM\Column(name="circuito", type="string", length=255)
     */
    private $circuito;

    /**
     * @var bool
     *
     * @ORM\Column(name="soloadultos", type="boolean")
     */
    private $soloadultos;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Tour", inversedBy="tourIdioma")
     * @ORM\JoinColumn(name="id_tour", referencedColumnName="id", nullable=false)
     */
    private $tour;

    /**
     * @ORM\ManyToOne(targetEntity="Idioma", inversedBy="tourIdioma")
     * @ORM\JoinColumn(name="id_idioma", referencedColumnName="id", nullable=false)
     */
    private $idioma;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="tourIdioma")
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
     * Set nombretour
     *
     * @param string $nombretour
     *
     * @return Touridioma
     */
    public function setNombretour($nombretour)
    {
        $this->nombretour = $nombretour;

        return $this;
    }

    /**
     * Get nombretour
     *
     * @return string
     */
    public function getNombretour()
    {
        return $this->nombretour;
    }

    /**
     * Set circuito
     *
     * @param string $circuito
     *
     * @return Touridioma
     */
    public function setCircuito($circuito)
    {
        $this->circuito = $circuito;

        return $this;
    }

    /**
     * Get circuito
     *
     * @return string
     */
    public function getCircuito()
    {
        return $this->circuito;
    }

    /**
     * Set soloadultos
     *
     * @param boolean $soloadultos
     *
     * @return Touridioma
     */
    public function setSoloadultos($soloadultos)
    {
        $this->soloadultos = $soloadultos;

        return $this;
    }

    /**
     * Get soloadultos
     *
     * @return bool
     */
    public function getSoloadultos()
    {
        return $this->soloadultos;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Touridioma
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set tour
     *
     * @param \VisitaYucatanBundle\Entity\Tour $tour
     *
     * @return Touridioma
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
     * Set idioma
     *
     * @param \VisitaYucatanBundle\Entity\Idioma $idioma
     *
     * @return Touridioma
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

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return Touridioma
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
