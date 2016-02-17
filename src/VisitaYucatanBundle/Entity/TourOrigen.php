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
     * @ORM\Column(name="tarifaadulto", type="float")
     */
    private $tarifaAdulto;

    /**
     * @var float
     *
     * @ORM\Column(name="tarifamenor", type="float")
     */
    private $tarifaMenor;

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
     * @return float
     */
    public function getTarifaAdulto()
    {
        return $this->tarifaAdulto;
    }

    /**
     * @param float $tarifaAdulto
     */
    public function setTarifaAdulto($tarifaAdulto)
    {
        $this->tarifaAdulto = $tarifaAdulto;
    }

    /**
     * @return float
     */
    public function getTarifaMenor()
    {
        return $this->tarifaMenor;
    }

    /**
     * @param float $tarifaMenor
     */
    public function setTarifaMenor($tarifaMenor)
    {
        $this->tarifaMenor = $tarifaMenor;
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
