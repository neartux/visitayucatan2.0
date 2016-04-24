<?php
/**
 * User: ricardo
 * Date: 23/02/16
 * Time: 09:52 PM
 */

namespace VisitaYucatanBundle\utils\to;


class ContractTO {
    private $id;
    private $idHotel;
    private $idHotelPlan;
    private $idEstatus;
    private $descripcion;
    private $fechaInicio;
    private $fechaFin;
    private $edadMenor;
    private $aplicaImpuesto;
    private $ish;
    private $markup;
    private $iva;
    private $fee;

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
    public function getIdHotelPlan()
    {
        return $this->idHotelPlan;
    }

    /**
     * @param mixed $idHotelPlan
     */
    public function setIdHotelPlan($idHotelPlan)
    {
        $this->idHotelPlan = $idHotelPlan;
    }

    /**
     * @return mixed
     */
    public function getIdEstatus()
    {
        return $this->idEstatus;
    }

    /**
     * @param mixed $idEstatus
     */
    public function setIdEstatus($idEstatus)
    {
        $this->idEstatus = $idEstatus;
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
    public function getEdadMenor()
    {
        return $this->edadMenor;
    }

    /**
     * @param mixed $edadMenor
     */
    public function setEdadMenor($edadMenor)
    {
        $this->edadMenor = $edadMenor;
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


}