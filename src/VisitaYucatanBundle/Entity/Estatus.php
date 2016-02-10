<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Estatus
 *
 * @ORM\Table(name="estatus")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\EstatusRepository")
 */
class Estatus
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
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="Moneda", mappedBy="estatus")
     */
    private $moneda;

    /**
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="estatus")
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="Tour", mappedBy="estatus")
     */
    private $tour;

    /**
     * @ORM\OneToMany(targetEntity="Idioma", mappedBy="estatus")
     */
    private $idioma;

    /**
     * @ORM\OneToMany(targetEntity="Tourimagen", mappedBy="estatus")
     */
    private $tourImagen;

    /**
     * @ORM\OneToMany(targetEntity="Touridioma", mappedBy="estatus")
     */
    private $tourIdioma;

    /**
     * @ORM\OneToMany(targetEntity="Destino", mappedBy="estatus")
     */
    private $destino;

    /**
     * @ORM\OneToMany(targetEntity="Hotel", mappedBy="estatus")
     */
    private $hotel;

    /**
     * @ORM\OneToMany(targetEntity="Hotelimagen", mappedBy="estatus")
     */
    private $hotelImagen;

    /**
     * @ORM\OneToMany(targetEntity="Hotelcontacto", mappedBy="estatus")
     */
    private $hotelContacto;

    /**
     * @ORM\OneToMany(targetEntity="Pagina", mappedBy="estatus")
     */
    private $pagina;

    /**
     * @ORM\OneToMany(targetEntity="Paginaimagen", mappedBy="estatus")
     */
    private $paginaImagen;

    /**
     * @ORM\OneToMany(targetEntity="Paginadescripcion", mappedBy="estatus")
     */
    private $paginaDescripcion;


    /**
     * Constructor
     */
    public function __construct(){
        $this->moneda = new ArrayCollection();
        $this->usuario = new ArrayCollection();
        $this->tour = new ArrayCollection();
        $this->idioma = new ArrayCollection();
        $this->tourImagen = new ArrayCollection();
        $this->tourIdioma = new ArrayCollection();
        $this->destino = new ArrayCollection();
        $this->hotel = new ArrayCollection();
        $this->hotelImagen = new ArrayCollection();
        $this->hotelContacto = new ArrayCollection();
        $this->pagina = new ArrayCollection();
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
     * @return Estatus
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
     * Add moneda
     *
     * @param \VisitaYucatanBundle\Entity\Moneda $moneda
     *
     * @return Estatus
     */
    public function addMoneda(\VisitaYucatanBundle\Entity\Moneda $moneda)
    {
        $this->moneda[] = $moneda;

        return $this;
    }

    /**
     * Remove moneda
     *
     * @param \VisitaYucatanBundle\Entity\Moneda $moneda
     */
    public function removeMoneda(\VisitaYucatanBundle\Entity\Moneda $moneda)
    {
        $this->moneda->removeElement($moneda);
    }

    /**
     * Get moneda
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMoneda()
    {
        return $this->moneda;
    }

    /**
     * Add usuario
     *
     * @param \VisitaYucatanBundle\Entity\Usuario $usuario
     *
     * @return Estatus
     */
    public function addUsuario(\VisitaYucatanBundle\Entity\Usuario $usuario)
    {
        $this->usuario[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \VisitaYucatanBundle\Entity\Usuario $usuario
     */
    public function removeUsuario(\VisitaYucatanBundle\Entity\Usuario $usuario)
    {
        $this->usuario->removeElement($usuario);
    }

    /**
     * Get usuario
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Add tour
     *
     * @param \VisitaYucatanBundle\Entity\Tour $tour
     *
     * @return Estatus
     */
    public function addTour(\VisitaYucatanBundle\Entity\Tour $tour)
    {
        $this->tour[] = $tour;

        return $this;
    }

    /**
     * Remove tour
     *
     * @param \VisitaYucatanBundle\Entity\Tour $tour
     */
    public function removeTour(\VisitaYucatanBundle\Entity\Tour $tour)
    {
        $this->tour->removeElement($tour);
    }

    /**
     * Get tour
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTour()
    {
        return $this->tour;
    }

    /**
     * Add idioma
     *
     * @param \VisitaYucatanBundle\Entity\Idioma $idioma
     *
     * @return Estatus
     */
    public function addIdioma(\VisitaYucatanBundle\Entity\Idioma $idioma)
    {
        $this->idioma[] = $idioma;

        return $this;
    }

    /**
     * Remove idioma
     *
     * @param \VisitaYucatanBundle\Entity\Idioma $idioma
     */
    public function removeIdioma(\VisitaYucatanBundle\Entity\Idioma $idioma)
    {
        $this->idioma->removeElement($idioma);
    }

    /**
     * Get idioma
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * Add tourImagen
     *
     * @param \VisitaYucatanBundle\Entity\Tourimagen $tourImagen
     *
     * @return Estatus
     */
    public function addTourImagen(\VisitaYucatanBundle\Entity\Tourimagen $tourImagen)
    {
        $this->tourImagen[] = $tourImagen;

        return $this;
    }

    /**
     * Remove tourImagen
     *
     * @param \VisitaYucatanBundle\Entity\Tourimagen $tourImagen
     */
    public function removeTourImagen(\VisitaYucatanBundle\Entity\Tourimagen $tourImagen)
    {
        $this->tourImagen->removeElement($tourImagen);
    }

    /**
     * Get tourImagen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTourImagen()
    {
        return $this->tourImagen;
    }

    /**
     * Add tourIdioma
     *
     * @param \VisitaYucatanBundle\Entity\Touridioma $tourIdioma
     *
     * @return Estatus
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
     * Add destino
     *
     * @param \VisitaYucatanBundle\Entity\Destino $destino
     *
     * @return Estatus
     */
    public function addDestino(\VisitaYucatanBundle\Entity\Destino $destino)
    {
        $this->destino[] = $destino;

        return $this;
    }

    /**
     * Remove destino
     *
     * @param \VisitaYucatanBundle\Entity\Destino $destino
     */
    public function removeDestino(\VisitaYucatanBundle\Entity\Destino $destino)
    {
        $this->destino->removeElement($destino);
    }

    /**
     * Get destino
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Add hotel
     *
     * @param \VisitaYucatanBundle\Entity\Hotel $hotel
     *
     * @return Estatus
     */
    public function addHotel(\VisitaYucatanBundle\Entity\Hotel $hotel)
    {
        $this->hotel[] = $hotel;

        return $this;
    }

    /**
     * Remove hotel
     *
     * @param \VisitaYucatanBundle\Entity\Hotel $hotel
     */
    public function removeHotel(\VisitaYucatanBundle\Entity\Hotel $hotel)
    {
        $this->hotel->removeElement($hotel);
    }

    /**
     * Get hotel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * Add hotelImagen
     *
     * @param \VisitaYucatanBundle\Entity\Hotelimagen $hotelImagen
     *
     * @return Estatus
     */
    public function addHotelImagen(\VisitaYucatanBundle\Entity\Hotelimagen $hotelImagen)
    {
        $this->hotelImagen[] = $hotelImagen;

        return $this;
    }

    /**
     * Remove hotelImagen
     *
     * @param \VisitaYucatanBundle\Entity\Hotelimagen $hotelImagen
     */
    public function removeHotelImagen(\VisitaYucatanBundle\Entity\Hotelimagen $hotelImagen)
    {
        $this->hotelImagen->removeElement($hotelImagen);
    }

    /**
     * Get hotelImagen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotelImagen()
    {
        return $this->hotelImagen;
    }

    /**
     * Add hotelContacto
     *
     * @param \VisitaYucatanBundle\Entity\Hotelcontacto $hotelContacto
     *
     * @return Estatus
     */
    public function addHotelContacto(\VisitaYucatanBundle\Entity\Hotelcontacto $hotelContacto)
    {
        $this->hotelContacto[] = $hotelContacto;

        return $this;
    }

    /**
     * Remove hotelContacto
     *
     * @param \VisitaYucatanBundle\Entity\Hotelcontacto $hotelContacto
     */
    public function removeHotelContacto(\VisitaYucatanBundle\Entity\Hotelcontacto $hotelContacto)
    {
        $this->hotelContacto->removeElement($hotelContacto);
    }

    /**
     * Get hotelContacto
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotelContacto()
    {
        return $this->hotelContacto;
    }

    /**
     * Add pagina
     *
     * @param \VisitaYucatanBundle\Entity\Pagina $pagina
     *
     * @return Estatus
     */
    public function addPagina(\VisitaYucatanBundle\Entity\Pagina $pagina)
    {
        $this->pagina[] = $pagina;

        return $this;
    }

    /**
     * Remove pagina
     *
     * @param \VisitaYucatanBundle\Entity\Pagina $pagina
     */
    public function removePagina(\VisitaYucatanBundle\Entity\Pagina $pagina)
    {
        $this->pagina->removeElement($pagina);
    }

    /**
     * Get pagina
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPagina()
    {
        return $this->pagina;
    }

    /**
     * Add paginaImagen
     *
     * @param \VisitaYucatanBundle\Entity\Paginaimagen $paginaImagen
     *
     * @return Estatus
     */
    public function addPaginaImagen(\VisitaYucatanBundle\Entity\Paginaimagen $paginaImagen)
    {
        $this->paginaImagen[] = $paginaImagen;

        return $this;
    }

    /**
     * Remove paginaImagen
     *
     * @param \VisitaYucatanBundle\Entity\Paginaimagen $paginaImagen
     */
    public function removePaginaImagen(\VisitaYucatanBundle\Entity\Paginaimagen $paginaImagen)
    {
        $this->paginaImagen->removeElement($paginaImagen);
    }

    /**
     * Get paginaImagen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaginaImagen()
    {
        return $this->paginaImagen;
    }

    /**
     * Add paginaDescripcion
     *
     * @param \VisitaYucatanBundle\Entity\Paginadescripcion $paginaDescripcion
     *
     * @return Estatus
     */
    public function addPaginaDescripcion(\VisitaYucatanBundle\Entity\Paginadescripcion $paginaDescripcion)
    {
        $this->paginaDescripcion[] = $paginaDescripcion;

        return $this;
    }

    /**
     * Remove paginaDescripcion
     *
     * @param \VisitaYucatanBundle\Entity\Paginadescripcion $paginaDescripcion
     */
    public function removePaginaDescripcion(\VisitaYucatanBundle\Entity\Paginadescripcion $paginaDescripcion)
    {
        $this->paginaDescripcion->removeElement($paginaDescripcion);
    }

    /**
     * Get paginaDescripcion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaginaDescripcion()
    {
        return $this->paginaDescripcion;
    }
}
