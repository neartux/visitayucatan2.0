<?php
/**
 * User: ricardo
 * Date: 21/03/16
 * Time: 11:41 AM
 */

namespace VisitaYucatanBundle\utils\to;

use Doctrine\Common\Collections\ArrayCollection;

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
    private $itinerario;
    private $imagen;
    private $imagesPaquete;
    private $combinacionesPaquete;
    private $dias;
    private $noches;


    public function __construct(){
        $this->imagesPaquete = new ArrayCollection();
        $this->combinacionesPaquete = new ArrayCollection();
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

    /**
     * @return mixed
     */
    public function getItinerario(){
        return $this->itinerario;
    }

    /**
     * @param mixed $itinerario
     */
    public function setItinerario($itinerario){
        $this->itinerario = $itinerario;
    }

    /**
     * @return mixed
     */
    public function getImagen(){
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen){
        $this->imagen = $imagen;
    }

    /**
     * @return mixed
     */
    public function getImagesPaquete()
    {
        return $this->imagesPaquete;
    }

    /**
     * @param mixed $imagesPaquete
     */
    public function setImagesPaquete($imagesPaquete)
    {
        $this->imagesPaquete = $imagesPaquete;
    }

    /**
     * @return mixed
     */
    public function getCombinacionesPaquete()
    {
        return $this->combinacionesPaquete;
    }

    /**
     * @param mixed $combinacionesPaquete
     */
    public function setCombinacionesPaquete($combinacionesPaquete)
    {
        $this->combinacionesPaquete = $combinacionesPaquete;
    }

    /**
     * @return mixed
     */
    public function getDias()
    {
        return $this->dias;
    }

    /**
     * @param mixed $dias
     */
    public function setDias($dias)
    {
        $this->dias = $dias;
    }

    /**
     * @return mixed
     */
    public function getNoches()
    {
        return $this->noches;
    }

    /**
     * @param mixed $noches
     */
    public function setNoches($noches)
    {
        $this->noches = $noches;
    }
    
    
}