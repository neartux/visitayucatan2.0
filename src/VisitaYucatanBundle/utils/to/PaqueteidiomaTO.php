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
	private $descripcionCorta;
	private $descripcionLarga;
	private $incluye;
	private $circuito;
	private $itinerario;
	private $dias;
	
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

	/**
     * @return mixed
     */
	public function getItinerario()
	{
	  return $this->itinerario;
	}

	/**
	* @param mixed $itinerario
	*/
	public function setItinerario($itinerario)
	{
	  $this->itinerario = $itinerario;
	}

	/**
     * @return mixed
     */
	public function getDias()
	{
	  return $this->dias;
	}

	/**
	* @param mixed $itinerario
	*/
	public function setDias($dias)
	{
	  $this->dias = $dias;
	}
}
?>