<?php
/**
 * User: ricardo
 * Date: 21/03/16
 * Time: 11:41 AM
 */

namespace VisitaYucatanBundle\utils\to;


class PaqueteTO {
    private $id;
    private $nombrePaquete;
    private $descripcionCorta;
    private $descripcionLarga;
    private $incluye;
    private $principalImage;
    private $simboloMoneda;
    private $costoSencilla;
    private $circuito;
    private $descripcion;

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
    public function getNombrePaquete()
    {
        return $this->nombrePaquete;
    }

    /**
     * @param mixed $nombrePaquete
     */
    public function setNombrePaquete($nombrePaquete)
    {
        $this->nombrePaquete = $nombrePaquete;
    }

    /**
     * @return mixed
     */
    public function getDescripcionCorta()
    {
        return $this->descripcionCorta;
    }

    /**
     * @param mixed $descripcionCorta
     */
    public function setDescripcionCorta($descripcionCorta)
    {
        $this->descripcionCorta = $descripcionCorta;
    }

    /**
     * @return mixed
     */
    public function getDescripcionLarga()
    {
        return $this->descripcionLarga;
    }

    /**
     * @param mixed $descripcionLarga
     */
    public function setDescripcionLarga($descripcionLarga)
    {
        $this->descripcionLarga = $descripcionLarga;
    }
    /**
     * @return mixed
     */
    public function getCircuito()
    {
        return $this->circuito;
    }

    /**
     * @param mixed $circuito
     */
    public function setCircuito($circuito)
    {
        $this->circuito = $circuito;
    }
    /**
     * @return mixed
     */
    public function getIncluye()
    {
        return $this->incluye;
    }

    /**
     * @param mixed $incluye
     */
    public function setIncluye($incluye)
    {
        $this->incluye = $incluye;
    }

    /**
     * @return mixed
     */
    public function getPrincipalImage()
    {
        return $this->principalImage;
    }

    /**
     * @param mixed $principalImage
     */
    public function setPrincipalImage($principalImage)
    {
        $this->principalImage = $principalImage;
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
    public function getCostoSencilla()
    {
        return $this->costoSencilla;
    }

    /**
     * @param mixed $costoSencilla
     */
    public function setCostoSencilla($costoSencilla)
    {
        $this->costoSencilla = $costoSencilla;
    }

    /**
     * @return mixed
     */
    public function getDescripcion(){
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
}