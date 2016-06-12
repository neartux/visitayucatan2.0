<?php
/**
 * User: ricardo
 * Date: 11/06/16
 */

namespace VisitaYucatanBundle\utils\to;


class VentaCompletaTO{
    private $idVenta;
    private $idIdioma;
    private $idMoneda;
    private $tipoCambio;
    private $nombres;
    private $apellidos;
    private $lada;
    private $telefono;
    private $email;
    private $ciudad;
    private $numeroAdultos;
    private $numeroMenores;
    private $costoAdulto;
    private $costoMenor;
    private $hotelPickup;
    private $checkIn;
    private $checkOut;
    private $aerolinea;
    private $numeroVuelo;
    private $fechaLlegada;
    private $horaLlegada;
    private $costoTotal;

    /**
     * @return mixed
     */
    public function getIdVenta()
    {
        return $this->idVenta;
    }

    /**
     * @param mixed $idVenta
     */
    public function setIdVenta($idVenta)
    {
        $this->idVenta = $idVenta;
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
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * @param mixed $nombres
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @param mixed $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return mixed
     */
    public function getLada()
    {
        return $this->lada;
    }

    /**
     * @param mixed $lada
     */
    public function setLada($lada)
    {
        $this->lada = $lada;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * @param mixed $ciudad
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
    }

    /**
     * @return mixed
     */
    public function getNumeroAdultos()
    {
        return $this->numeroAdultos;
    }

    /**
     * @param mixed $numeroAdultos
     */
    public function setNumeroAdultos($numeroAdultos)
    {
        $this->numeroAdultos = $numeroAdultos;
    }

    /**
     * @return mixed
     */
    public function getNumeroMenores()
    {
        return $this->numeroMenores;
    }

    /**
     * @param mixed $numeroMenores
     */
    public function setNumeroMenores($numeroMenores)
    {
        $this->numeroMenores = $numeroMenores;
    }

    /**
     * @return mixed
     */
    public function getCostoAdulto()
    {
        return $this->costoAdulto;
    }

    /**
     * @param mixed $costoAdulto
     */
    public function setCostoAdulto($costoAdulto)
    {
        $this->costoAdulto = $costoAdulto;
    }

    /**
     * @return mixed
     */
    public function getCostoMenor()
    {
        return $this->costoMenor;
    }

    /**
     * @param mixed $costoMenor
     */
    public function setCostoMenor($costoMenor)
    {
        $this->costoMenor = $costoMenor;
    }

    /**
     * @return mixed
     */
    public function getHotelPickup()
    {
        return $this->hotelPickup;
    }

    /**
     * @param mixed $hotelPickup
     */
    public function setHotelPickup($hotelPickup)
    {
        $this->hotelPickup = $hotelPickup;
    }

    /**
     * @return mixed
     */
    public function getCheckIn()
    {
        return $this->checkIn;
    }

    /**
     * @param mixed $checkIn
     */
    public function setCheckIn($checkIn)
    {
        $this->checkIn = $checkIn;
    }

    /**
     * @return mixed
     */
    public function getCheckOut()
    {
        return $this->checkOut;
    }

    /**
     * @param mixed $checkOut
     */
    public function setCheckOut($checkOut)
    {
        $this->checkOut = $checkOut;
    }

    /**
     * @return mixed
     */
    public function getAerolinea()
    {
        return $this->aerolinea;
    }

    /**
     * @param mixed $aerolinea
     */
    public function setAerolinea($aerolinea)
    {
        $this->aerolinea = $aerolinea;
    }

    /**
     * @return mixed
     */
    public function getNumeroVuelo()
    {
        return $this->numeroVuelo;
    }

    /**
     * @param mixed $numeroVuelo
     */
    public function setNumeroVuelo($numeroVuelo)
    {
        $this->numeroVuelo = $numeroVuelo;
    }

    /**
     * @return mixed
     */
    public function getFechaLlegada()
    {
        return $this->fechaLlegada;
    }

    /**
     * @param mixed $fechaLlegada
     */
    public function setFechaLlegada($fechaLlegada)
    {
        $this->fechaLlegada = $fechaLlegada;
    }

    /**
     * @return mixed
     */
    public function getHoraLlegada()
    {
        return $this->horaLlegada;
    }

    /**
     * @param mixed $horaLlegada
     */
    public function setHoraLlegada($horaLlegada)
    {
        $this->horaLlegada = $horaLlegada;
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
          
             
}