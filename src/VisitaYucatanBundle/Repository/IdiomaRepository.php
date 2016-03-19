<?php

namespace VisitaYucatanBundle\Repository;

use VisitaYucatanBundle\utils\Estatuskeys;
use VisitaYucatanBundle\utils\Generalkeys;

/**
 * IdiomaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class IdiomaRepository extends \Doctrine\ORM\EntityRepository{
    public function findAllLanguage(){
        $em = $this->getEntityManager();
        $sql = "SELECT idioma.id, idioma.abreviatura, idioma.descripcion
                FROM idioma
                WHERE idioma.id_estatus =  :estatus ";
        $params['estatus'] = Estatuskeys::ESTATUS_ACTIVO;
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getIdIdiomaByAbreviatura($abreviatura){
        $idioma = $this->findOneBy(array('abreviatura' => $abreviatura, 'estatus' => Estatuskeys::ESTATUS_ACTIVO));
        if(is_null($idioma)){
            return Generalkeys::IDIOMA_ESPANOL;
        }
        return $idioma->getId();
    }

    public function createLanguage($language){
        $em = $this->getEntityManager();
        $language->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_ACTIVO));

        $em->persist($language);
        $em->flush();

        return $language->getId();
    }

    public function updateLanguage($language){
        $em = $this->getEntityManager();
        $languageUpdate = $em->getRepository("VisitaYucatanBundle:Idioma")->find($language->getId());
        if(! $languageUpdate){
            throw new EntityNotFoundException('El idioma con id '.$language->getId()." no se encontro");
        }
        // Actualiza la informacion del idiomas
        $languageUpdate->setDescripcion($language->getDescripcion());
        $languageUpdate->setAbreviatura($language->getAbreviatura());

        $em->persist($languageUpdate);
        $em->flush();
    }

    public function deleteLanguage($idLanguage){
        $em = $this->getEntityManager();
        $language = $em->getRepository('VisitaYucatanBundle:Idioma')->find($idLanguage);
        if(! $language){
            throw new EntityNotFoundException('El idioma con id '.$idLanguage." no se encontro");
        }
        $language->setEstatus($em->getReference('VisitaYucatanBundle:Estatus', Estatuskeys::ESTATUS_INACTIVO));
        $em->persist($language);
        $em->flush();
    }
}
