<?php

namespace VisitaYucatanBundle\Repository;
use Doctrine\ORM\EntityNotFoundException;
use VisitaYucatanBundle\Entity\Articulo;
use VisitaYucatanBundle\utils\Estatuskeys;

/**
 * ArticuloRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticuloRepository extends \Doctrine\ORM\EntityRepository {

    public function createArticulo($descripcion, $tipoArticulo){
        $em = $this->getEntityManager();
        $articulo = new Articulo();
        $articulo->setDescripcion($descripcion);
        $articulo->setTipoArticulo($tipoArticulo);
        $articulo->setEstatus($em->getReference('VisitaYucatanBundle:Estatus'), Estatuskeys::ESTATUS_ACTIVO);

        $em->persist($articulo);
        $em->flush();
    }

    public function updateArticulo($idArticulo, $descripcion){
        $em = $this->getEntityManager();

        $articulo = $this->find($idArticulo);

        if(! $articulo){
            throw new EntityNotFoundException('El articulo con id ' . $idArticulo . " no se encontro");
        }

        $articulo->setDescripcion($descripcion);

        $em->persist($articulo);
        $em->flush();
    }

    public function deleteArticulo($idArticulo){
        $em = $this->getEntityManager();

        $articulo = $this->find($idArticulo);

        if(! $articulo){
            throw new EntityNotFoundException('El articulo con id ' . $idArticulo . " no se encontro");
        }

        $articulo->setEstatus($em->getReference('VisitaYucatanBundle:Estatus'), Estatuskeys::ESTATUS_INACTIVO);

        $em->persist($articulo);
        $em->flush();
    }
}
