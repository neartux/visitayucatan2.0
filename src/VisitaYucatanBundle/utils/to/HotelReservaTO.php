<?php
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 30/05/16
 * Time: 10:04 PM
 */

namespace VisitaYucatanBundle\utils\to;


class HotelReservaTO{
    private $nombreHotel;
    private $tipoHabitacion;
    private $estadiaDias;
    private $estadiaNoches;
    private $tarifaAdulto;
    private $tarifaMenor;
    private $adultos;
    private $menores;
    private $fechaInicio;
    private $fechaFin;
    private $costoTotal;
    private $simboloMoneda;
    private $idIdioma;
    private $idMoneda;
    private $tipoCambio;
    private $idHotel;
    private $idHabitacion;

    /**
     * @return mixed
     */
    public function getNombreHotel()
    {
        return $this->nombreHotel;
    }

    /**
     * @param mixed $nombreHotel
     */
    public function setNombreHotel($nombreHotel)
    {
        $this->nombreHotel = $nombreHotel;
    }

    /**
     * @return mixed
     */
    public function getTipoHabitacion()
    {
        return $this->tipoHabitacion;
    }

    /**
     * @param mixed $tipoHabitacion
     */
    public function setTipoHabitacion($tipoHabitacion)
    {
        $this->tipoHabitacion = $tipoHabitacion;
    }

    /**
     * @return mixed
     */
    public function getTarifaAdulto()
    {
        return $this->tarifaAdulto;
    }

    /**
     * @param mixed $tarifaAdulto
     */
    public function setTarifaAdulto($tarifaAdulto)
    {
        $this->tarifaAdulto = $tarifaAdulto;
    }

    /**
     * @return mixed
     */
    public function getTarifaMenor()
    {
        return $this->tarifaMenor;
    }

    /**
     * @param mixed $tarifaMenor
     */
    public function setTarifaMenor($tarifaMenor)
    {
        $this->tarifaMenor = $tarifaMenor;
    }

    /**
     * @return mixed
     */
    public function getAdultos()
    {
        return $this->adultos;
    }

    /**
     * @param mixed $adultos
     */
    public function setAdultos($adultos)
    {
        $this->adultos = $adultos;
    }

    /**
     * @return mixed
     */
    public function getMenores()
    {
        return $this->menores;
    }

    /**
     * @param mixed $menores
     */
    public function setMenores($menores)
    {
        $this->menores = $menores;
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
    public function getCostoTotal()
    {
        return $this->costoTotal;
    }

    /**
     * @param mixed $costoTotal
     */
    public function setCostoTotal($costoTotal)
    {
        $this->costoTotal = $costoTotal;
    }

    /**
     * @return mixed
     */
    public function getEstadiaDias()
    {
        return $this->estadiaDias;
    }

    /**
     * @param mixed $estadiaDias
     */
    public function setEstadiaDias($estadiaDias)
    {
        $this->estadiaDias = $estadiaDias;
    }

    /**
     * @return mixed
     */
    public function getEstadiaNoches()
    {
        return $this->estadiaNoches;
    }

    /**
     * @param mixed $estadiaNoches
     */
    public function setEstadiaNoches($estadiaNoches)
    {
        $this->estadiaNoches = $estadiaNoches;
    }

    /**
     * @return mixed
     */
    public function getSimboloMoneda()
    {
        return $this->simboloMoneda;
    }

    /**
     * @param mixed $simboloMoneda
     */
    public function setSimboloMoneda($simboloMoneda)
    {
        $this->simboloMoneda = $simboloMoneda;
    }

    /**
     * @return mixed
     */
    public function getIdIdioma()
    {
        return $this->idIdioma;
    }

    /**
     * @param mixed $idIdioma
     */
    public function setIdIdioma($idIdioma)
    {
        $this->idIdioma = $idIdioma;
    }

    /**
     * @return mixed
     */
    public function getIdMoneda()
    {
        return $this->idMoneda;
    }

    /**
     * @param mixed $idMoneda
     */
    public function setIdMoneda($idMoneda)
    {
        $this->idMoneda = $idMoneda;
    }

    /**
     * @return mixed
     */
    public function getTipoCambio()
    {
        return $this->tipoCambio;
    }

    /**
     * @param mixed $tipoCambio
     */
    public function setTipoCambio($tipoCambio)
    {
        $this->tipoCambio = $tipoCambio;
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
       
           
}