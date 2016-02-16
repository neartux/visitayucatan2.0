<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaqueteIdioma
 *
 * @ORM\Table(name="paquete_idioma")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\PaqueteIdiomaRepository")
 */
class PaqueteIdioma {
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
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcioncorta", type="text")
     */
    private $descripcionCorta;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcionlarga", type="text")
     */
    private $descripcionLarga;

    /**
     * @var string
     *
     * @ORM\Column(name="incluye", type="text")
     */
    private $incluye;

    /**
     * @ORM\ManyToOne(targetEntity="Paquete", inversedBy="paqueteIdioma")
     * @ORM\JoinColumn(name="id_paquete", referencedColumnName="id", nullable=false)
     */
    private $paquete;

    /**
     * @ORM\ManyToOne(targetEntity="Idioma", inversedBy="paqueteIdioma")
     * @ORM\JoinColumn(name="id_idioma", referencedColumnName="id", nullable=false)
     */
    private $idioma;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="paqueteIdioma")
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return PaqueteIdioma
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
     * Set descripcionCorta
     *
     * @param string $descripcionCorta
     *
     * @return PaqueteIdioma
     */
    public function setDescripcionCorta($descripcionCorta)
    {
        $this->descripcionCorta = $descripcionCorta;

        return $this;
    }

    /**
     * Get descripcionCorta
     *
     * @return string
     */
    public function getDescripcionCorta()
    {
        return $this->descripcionCorta;
    }

    /**
     * Set descripcionLarga
     *
     * @param string $descripcionLarga
     *
     * @return PaqueteIdioma
     */
    public function setDescripcionLarga($descripcionLarga)
    {
        $this->descripcionLarga = $descripcionLarga;

        return $this;
    }

    /**
     * Get descripcionLarga
     *
     * @return string
     */
    public function getDescripcionLarga()
    {
        return $this->descripcionLarga;
    }

    /**
     * Set incluye
     *
     * @param string $incluye
     *
     * @return PaqueteIdioma
     */
    public function setIncluye($incluye)
    {
        $this->incluye = $incluye;

        return $this;
    }

    /**
     * Get incluye
     *
     * @return string
     */
    public function getIncluye()
    {
        return $this->incluye;
    }

    /**
     * Set paquete
     *
     * @param \VisitaYucatanBundle\Entity\Paquete $paquete
     *
     * @return PaqueteIdioma
     */
    public function setPaquete(\VisitaYucatanBundle\Entity\Paquete $paquete)
    {
        $this->paquete = $paquete;

        return $this;
    }

    /**
     * Get paquete
     *
     * @return \VisitaYucatanBundle\Entity\Paquete
     */
    public function getPaquete()
    {
        return $this->paquete;
    }

    /**
     * Set idioma
     *
     * @param \VisitaYucatanBundle\Entity\Idioma $idioma
     *
     * @return PaqueteIdioma
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
     * @return PaqueteIdioma
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
