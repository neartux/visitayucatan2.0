<?php 
/*
* User: Jerry
* Date: 10/04/2016
*/
namespace VisitaYucatanBundle\utils\to;


class PaqueteidiomaTO{
	private $id;
	private $idPaquete;
	private $idIdioma;
	private $descripcion;
	private $descripcioncorta;
	private $descripcionlarga;
	private $incluye;
	private $circuito;
	
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
	public function getIdPaquete()
	{
	  return $this->idPaquete;
	}

	/**
	* @param mixed $idPaquete
	*/
	public function setIdPaquete($idPaquete)
	{
	  $this->idPaquete = $idPaquete;
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
	public function getDescripcionCorta()
	{
	  return $this->descripcioncorta;
	}

	/**
	* @param mixed $descripcioncorta
	*/
	public function setDescripcionCorta($descripcioncorta)
	{
	  $this->descripcioncorta = $descripcioncorta;
	}

	/**
     * @return mixed
     */
	public function getDescripcionLarga()
	{
	  return $this->descripcionlarga;
	}

	/**
	* @param mixed $descripcionlarga
	*/
	public function setDescripcionLarga($descripcionlarga)
	{
	  $this->descripcionlarga = $descripcionlarga;
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
}
?>