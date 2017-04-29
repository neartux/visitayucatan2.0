<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * HotelPlan
 *
 * @ORM\Table(name="hotel_plan")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\HotelPlanRepository")
 */
class HotelPlan{
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
     * @ORM\Column(name="descripcion", type="string", length=100)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="hotelPlan")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\OneToMany(targetEntity="HotelContrato", mappedBy="hotelPlan")
     */
    private $hotelContrato;

    /**
     * HotelPlan constructor.
     */
    public function __construct() {
        $this->hotelContrato = new ArrayCollection();
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
     * @return HotelPlan
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
     * @return HotelPlan
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
     * Add hotelContrato
     *
     * @param \VisitaYucatanBundle\Entity\HotelContrato $hotelContrato
     *
     * @return HotelPlan
     */
    public function addHotelContrato(\VisitaYucatanBundle\Entity\HotelContrato $hotelContrato)
    {
        $this->hotelContrato[] = $hotelContrato;

        return $this;
    }

    /**
     * Remove hotelContrato
     *
     * @param \VisitaYucatanBundle\Entity\HotelContrato $hotelContrato
     */
    public function removeHotelContrato(\VisitaYucatanBundle\Entity\HotelContrato $hotelContrato)
    {
        $this->hotelContrato->removeElement($hotelContrato);
    }

    /**
     * Get hotelContrato
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotelContrato()
    {
        return $this->hotelContrato;
    }
}
