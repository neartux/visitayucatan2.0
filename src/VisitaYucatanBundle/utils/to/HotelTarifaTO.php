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

}