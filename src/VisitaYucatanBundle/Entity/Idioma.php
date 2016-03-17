<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Idioma
 *
 * @ORM\Table(name="idioma")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\IdiomaRepository")
 */
class Idioma
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
     * @ORM\Column(name="descripcion", type="string", length=100)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="abreviatura", type="string", length=50)
     */
    private $abreviatura;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="idioma")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\OneToMany(targetEntity="Touridioma", mappedBy="idioma")
     */
    private $tourIdioma;

    /**
     * @ORM\OneToMany(targetEntity="Hotelidioma", mappedBy="idioma")
     */
    private $hotelIdioma;

    /**
     * @ORM\OneToMany(targetEntity="HotelHabitacionIdioma", mappedBy="idioma")
     */
    private $hotelHabitacionIdioma;

    /**
     * @ORM\OneToMany(targetEntity="PaqueteIdioma", mappedBy="idioma")
     */
    private $paqueteIdioma;

    /**
     * @ORM\OneToMany(targetEntity="PaqueteItinerario", mappedBy="idioma")
     */
    private $paqueteItinerario;

    /**
     * Idioma constructor.
     * @param $tourIdioma
     */
    public function __construct() {
        $this->tourIdioma = new ArrayCollection();
        $this->hotelIdioma = new ArrayCollection();
        $this->hotelHabitacionIdioma = new ArrayCollection();
        $this->paqueteIdioma = new ArrayCollection();
        $this->paqueteItinerario = new ArrayCollection();
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

    public function setId($id)
    {
        $this->id = $id;

        //return $this;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Idioma
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
     * Set abreviatura
     *
     * @param string $abreviatura
     *
     * @return Idioma
     */
    public function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;

        return $this;
    }

    /**
     * Get abreviatura
     *
     * @return string
     */
    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Idioma
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return Idioma
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
     * Add tourIdioma
     *
     * @param \VisitaYucatanBundle\Entity\Touridioma $tourIdioma
     *
     * @return Idioma
     */
    public function addTourIdioma(\VisitaYucatanBundle\Entity\Touridioma $tourIdioma)
    {
        $this->tourIdioma[] = $tourIdioma;

        return $this;
    }

    /**
     * Remove tourIdioma
     *
     * @param \VisitaYucatanBundle\Entity\Touridioma $tourIdioma
     */
    public function removeTourIdioma(\VisitaYucatanBundle\Entity\Touridioma $tourIdioma)
    {
        $this->tourIdioma->removeElement($tourIdioma);
    }

    /**
     * Get tourIdioma
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTourIdioma()
    {
        return $this->tourIdioma;
    }

    /**
     * Add hotelIdioma
     *
     * @param \VisitaYucatanBundle\Entity\Hotelidioma $hotelIdioma
     *
     * @return Idioma
     */
    public function addHotelIdioma(\VisitaYucatanBundle\Entity\Hotelidioma $hotelIdioma)
    {
        $this->hotelIdioma[] = $hotelIdioma;

        return $this;
    }

    /**
     * Remove hotelIdioma
     *
     * @param \VisitaYucatanBundle\Entity\Hotelidioma $hotelIdioma
     */
    public function removeHotelIdioma(\VisitaYucatanBundle\Entity\Hotelidioma $hotelIdioma)
    {
        $this->hotelIdioma->removeElement($hotelIdioma);
    }

    /**
     * Get hotelIdioma
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotelIdioma()
    {
        return $this->hotelIdioma;
    }

    /**
     * Add paqueteIdioma
     *
     * @param \VisitaYucatanBundle\Entity\PaqueteIdioma $paqueteIdioma
     *
     * @return Idioma
     */
    public function addPaqueteIdioma(\VisitaYucatanBundle\Entity\PaqueteIdioma $paqueteIdioma)
    {
        $this->paqueteIdioma[] = $paqueteIdioma;

        return $this;
    }

    /**
     * Remove paqueteIdioma
     *
     * @param \VisitaYucatanBundle\Entity\PaqueteIdioma $paqueteIdioma
     */
    public function removePaqueteIdioma(\VisitaYucatanBundle\Entity\PaqueteIdioma $paqueteIdioma)
    {
        $this->paqueteIdioma->removeElement($paqueteIdioma);
    }

    /**
     * Get paqueteIdioma
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaqueteIdioma()
    {
        return $this->paqueteIdioma;
    }

    /**
     * Add paqueteItinerario
     *
     * @param \VisitaYucatanBundle\Entity\PaqueteItinerario $paqueteItinerario
     *
     * @return Idioma
     */
    public function addPaqueteItinerario(\VisitaYucatanBundle\Entity\PaqueteItinerario $paqueteItinerario)
    {
        $this->paqueteItinerario[] = $paqueteItinerario;

        return $this;
    }

    /**
     * Remove paqueteItinerario
     *
     * @param \VisitaYucatanBundle\Entity\PaqueteItinerario $paqueteItinerario
     */
    public function removePaqueteItinerario(\VisitaYucatanBundle\Entity\PaqueteItinerario $paqueteItinerario)
    {
        $this->paqueteItinerario->removeElement($paqueteItinerario);
    }

    /**
     * Get paqueteItinerario
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaqueteItinerario()
    {
        return $this->paqueteItinerario;
    }

    /**
     * Add hotelHabitacionIdioma
     *
     * @param \VisitaYucatanBundle\Entity\HotelHabitacionIdioma $hotelHabitacionIdioma
     *
     * @return Idioma
     */
    public function addHotelHabitacionIdioma(\VisitaYucatanBundle\Entity\HotelHabitacionIdioma $hotelHabitacionIdioma)
    {
        $this->hotelHabitacionIdioma[] = $hotelHabitacionIdioma;

        return $this;
    }

    /**
     * Remove hotelHabitacionIdioma
     *
     * @param \VisitaYucatanBundle\Entity\HotelHabitacionIdioma $hotelHabitacionIdioma
     */
    public function removeHotelHabitacionIdioma(\VisitaYucatanBundle\Entity\HotelHabitacionIdioma $hotelHabitacionIdioma)
    {
        $this->hotelHabitacionIdioma->removeElement($hotelHabitacionIdioma);
    }

    /**
     * Get hotelHabitacionIdioma
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotelHabitacionIdioma()
    {
        return $this->hotelHabitacionIdioma;
    }
}
