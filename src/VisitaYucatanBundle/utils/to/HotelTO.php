<?php
/**
 * User: ricardo
 * Date: 3/02/16
 */

namespace VisitaYucatanBundle\utils\to;


class HotelTO {

    private $id;
    private $descripcion;
    private $estrellas;
    private $direccion;
    private $telefono;
    private $idDestino;
    private $promovido;
    private $idEstatus;

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
    public function getEstrellas()
    {
        return $this->estrellas;
    }

    /**
     * @param mixed $estrellas
     */
    public function setEstrellas($estrellas)
    {
        $this->estrellas = $estrellas;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
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
    public function getIdDestino()
    {
        return $this->idDestino;
    }

    /**
     * @param mixed $idDestino
     */
    public function setIdDestino($idDestino)
    {
        $this->idDestino = $idDestino;
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



}