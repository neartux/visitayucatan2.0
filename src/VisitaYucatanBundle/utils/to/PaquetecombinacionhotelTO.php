<?php  
/**
 * User: Jerry
 * Date: 14/05/16
 * Time: 11:41 AM
 */

namespace VisitaYucatanBundle\utils\to;


class PaquetecombinacionhotelTO{
	private $id;
	private $idPaquete;
	private $idEstatus;
	private $idHotel;
	private $noches;
	private $dias;
	private $costoSencillo;
	private $costoDoble;
	private $costoTriple;
	private $costoCuadruple;
	private $costoMenor;
	private $nomhotel;
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

	/**
     * @return mixed
     */
	public function getCostoSencillo()
	{
	  return $this->costoSencillo;
	}

	/**
	* @param mixed $costoSencillo
	*/
	public function setCostoSencillo($costoSencillo)
	{
	  $this->costoSencillo = $costoSencillo;
	}

	/**
     * @return mixed
     */
	public function getCostoDoble()
	{
	  return $this->costoDoble;
	}

	/**
	* @param mixed $costoDoble
	*/
	public function setCostoDoble($costoDoble)
	{
	  $this->costoDoble = $costoDoble;
	}

	/**
     * @return mixed
     */
	public function getCostoTriple()
	{
	  return $this->costoTriple;
	}

	/**
	* @param mixed $costoTriple
	*/
	public function setCostoTriple($costoTriple)
	{
	  $this->costoTriple = $costoTriple;
	}

	/**
     * @return mixed
     */
	public function getCostoCuadruple()
	{
	  return $this->costoCuadruple;
	}

	/**
	* @param mixed $costoCuadruple
	*/
	public function setCostoCuadruple($costoCuadruple)
	{
	  $this->costoCuadruple = $costoCuadruple;
	}

	/**
     * @return mixed
     */
	public function getCostoMenor()
	{
	  return $this->costoMenor;
	}

	/**
	* @param mixed $costoMenor
	*/
	public function setCostoMenor($costoMenor)
	{
	  $this->costoMenor = $costoMenor;
	}

	/**
     * @return mixed
     */
	public function getNomhotel()
	{
	  return $this->nomhotel;
	}

	/**
	* @param mixed $nomhotel
	*/
	public function setNomhotel($nomhotel)
	{
	  $this->nomhotel = $nomhotel;
	}
}
?>