<?php 
/**
 * User: jerry
 * Date: 13/04/16
 */

namespace VisitaYucatanBundle\utils\to;

class PaqueteimagenTO{
	private $id;
	private $idPaquete;
	private $nombreOriginal;
	private $nombre;
	private $path;
	private $tipoArchivo;
	private $folio;
	private $fechaCreacion;
	private $principal;

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
	public function getNombreOriginal()
	{
	  return $this->nombreOriginal;
	}

	/**
	* @param mixed $nombreOriginal
	*/
	public function setNombreOriginal($nombreOriginal)
	{
	  $this->nombreOriginal = $nombreOriginal;
	}


	/**
     * @return mixed
     */
	public function getNombre()
	{
	  return $this->nombre;
	}

	/**
	* @param mixed $nombre
	*/
	public function setNombre($nombre)
	{
	  $this->nombre= $nombre;
	}

	/**
     * @return mixed
     */
	public function getPath()
	{
	  return $this->path;
	}

	/**
	* @param mixed $path
	*/
	public function setPath($path)
	{
	  $this->path = $path;
	}

	/**
     * @return mixed
     */
	public function getTipoArchivo()
	{
	  return $this->tipoArchivo;
	}

	/**
	* @param mixed $tipoArchivo
	*/
	public function setTipoArchivo($tipoArchivo)
	{
	  $this->tipoArchivo = $tipoArchivo;
	}

	/**
     * @return mixed
     */
	public function getFolio()
	{
	  return $this->folio;
	}

	/**
	* @param mixed $folio
	*/
	public function setFolio($folio)
	{
	  $this->folio = $folio;
	}

	/**
     * @return mixed
     */
	public function getFechaCreacion()
	{
	  return $this->fechaCreacion;
	}

	/**
	* @param mixed $fechaCreacion
	*/
	public function setFechaCreacion($fechaCreacion)
	{
	  $this->fechaCreacion = $fechaCreacion;
	}

	/**
     * @return mixed
     */
	public function getPrincipal()
	{
	  return $this->principal;
	}

	/**
	* @param mixed $principal
	*/
	public function setPrincipal($principal)
	{
	  $this->principal = $principal;
	}
}
?>