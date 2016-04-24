<?php 
namespace VisitaYucatanBundle\Repository;

use VisitaYucatanBundle\Entity\Touridioma;
use VisitaYucatanBundle\utils\Estatuskeys;
use VisitaYucatanBundle\utils\Generalkeys;

/*
*PeninsulaidiomaRepository
*
*
*/

class PeninsulaidiomaRepository extends \Doctrine\ORM\EntityRepository{
	
	public function findPeninsulaByIdAndIdLanguage($idPeninsula, $idIdioma){
		$em = $this->getEntityManager();
		$query = $em->createQuery(
			'SELECT articuloidioma
			        FROM VisitaYucatanBundle:Articuloidioma articuloidioma
			        WHERE articuloidioma.estatus = :estatusActivo
			        AND articuloidioma.articulo = :idPeninsula
			        AND articuloidioma.idioma = :idIdioma'
		)->setParameter('estatusActivo', Estatuskeys::ESTATUS_ACTIVO)->setParameter('idPeninsula', $idPeninsula)->setParameter('idIdioma', $idIdioma);

		return $query->getOneOrNullResult();

	}

	
}



 ?>