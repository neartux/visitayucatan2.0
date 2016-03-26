<?php
/**
 * User: ricardo
 * Date: 16/02/16
 */

namespace VisitaYucatanBundle\utils\to;


use Doctrine\Common\Collections\ArrayCollection;

class TourTO {
    private $id;
    private $idtourorigen;
    private $descripcion;
    private $circuito;
    private $tarifaadulto;
    private $tarifamenor;
    private $minimopersonas;
    private $vendido;
    private $promovido;
    private $nombreTour;
    private $descripcionTour;
    private $principalImage;
    private $simboloMoneda;
    private $imagesTour;
    private $soloAdultos;
    private $origen;
    private $tipoCambio;
    private $tarifaAdultoFormat;
    private $tarifaMenorFormat;
    private $costTwoAdults;

    public function __construct(){
        $this->imagesTour = new ArrayCollection();
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
    public function getTarifaadulto()
    {
        return $this->tarifaadulto;
    }

    /**
     * @param mixed $tarifaadulto
     */
    public function setTarifaadulto($tarifaadulto)
    {
        $this->tarifaadulto = $tarifaadulto;
    }

    /**
     * @return mixed
     */
    public function getTarifamenor()
    {
        return $this->tarifamenor;
    }

    /**
     * @param mixed $tarifamenor
     */
    public function setTarifamenor($tarifamenor)
    {
        $this->tarifamenor = $tarifamenor;
    }

    /**
     * @return mixed
     */
    public function getMinimopersonas()
    {
        return $this->minimopersonas;
    }

    /**
     * @param mixed $minimopersonas
     */
    public function setMinimopersonas($minimopersonas)
    {
        $this->minimopersonas = $minimopersonas;
    }

    /**
     * @return mixed
     */
    public function getVendido()
    {
        return $this->vendido;
    }

    /**
     * @param mixed $vendido
     */
    public function setVendido($vendido)
    {
        $this->vendido = $vendido;
    }

    /**
     * @return mixed
     */
    public function getPromovido()
    {
        return $this->promovido;
    }

    /**
     * @param mixed $promovido
     */
    public function setPromovido($promovido)
    {
        $this->promovido = $promovido;
    }

    /**
     * @return mixed
     */
    public function getIdtourorigen()
    {
        return $this->idtourorigen;
    }

    /**
     * @param mixed $idtourorigen
     */
    public function setIdtourorigen($idtourorigen)
    {
        $this->idtourorigen = $idtourorigen;
    }

    /**
     * @return mixed
     */
    public function getNombreTour()
    {
        return $this->nombreTour;
    }

    /**
     * @param mixed $nombreTour
     */
    public function setNombreTour($nombreTour)
    {
        $this->nombreTour = $nombreTour;
    }

    /**
     * @return mixed
     */
    public function getDescripcionTour()
    {
        return $this->descripcionTour;
    }

    /**
     * @param mixed $descripcionTour
     */
    public function setDescripcionTour($descripcionTour)
    {
        $this->descripcionTour = $descripcionTour;
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
    public function getImagesTour()
    {
        return $this->imagesTour;
    }

    /**
     * @param mixed $imagesTour
     */
    public function setImagesTour($imagesTour)
    {
        $this->imagesTour = $imagesTour;
    }

    /**
     * @return mixed
     */
    public function getSoloAdultos()
    {
        return $this->soloAdultos;
    }

    /**
     * @param mixed $soloAdultos
     */
    public function setSoloAdultos($soloAdultos)
    {
        $this->soloAdultos = $soloAdultos;
    }

    /**
     * @return mixed
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * @param mixed $origen
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;
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
    public function getTarifaAdultoFormat()
    {
        return $this->tarifaAdultoFormat;
    }

    /**
     * @param mixed $tarifaAdultoFormat
     */
    public function setTarifaAdultoFormat($tarifaAdultoFormat)
    {
        $this->tarifaAdultoFormat = $tarifaAdultoFormat;
    }


    /**
     * @return mixed
     */
    public function getTarifaMenorFormat()
    {
        return $this->tarifaMenorFormat;
    }

    /**
     * @param mixed $tarifaMenorFormat
     */
    public function setTarifaMenorFormat($tarifaMenorFormat)
    {
        $this->tarifaMenorFormat = $tarifaMenorFormat;
    }

    /**
     * @return mixed
     */
    public function getCostTwoAdults()
    {
        return $this->costTwoAdults;
    }

    /**
     * @param mixed $costTwoAdults
     */
    public function setCostTwoAdults($costTwoAdults)
    {
        $this->costTwoAdults = $costTwoAdults;
    }


}