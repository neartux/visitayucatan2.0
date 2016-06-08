<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estado
 *
 * @ORM\Table(name="estado")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\EstadoRepository")
 */
class Estado {
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
     * @ORM\OneToMany(targetEntity="Ciudad", mappedBy="estado")
     */
    private $ciudades;


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
     * @return Estado
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
     * Constructor
     */
    public function __construct()
    {
        $this->ciudades = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ciudade
     *
     * @param \VisitaYucatanBundle\Entity\Ciudad $ciudade
     *
     * @return Estado
     */
    public function addCiudade(\VisitaYucatanBundle\Entity\Ciudad $ciudade)
    {
        $this->ciudades[] = $ciudade;

        return $this;
    }

    /**
     * Remove ciudade
     *
     * @param \VisitaYucatanBundle\Entity\Ciudad $ciudade
     */
    public function removeCiudade(\VisitaYucatanBundle\Entity\Ciudad $ciudade)
    {
        $this->ciudades->removeElement($ciudade);
    }

    /**
     * Get ciudades
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCiudades()
    {
        return $this->ciudades;
    }
}
