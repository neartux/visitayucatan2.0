<?php

namespace VisitaYucatanBundle\Repository;
use Doctrine\ORM\EntityNotFoundException;
use VisitaYucatanBundle\Entity\PaqueteCombinacionHotel;
use VisitaYucatanBundle\utils\Estatuskeys;
use VisitaYucatanBundle\utils\Generalkeys;
/**
 * PaqueteCombinacionHotelRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PaqueteCombinacionHotelRepository extends \Doctrine\ORM\EntityRepository {

	public function findPaqueteHotelesCombinacion(){
		$em = $this->getEntityManager();
		$sql='SELECT  *
			  FROM hotel h
			  WHERE h.id_estatus = :estatusActivo';
		$params['estatusActivo'] = Estatuskeys::ESTATUS_ACTIVO;
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute($params);
		return $stmt->fetchAll();
	}

	/*public function findPaqueteByIdCombiHotel($idPaquete,$idHotel){
		$em = $this->getEntityManager();
		$query = $em->createQuery(
		   'SELECT paquetecombhotel
            FROM VisitaYucatanBundle:PaqueteCombinacionHotel paquetecombhotel
            WHERE paquetecombhotel.estatus = :estatusActivo
            AND paquetecombhotel.paquete = :idPaquete
            AND paquetecombhotel.hotel = :idHotel'
		)->setParameter('estatusActivo', Estatuskeys::ESTATUS_ACTIVO)->setParameter('idPaquete', $idPaquete)->setParameter('idHotel', $idHotel);

		return $query->getOneOrNullResult();
	}*/
	public function findPaqueteCombinacionById($idPaquete,$idMoneda){
		$em = $this->getEntityManager();
		$sql = "SELECT pc.id,pc.id_paquete,pc.id_hotel,pc.noches,pc.dias,(pc.costosencillo/moneda.tipo_cambio) as costosencillo,(pc.costodoble/moneda.tipo_cambio) as costodoble,
          		(pc.costotriple/moneda.tipo_cambio) as costotriple,(pc.costocuadruple/moneda.tipo_cambio) as costocuadruple,
          		(pc.costomenor/moneda.tipo_cambio) as costomenor,h.descripcion as nomHotel,h.estrellas AS estrellashotel,moneda.simbolo, moneda.tipo_cambio as tipocambio, hotel_imagen.path 
          		FROM paquete_combinacion_hotel pc
        		INNER JOIN hotel h ON pc.id_hotel =h.id AND h.id_estatus = :estatusActivo LEFT JOIN hotel_imagen ON h.id = hotel_imagen.id_hotel
				INNER JOIN moneda ON moneda.id = :idMoneda
				WHERE pc.id_paquete = :idPaquete
				AND pc.id_estatus = :estatusActivo
				AND hotel_imagen.id_estatus = :estatusActivo
				ORDER BY h.estrellas;";
		$params['estatusActivo'] = Estatuskeys::ESTATUS_ACTIVO;
		$params['idMoneda'] = $idMoneda;
		$params['idPaquete'] = $idPaquete;
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute($params);
		return $stmt->fetchAll();
	}
	public function createPaqueteCombinacion($paqueteCombinacionTO){

		//echo "idPaquete".(int)$paqueteCombinacionTO->getIdPaquete();
		$em = $this->getEntityManager();
		$paqueteCombinacion = new PaqueteCombinacionHotel();
		$paqueteCombinacion->setNoches((int)$paqueteCombinacionTO->getNoches());
		$paqueteCombinacion->setDias((int)$paqueteCombinacionTO->getDias());
		$paqueteCombinacion->setCostoSencillo((float)$paqueteCombinacionTO->getCostoSencillo());
		$paqueteCombinacion->setCostoDoble((float)$paqueteCombinacionTO->getCostoDoble());
		$paqueteCombinacion->setCostoTriple((float)$paqueteCombinacionTO->getCostoTriple());
		$paqueteCombinacion->setCostoCuadruple((float)$paqueteCombinacionTO->getCostoCuadruple());
		$paqueteCombinacion->setCostoMenor((float)$paqueteCombinacionTO->getCostoMenor());
		$paqueteCombinacion->setPaquete($em->getReference('VisitaYucatanBundle:Paquete',(int)$paqueteCombinacionTO->getIdPaquete()));
		$paqueteCombinacion->setHotel($em->getReference('VisitaYucatanBundle:Hotel',(int)$paqueteCombinacionTO->getIdHotel()));
		$paqueteCombinacion->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));

		
		$em->persist($paqueteCombinacion);

		$em->flush();
	}

	public function findAllPaqueteHotelesCombinacionById($idPaquete){
		$em = $this->getEntityManager();
		$sql='SELECT  p.*,h.descripcion as nomhotel
			  FROM paquete_combinacion_hotel p
			  INNER JOIN hotel h ON p.id_hotel=h.id
			  WHERE p.id_estatus = :estatusActivo AND p.id_paquete=:idPaquete';
		$params['estatusActivo'] = Estatuskeys::ESTATUS_ACTIVO;
		$params['idPaquete'] = $idPaquete;
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute($params);
		return $stmt->fetchAll();
	}

	public function updatePaqueteCombinacion($paqueteCombinacionTO) {
        $em = $this->getEntityManager();
        $paqueteCombinacionUpdate = $this->find($paqueteCombinacionTO->getId());
        if (!$paqueteCombinacionUpdate) {
            throw new EntityNotFoundException('El paquete combinación con id ' . $paqueteCombinacionTO->getId() . " no se encontro");
        }
        // Actualiza la informacion del  paquete combinacion
        	$paqueteCombinacionUpdate->setNoches((int)$paqueteCombinacionTO->getNoches());
			$paqueteCombinacionUpdate->setDias((int)$paqueteCombinacionTO->getDias());
			$paqueteCombinacionUpdate->setCostoSencillo((float)$paqueteCombinacionTO->getCostoSencillo());
			$paqueteCombinacionUpdate->setCostoDoble((float)$paqueteCombinacionTO->getCostoDoble());
			$paqueteCombinacionUpdate->setCostoTriple((float)$paqueteCombinacionTO->getCostoTriple());
			$paqueteCombinacionUpdate->setCostoCuadruple((float)$paqueteCombinacionTO->getCostoCuadruple());
			$paqueteCombinacionUpdate->setCostoMenor((float)$paqueteCombinacionTO->getCostoMenor());
        	$em->persist($paqueteCombinacionUpdate);
        	$em->flush();
    }
	public function deletePaqueteCombinacion($idPaqueteCombinacion){
		$em = $this->getEntityManager();
		$paqueteCombinacion = $em->getRepository('VisitaYucatanBundle:PaqueteCombinacionHotel')->find($idPaqueteCombinacion);
		if (!$paqueteCombinacion) {
		   throw new EntityNotFoundException('El paquete combinación con id ' . $idPaqueteCombinacion . " no se encontro");
		}
		$paqueteCombinacion->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_INACTIVO));
		$em->persist($paqueteCombinacion);
		$em->flush();
	}

	public function findCombinacionPaqueteById($idCombinacion,$idMoneda){
		$em = $this->getEntityManager();
		$sql='SELECT  p.id,p.id_paquete,p.id_hotel,p.noches,p.dias,(p.costosencillo/moneda.tipo_cambio) as costosencillo,
			  (p.costodoble/moneda.tipo_cambio) as costodoble, (p.costotriple/moneda.tipo_cambio) as costotriple,
			  (p.costocuadruple/moneda.tipo_cambio) as costocuadruple, (p.costomenor/moneda.tipo_cambio) as costomenor, 
			  h.descripcion as nomhotel,moneda.simbolo, moneda.tipo_cambio as tipocambio,hotel_imagen.path
			  FROM paquete_combinacion_hotel p
			  INNER JOIN hotel h ON p.id_hotel=h.id LEFT JOIN hotel_imagen ON h.id = hotel_imagen.id_hotel AND hotel_imagen.id_estatus = :estatusActivo
			  INNER JOIN moneda ON moneda.id = :idMoneda
			  WHERE p.id_estatus = :estatusActivo AND p.id=:idCombinacion';
		$params['estatusActivo'] = Estatuskeys::ESTATUS_ACTIVO;
		$params['idMoneda'] = $idMoneda;
		$params['idCombinacion'] = $idCombinacion;
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute($params);
		return $stmt->fetchAll();
	}
}
