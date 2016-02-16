<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TourOrigen
 *
 * @ORM\Table(name="tour_origen")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\TourOrigenRepository")
 */
class TourOrigen {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="costoAdulto", type="float")
     */
    private $costoAdulto;

    /**
     * @var float
     *
     * @ORM\Column(name="costoMenor", type="float")
     */
    private $costoMenor;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="tourOrigen")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\ManyToOne(targetEntity="Tour", inversedBy="tourOrigen")
     * @ORM\JoinColumn(name="id_tour", referencedColumnName="id", nullable=false)
     */
    private $tour;

    /**
     * @ORM\ManyToOne(targetEntity="Origen", inversedBy="tourOrigen")
     * @ORM\JoinColumn(name="id_origen", referencedColumnName="id", nullable=false)
     */
    private $origen;


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
     * Set costoAdulto
     *
     * @param float $costoAdulto
     *
     * @return TourOrigen
     */
    public function setCostoAdulto($costoAdulto)
    {
        $this->costoAdulto = $costoAdulto;

        return $this;
    }

    /**
     * Get costoAdulto
     *
     * @return float
     */
    public function getCostoAdulto()
    {
        return $this->costoAdulto;
    }

    /**
     * Set costoMenor
     *
     * @param float $costoMenor
     *
     * @return TourOrigen
     */
    public function setCostoMenor($costoMenor)
    {
        $this->costoMenor = $costoMenor;

        return $this;
    }

    /**
     * Get costoMenor
     *
     * @return float
     */
    public function getCostoMenor()
    {
        return $this->costoMenor;
    }

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return TourOrigen
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
     * Set tour
     *
     * @param \VisitaYucatanBundle\Entity\Tour $tour
     *
     * @return TourOrigen
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
     * Set origen
     *
     * @param \VisitaYucatanBundle\Entity\Origen $origen
     *
     * @return TourOrigen
     */
    public function setOrigen(\VisitaYucatanBundle\Entity\Origen $origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return \VisitaYucatanBundle\Entity\Origen
     */
    public function getOrigen()
    {
        return $this->origen;
    }
}
