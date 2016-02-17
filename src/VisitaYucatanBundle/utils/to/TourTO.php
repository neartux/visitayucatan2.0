<?php
/**
 * User: ricardo
 * Date: 16/02/16
 */

namespace VisitaYucatanBundle\utils\to;


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

}