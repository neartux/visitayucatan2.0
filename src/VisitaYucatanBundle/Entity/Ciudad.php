<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ciudad
 *
 * @ORM\Table(name="ciudad")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\CiudadRepository")
 */
class Ciudad {
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
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="Estado", inversedBy="ciudades")
     * @ORM\JoinColumn(name="id_estado", referencedColumnName="id", nullable=false)
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity="Hotel", mappedBy="ciudad")
     */
    private $hoteles;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Ciudad
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
     * Set estado
     *
     * @param \VisitaYucatanBundle\Entity\Estado $estado
     *
     * @return Ciudad
     */
    public function setEstado(\VisitaYucatanBundle\Entity\Estado $estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \VisitaYucatanBundle\Entity\Estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hoteles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add hotele
     *
     * @param \VisitaYucatanBundle\Entity\Hotel $hotele
     *
     * @return Ciudad
     */
    public function addHotele(\VisitaYucatanBundle\Entity\Hotel $hotele)
    {
        $this->hoteles[] = $hotele;

        return $this;
    }

    /**
     * Remove hotele
     *
     * @param \VisitaYucatanBundle\Entity\Hotel $hotele
     */
    public function removeHotele(\VisitaYucatanBundle\Entity\Hotel $hotele)
    {
        $this->hoteles->removeElement($hotele);
    }

    /**
     * Get hoteles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHoteles()
    {
        return $this->hoteles;
    }
}
