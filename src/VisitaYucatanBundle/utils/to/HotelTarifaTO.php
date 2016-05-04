<?php
/**
 * User: ricardo
 * Date: 2/03/16
 */

namespace VisitaYucatanBundle\utils\to;


class HotelTarifaTO {
    private $id;
    private $fecha;
    private $sencillo;
    private $doble;
    private $triple;
    private $cuadruple;
    private $idHotel;
    private $idContrato;
    private $idHabitacion;
    private $fechaInicio;
    private $fechaFin;
    private $aplicaImpuesto;
    private $ish;
    private $markup;
    private $iva;
    private $fee;
    private $capacidadMaxima;
    private $allotment;
    private $msjAvailable;
    private $isAvailable;

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
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getSencillo()
    {
        return $this->sencillo;
    }

    /**
     * @param mixed $sencillo
     */
    public function setSencillo($sencillo)
    {
        $this->sencillo = $sencillo;
    }

    /**
     * @return mixed
     */
    public function getDoble()
    {
        return $this->doble;
    }

    /**
     * @param mixed $doble
     */
    public function setDoble($doble)
    {
        $this->doble = $doble;
    }

    /**
     * @return mixed
     */
    public function getTriple()
    {
        return $this->triple;
    }

    /**
     * @param mixed $triple
     */
    public function setTriple($triple)
    {
        $this->triple = $triple;
    }

    /**
     * @return mixed
     */
    public function getCuadruple()
    {
        return $this->cuadruple;
    }

    /**
     * @param mixed $cuadruple
     */
    public function setCuadruple($cuadruple)
    {
        $this->cuadruple = $cuadruple;
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
    public function getIdContrato()
    {
        return $this->idContrato;
    }

    /**
     * @param mixed $idContrato
     */
    public function setIdContrato($idContrato)
    {
        $this->idContrato = $idContrato;
    }

    /**
     * @return mixed
     */
    public function getIdHabitacion()
    {
        return $this->idHabitacion;
    }

    /**
     * @param mixed $idHabitacion
     */
    public function setIdHabitacion($idHabitacion)
    {
        $this->idHabitacion = $idHabitacion;
    }


    /**
     * @return mixed
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * @param mixed $fechaInicio
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    }

    /**
     * @return mixed
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * @param mixed $fechaFin
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    }

    /**
     * @return mixed
     */
    public function getAplicaImpuesto()
    {
        return $this->aplicaImpuesto;
    }

    /**
     * @param mixed $aplicaImpuesto
     */
    public function setAplicaImpuesto($aplicaImpuesto)
    {
        $this->aplicaImpuesto = $aplicaImpuesto;
    }

    /**
     * @return mixed
     */
    public function getIsh()
    {
        return $this->ish;
    }

    /**
     * @param mixed $ish
     */
    public function setIsh($ish)
    {
        $this->ish = $ish;
    }

    /**
     * @return mixed
     */
    public function getMarkup()
    {
        return $this->markup;
    }

    /**
     * @param mixed $markup
     */
    public function setMarkup($markup)
    {
        $this->markup = $markup;
    }

    /**
     * @return mixed
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * @param mixed $iva
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    }

    /**
     * @return mixed
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @param mixed $fee
     */
    public function setFee($fee)
    {
        $this->fee = $fee;
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

    /**
     * @return mixed
     */
    public function getMsjAvailable()
    {
        return $this->msjAvailable;
    }

    /**
     * @param mixed $msjAvailable
     */
    public function setMsjAvailable($msjAvailable)
    {
        $this->msjAvailable = $msjAvailable;
    }

    /**
     * @return mixed
     */
    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    /**
     * @param mixed $isAvailable
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;
    }
       
}