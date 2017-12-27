<?php

namespace VisitaYucatanBundle\Repository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use VisitaYucatanBundle\Entity\ConfigurationVar;

/**
 * ConfigurationVarRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ConfigurationVarRepository extends \Doctrine\ORM\EntityRepository {

    public function findAll() {
        return parent::findAll(); // TODO: Change the autogenerated stub
    }

    public function saveParameter($id, $clave, $valor){
        $em = $this->getEntityManager();
        $configuration = new ConfigurationVar();
        $parameter = parent::find($id);
        if ($parameter != null){
            $configuration = $parameter;
        }
        $configuration->setClave($clave);
        $configuration->setValor($valor);

        $em->persist($configuration);
        $em->flush();
    }

    public function findParameterValueByKey($key){
        $parameter = parent::findOneBy(array('clave' => $key));
        if(!$parameter){
            new NotFoundHttpException("No se encontro el elemento");
        }
        return $parameter->getValor();
    }

    public function updateParameterValueByKey($key, $value){
        $parameter = parent::findOneBy(array('clave' => $key));
        if(!$parameter){
            new NotFoundHttpException("No se encontro el elemento");
        }
        $em = $this->getEntityManager();
        $parameter->setValor($value);

        $em->persist($parameter);
        $em->flush();
    }

    public function isVisibleHotels(){
        $parameter = parent::findOneBy(array('clave' => 'show_hotels'));
        if(!$parameter){
            return false;
        }
        return $parameter->getValor() == 1 ? true : false;
    }

    public function isVisibleHotelsUpdate($value){
        $parameter = parent::findOneBy(array('clave' => 'show_hotels'));
        $em = $this->getEntityManager();
        if(!$parameter){
            new NotFoundHttpException("No se encontro el elemento");
        }
        $parameter->setValor($value);

        $em->persist($parameter);
        $em->flush();
    }
}
