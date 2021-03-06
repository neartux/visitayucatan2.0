<?php

namespace VisitaYucatanBundle\Repository;

use Doctrine\ORM\EntityNotFoundException;
use VisitaYucatanBundle\Entity\ArticuloIdioma;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\Estatuskeys;

/**
 * ArticuloIdiomaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticuloIdiomaRepository extends \Doctrine\ORM\EntityRepository {

    public function createArticuloIdioma($nombre, $descripcion, $idArticulo, $idIdioma){
        $em = $this->getEntityManager();
        $articulo = new ArticuloIdioma();
        $articulo->setNombre($nombre);
        $articulo->setDescripcion($descripcion);
        $articulo->setArticulo($em->getReference('VisitaYucatanBundle:Articulo', $idArticulo));
        $articulo->setIdioma($em->getReference('VisitaYucatanBundle:Idioma', $idIdioma));

        $em->persist($articulo);
        $em->flush();
    }

    public function editArticuloIdioma($idArticuloIdioma, $nombre, $descripcion){
        $articulo = $this->find($idArticuloIdioma);
        if(!$articulo){
            throw new EntityNotFoundException('No se pudo actualizar la informacion');
        }
        $em = $this->getEntityManager();

        $articulo->setNombre($nombre);
        $articulo->setDescripcion($descripcion);

        $em->persist($articulo);
        $em->flush();
    }


    public function findPeninsulaByIdAndIdLanguage($idArticulo, $idIdioma, $tipoArticulo) {
        $em = $this->getEntityManager();
        $sql= "SELECT articulo.id AS idarticulo,articulo_idioma.id AS idarticuloidioma, 
                      articulo_idioma.nombre,articulo_idioma.descripcion
               FROM articulo
               INNER JOIN articulo_idioma ON articulo.id = articulo_idioma.id_articulo
               INNER JOIN idioma ON idioma.id = articulo_idioma.id_idioma AND idioma.id = :idIdioma 
               AND idioma.id_estatus = :estatusActivo
               WHERE articulo.id = :idArticulo
               AND articulo.tipoarticulo = :tipoArticulo";

        $params['idArticulo'] = $idArticulo;
        $params['idIdioma'] = $idIdioma;        
        $params['tipoArticulo'] = $tipoArticulo;
        $params['estatusActivo'] = Estatuskeys::ESTATUS_ACTIVO;

        $stmt = $em->getConnection()->prepare($sql);
         $stmt->execute($params);
       return $stmt->fetch();   
    
      
    }

}
