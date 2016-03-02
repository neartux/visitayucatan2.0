<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HabitacionIdioma
 *
 * @ORM\Table(name="hotel_habitacion_idioma")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\HotelHabitacionIdiomaRepository")
 */
class HotelHabitacionIdioma {
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
     * @ORM\ManyToOne(targetEntity="HotelHabitacion", inversedBy="hotelHabitacionIdioma")
     * @ORM\JoinColumn(name="id_hotel_habitacion", referencedColumnName="id", nullable=false)
     */
    private $hotelHabitacion;

    /**
     * @ORM\ManyToOne(targetEntity="Idioma", inversedBy="hotelHabitacionIdioma")
     * @ORM\JoinColumn(name="id_idioma", referencedColumnName="id", nullable=false)
     */
    private $idioma;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="hotelHabitacionIdioma")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;


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
     * @return HabitacionIdioma
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
     * Set hotelHabitacion
     *
     * @param \VisitaYucatanBundle\Entity\HotelHabitacion $hotelHabitacion
     *
     * @return HotelHabitacionIdioma
     */
    public function setHotelHabitacion(\VisitaYucatanBundle\Entity\HotelHabitacion $hotelHabitacion)
    {
        $this->hotelHabitacion = $hotelHabitacion;

        return $this;
    }

    /**
     * Get hotelHabitacion
     *
     * @return \VisitaYucatanBundle\Entity\HotelHabitacion
     */
    public function getHotelHabitacion()
    {
        return $this->hotelHabitacion;
    }

    /**
     * Set idioma
     *
     * @param \VisitaYucatanBundle\Entity\Idioma $idioma
     *
     * @return HotelHabitacionIdioma
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
     * @return HotelHabitacionIdioma
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
