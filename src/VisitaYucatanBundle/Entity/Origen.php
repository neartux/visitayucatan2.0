<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Origen
 *
 * @ORM\Table(name="origen")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\OrigenRepository")
 */
class Origen
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
     * @ORM\Column(name="descripcion", type="string", length=50)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="origen")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\OneToMany(targetEntity="TourOrigen", mappedBy="origen")
     */
    private $tourOrigen;

    /**
     * Constructor
     */
    public function __construct(){
        $this->tourOrigen = new ArrayCollection();
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
     * @return Origen
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
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return Origen
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
     * Add tourOrigen
     *
     * @param \VisitaYucatanBundle\Entity\TourOrigen $tourOrigen
     *
     * @return Origen
     */
    public function addTourOrigen(\VisitaYucatanBundle\Entity\TourOrigen $tourOrigen)
    {
        $this->tourOrigen[] = $tourOrigen;

        return $this;
    }

    /**
     * Remove tourOrigen
     *
     * @param \VisitaYucatanBundle\Entity\TourOrigen $tourOrigen
     */
    public function removeTourOrigen(\VisitaYucatanBundle\Entity\TourOrigen $tourOrigen)
    {
        $this->tourOrigen->removeElement($tourOrigen);
    }

    /**
     * Get tourOrigen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTourOrigen()
    {
        return $this->tourOrigen;
    }
}
