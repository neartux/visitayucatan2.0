<?php
/**
 * User: ricardo
 * Date: 27/02/16
 * Time: 11:02 AM
 */

namespace VisitaYucatanBundle\utils\to;


class HabitacionTO {
    private $id;
    private $idHotel;
    private $nombre;
    private $descripcion;
    private $maximoInfantes;
    private $maximoMenores;
    private $maximoJuniors;
    private $maximoAdultos;
    private $capacidadMaxima;
    private $allotment;
    private $hotelTarifasTOCollection;

    public function addHotelHabitacion(\VisitaYucatanBundle\utils\to\HotelTarifaTO $hotelTarifasTOCollection) {
        $this->hotelTarifasTOCollection[] = $hotelTarifasTOCollection;

        return $this;
    }

    public function getHotelHabitacion() {
        return $this->hotelTarifasTOCollection;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdHotel()
    {
        return $this->idHotel;
    }

    /**
     * @param mixed $idHotel
     */
    public function setIdHotel($idHotel)
    {
        $this->idHotel = $idHotel;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getMaximoInfantes()
    {
        return $this->maximoInfantes;
    }

    /**
     * @param mixed $maximoInfantes
     */
    public function setMaximoInfantes($maximoInfantes)
    {
        $this->maximoInfantes = $maximoInfantes;
    }

    /**
     * @return mixed
     */
    public function getMaximoMenores()
    {
        return $this->maximoMenores;
    }

    /**
     * @param mixed $maximoMenores
     */
    public function setMaximoMenores($maximoMenores)
    {
        $this->maximoMenores = $maximoMenores;
    }

    /**
     * @return mixed
     */
    public function getMaximoJuniors()
    {
        return $this->maximoJuniors;
    }

    /**
     * @param mixed $maximoJuniors
     */
    public function setMaximoJuniors($maximoJuniors)
    {
        $this->maximoJuniors = $maximoJuniors;
    }

    /**
     * @return mixed
     */
    public function getMaximoAdultos()
    {
        return $this->maximoAdultos;
    }

    /**
     * @param mixed $maximoAdultos
     */
    public function setMaximoAdultos($maximoAdultos)
    {
        $this->maximoAdultos = $maximoAdultos;
    }

    /**
     * @return mixed
     */
    public function getCapacidadMaxima()
    {
        return $this->capacidadMaxima;
    }

    /**
     * @param mixed $capacidadMaxima
     */
    public function setCapacidadMaxima($capacidadMaxima)
    {
        $this->capacidadMaxima = $capacidadMaxima;
    }

    /**
     * @return mixed
     */
    public function getAllotment()
    {
        return $this->allotment;
    }

    /**
     * @param mixed $allotment
     */
    public function setAllotment($allotment)
    {
        $this->allotment = $allotment;
    }


}