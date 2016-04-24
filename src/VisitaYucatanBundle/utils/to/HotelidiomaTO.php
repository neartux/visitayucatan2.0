<?php
/**
 * User: ricardo
 * Date: 11/02/16
 * Time: 09:51 PM
 */

namespace VisitaYucatanBundle\utils\to;


class HotelidiomaTO {
    private $id;
    private $idHotel;
    private $idHabitacion;
    private $idIdioma;
    private $nombreHotel;
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