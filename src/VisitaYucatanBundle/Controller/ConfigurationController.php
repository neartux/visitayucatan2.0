<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use VisitaYucatanBundle\utils\Generalkeys;

class ConfigurationController extends Controller {

    /**
     * @Route("/admin/parameters/list", name="parameters_list")
     * @Method("GET")
     */
    public function findAllCurrencyAction(Request $request){
        if(! $request->getSession()->get(Generalkeys::LABEL_STATUS)){
            return $this->redirectToRoute('admin_login');
        }
        return $this->render('VisitaYucatanBundle:admin/catalogs/configuration:Parameters.html.twig', array("parameters" => $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->findAll()));
    }

    /**
     * @Route("/admin/parameters/create", name="parameters_create")
     * @Method("GET")
     */
    public function create(Request $request)
    {
        $id = $request->get('id');
        $clave = $request->get('clave');
        $valor = $request->get('valor');

        $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->saveParameter($id, $clave, $valor);
        return $this->redirectToRoute('parameters_list');
    }
}
