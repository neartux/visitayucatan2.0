<?php

namespace VisitaYucatanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Hotel
 *
 * @ORM\Table(name="hotel")
 * @ORM\Entity(repositoryClass="VisitaYucatanBundle\Repository\HotelRepository")
 */
class Hotel {
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
     * @var string
     *
     * @ORM\Column(name="mapa", type="text", nullable=true)
     */
    private $mapa;

    /**
     * @var int
     *
     * @ORM\Column(name="estrellas", type="integer")
     */
    private $estrellas;

    /**
     * @var bool
     *
     * @ORM\Column(name="promovido", type="boolean")
     */
    private $promovido;

    /**
     * @ORM\ManyToOne(targetEntity="Estatus", inversedBy="hotel")
     * @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     */
    private $estatus;

    /**
     * @ORM\OneToOne(targetEntity="Datosubicacion")
     * @ORM\JoinColumn(name="id_datosubicacion", referencedColumnName="id", nullable=false)
     */
    private $datosUbicacion;

    /**
     * @ORM\ManyToOne(targetEntity="Destino", inversedBy="hotel")
     * @ORM\JoinColumn(name="id_destino", referencedColumnName="id", nullable=true)
     */
    private $destino;

    /**
     * @ORM\ManyToOne(targetEntity="Ciudad", inversedBy="hoteles")
     * @ORM\JoinColumn(name="id_ciudad", referencedColumnName="id", nullable=false)
     */
    private $ciudad;

    /**
     * @ORM\OneToMany(targetEntity="Hotelimagen", mappedBy="hotel")
     */
    private $hotelImagen;

    /**
     * @ORM\OneToMany(targetEntity="Hotelidioma", mappedBy="hotel")
     */
    private $hotelIdioma;

    /**
     * @ORM\OneToMany(targetEntity="Hotelcontacto", mappedBy="hotel")
     */
    private $hotelContacto;

    /**
     * @ORM\OneToMany(targetEntity="PaqueteCombinacionHotel", mappedBy="hotel")
     */
    private $paqueteCombinacionHotel;

    /**
     * @ORM\OneToMany(targetEntity="HotelFechaCierre", mappedBy="hotel")
     */
    private $hotelFechaCierre;

    /**
     * @ORM\OneToMany(targetEntity="HotelContrato", mappedBy="hotel")
     */
    private $hotelContrato;

    /**
     * @ORM\OneToMany(targetEntity="HotelHabitacion", mappedBy="hotel")
     */
    private $hotelHabitacion;

    /**
     * @ORM\OneToMany(targetEntity="VentaDetalle", mappedBy="hotel")
     */
    private $ventaDetalle;

    /**
     * Constructor
     */
    public function __construct(){
        $this->hotelImagen = new ArrayCollection();
        $this->hotelIdioma = new ArrayCollection();
        $this->hotelContacto = new ArrayCollection();
        $this->paqueteCombinacionHotel = new ArrayCollection();
        $this->hotelFechaCierre = new ArrayCollection();
        $this->hotelContrato = new ArrayCollection();
        $this->hotelHabitacion = new ArrayCollection();
//        $this->hotelTarifa = new ArrayCollection();
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
     * @return Hotel
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
     * Set estrellas
     *
     * @param integer $estrellas
     *
     * @return Hotel
     */
    public function setEstrellas($estrellas)
    {
        $this->estrellas = $estrellas;

        return $this;
    }

    /**
     * Get estrellas
     *
     * @return int
     */
    public function getEstrellas()
    {
        return $this->estrellas;
    }

    /**
     * Set promovido
     *
     * @param boolean $promovido
     *
     * @return Tour
     */
    public function setPromovido($promovido)
    {
        $this->promovido = $promovido;

        return $this;
    }

    /**
     * Get promovido
     *
     * @return bool
     */
    public function getPromovido()
    {
        return $this->promovido;
    }

    /**
     * Set estatus
     *
     * @param \VisitaYucatanBundle\Entity\Estatus $estatus
     *
     * @return Hotel
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
     * Set datosUbicacion
     *
     * @param \VisitaYucatanBundle\Entity\Datosubicacion $datosUbicacion
     *
     * @return Hotel
     */
    public function setDatosUbicacion(\VisitaYucatanBundle\Entity\Datosubicacion $datosUbicacion)
    {
        $this->datosUbicacion = $datosUbicacion;

        return $this;
    }

    /**
     * Get datosUbicacion
     *
     * @return \VisitaYucatanBundle\Entity\Datosubicacion
     */
    public function getDatosUbicacion()
    {
        return $this->datosUbicacion;
    }

    /**
     * Set destino
     *
     * @param \VisitaYucatanBundle\Entity\Destino $destino
     *
     * @return Hotel
     */
    public function setDestino(\VisitaYucatanBundle\Entity\Destino $destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return \VisitaYucatanBundle\Entity\Destino
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Add hotelImagen
     *
     * @param \VisitaYucatanBundle\Entity\Hotelimagen $hotelImagen
     *
     * @return Hotel
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
     * Add hotelIdioma
     *
     * @param \VisitaYucatanBundle\Entity\Hotelidioma $hotelIdioma
     *
     * @return Hotel
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
     * Add hotelContacto
     *
     * @param \VisitaYucatanBundle\Entity\Hotelcontacto $hotelContacto
     *
     * @return Hotel
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
     * Add paqueteCombinacionHotel
     *
     * @param \VisitaYucatanBundle\Entity\PaqueteCombinacionHotel $paqueteCombinacionHotel
     *
     * @return Hotel
     */
    public function addPaqueteCombinacionHotel(\VisitaYucatanBundle\Entity\PaqueteCombinacionHotel $paqueteCombinacionHotel)
    {
        $this->paqueteCombinacionHotel[] = $paqueteCombinacionHotel;

        return $this;
    }

    /**
     * Remove paqueteCombinacionHotel
     *
     * @param \VisitaYucatanBundle\Entity\PaqueteCombinacionHotel $paqueteCombinacionHotel
     */
    public function removePaqueteCombinacionHotel(\VisitaYucatanBundle\Entity\PaqueteCombinacionHotel $paqueteCombinacionHotel)
    {
        $this->paqueteCombinacionHotel->removeElement($paqueteCombinacionHotel);
    }

    /**
     * Get paqueteCombinacionHotel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaqueteCombinacionHotel()
    {
        return $this->paqueteCombinacionHotel;
    }

    /**
     * Add hotelFechaCierre
     *
     * @param \VisitaYucatanBundle\Entity\HotelFechaCierre $hotelFechaCierre
     *
     * @return Hotel
     */
    public function addHotelFechaCierre(\VisitaYucatanBundle\Entity\HotelFechaCierre $hotelFechaCierre)
    {
        $this->hotelFechaCierre[] = $hotelFechaCierre;

        return $this;
    }

    /**
     * Remove hotelFechaCierre
     *
     * @param \VisitaYucatanBundle\Entity\HotelFechaCierre $hotelFechaCierre
     */
    public function removeHotelFechaCierre(\VisitaYucatanBundle\Entity\HotelFechaCierre $hotelFechaCierre)
    {
        $this->hotelFechaCierre->removeElement($hotelFechaCierre);
    }

    /**
     * Get hotelFechaCierre
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotelFechaCierre()
    {
        return $this->hotelFechaCierre;
    }

    /**
     * Add hotelContrato
     *
     * @param \VisitaYucatanBundle\Entity\HotelContrato $hotelContrato
     *
     * @return Hotel
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

    /**
     * Add hotelHabitacion
     *
     * @param \VisitaYucatanBundle\Entity\HotelHabitacion $hotelHabitacion
     *
     * @return Hotel
     */
    public function addHotelHabitacion(\VisitaYucatanBundle\Entity\HotelHabitacion $hotelHabitacion)
    {
        $this->hotelHabitacion[] = $hotelHabitacion;

        return $this;
    }

    /**
     * Remove hotelHabitacion
     *
     * @param \VisitaYucatanBundle\Entity\HotelHabitacion $hotelHabitacion
     */
    public function removeHotelHabitacion(\VisitaYucatanBundle\Entity\HotelHabitacion $hotelHabitacion)
    {
        $this->hotelHabitacion->removeElement($hotelHabitacion);
    }

    /**
     * Get hotelHabitacion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotelHabitacion()
    {
        return $this->hotelHabitacion;
    }

//    /**
//     * Add hotelTarifa
//     *
//     * @param \VisitaYucatanBundle\Entity\HotelTarifa $hotelTarifa
//     *
//     * @return Hotel
//     */
//    public function addHotelTarifa(\VisitaYucatanBundle\Entity\HotelTarifa $hotelTarifa)
//    {
//        $this->hotelTarifa[] = $hotelTarifa;
//
//        return $this;
//    }
//
//    /**
//     * Remove hotelTarifa
//     *
//     * @param \VisitaYucatanBundle\Entity\HotelTarifa $hotelTarifa
//     */
//    public function removeHotelTarifa(\VisitaYucatanBundle\Entity\HotelTarifa $hotelTarifa)
//    {
//        $this->hotelTarifa->removeElement($hotelTarifa);
//    }
//
//    /**
//     * Get hotelTarifa
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getHotelTarifa()
//    {
//        return $this->hotelTarifa;
//    }

    /**
     * Set ciudad
     *
     * @param \VisitaYucatanBundle\Entity\Ciudad $ciudad
     *
     * @return Hotel
     */
    public function setCiudad(\VisitaYucatanBundle\Entity\Ciudad $ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return \VisitaYucatanBundle\Entity\Ciudad
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Add ventaDetalle
     *
     * @param \VisitaYucatanBundle\Entity\VentaDetalle $ventaDetalle
     *
     * @return Hotel
     */
    public function addVentaDetalle(\VisitaYucatanBundle\Entity\VentaDetalle $ventaDetalle)
    {
        $this->ventaDetalle[] = $ventaDetalle;

        return $this;
    }

    /**
     * Remove ventaDetalle
     *
     * @param \VisitaYucatanBundle\Entity\VentaDetalle $ventaDetalle
     */
    public function removeVentaDetalle(\VisitaYucatanBundle\Entity\VentaDetalle $ventaDetalle)
    {
        $this->ventaDetalle->removeElement($ventaDetalle);
    }

    /**
     * Get ventaDetalle
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVentaDetalle()
    {
        return $this->ventaDetalle;
    }

    /**
     * Set mapa
     *
     * @param string $mapa
     *
     * @return Hotel
     */
    public function setMapa($mapa)
    {
        $this->mapa = $mapa;

        return $this;
    }

    /**
     * Get mapa
     *
     * @return string
     */
    public function getMapa()
    {
        return $this->mapa;
    }
}
