<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\utils\Generalkeys;


class HomeController extends Controller {

    /**
     * @Route("/", name="web_home")
     * @Method("GET")
     */
    public function indexAction() {
        return $this->render('VisitaYucatanBundle:web/pages:home.html.twig');
    }

    /**
     * @Route("/reconfigure/variables", name="web_configure_select")
     * @Method("POST")
     */
    public function configureCatalogsAction(Request $request) {
        try{
            // Obtiene la session del request para obtener moneda e idioma
            $session = $request->getSession();
            // Colocal el idioma seleccionado en session
            $session->set('_locale', strtolower($request->get('language')));
            // Coloca la moneda seleccionada
            $session->set('_currency', $request->get('currency'));
            return new JsonResponse(true);
        } catch(\Exception $e){
            return new JsonResponse(false);
        }
    }
}
