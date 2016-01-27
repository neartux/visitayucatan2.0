<?php
/**
 * User: ricardo
 * Date: 23/01/16
 */

namespace VisitaYucatanBundle\utils\to;

class TouridiomaTO {
    private $id;
    private $idTour;
    private $idIdioma;
    private $nombretour;
    private $circuito;
    private $soloadultos;
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
    public function getIdTour()
    {
        return $this->idTour;
    }

    /**
     * @param mixed $idTour
     */
    public function setIdTour($idTour)
    {
        $this->idTour = $idTour;
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
    public function getNombretour()
    {
        return $this->nombretour;
    }

    /**
     * @param mixed $nombretour
     */
    public function setNombretour($nombretour)
    {
        $this->nombretour = $nombretour;
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
    public function getSoloadultos()
    {
        return $this->soloadultos;
    }

    /**
     * @param mixed $soloadultos
     */
    public function setSoloadultos($soloadultos)
    {
        $this->soloadultos = $soloadultos;
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

}