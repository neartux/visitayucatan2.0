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
        return $this->render('VisitaYucatanBundle:web/pages:home.html.twig', array('isVisibleHotels' => $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->isVisibleHotels()));
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

    public function pageNotFoundAction() {
        return $this->render(':web:error404.html.twig');
    }

    /**
     * @Route("/politicasCancelacion", name="web_politicasDeCancelacion")
     * @Method("GET")
     */
    public function displayPoliticasCancelacion() {
        // renderiza la vista y manda la informacion
        return $this->render('VisitaYucatanBundle:web/pages:politicasCancelacion.html.twig', array('claseImg' => Generalkeys::CLASS_HEADER_TOUR,
            'isVisibleHotels' => $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->isVisibleHotels()));
    }

    /**
     * @Route("/avisoPrivacidad", name="web_avisoDePrivacidad")
     * @Method("GET")
     */
    public function displayAvisosDePrivacidad() {
        // renderiza la vista y manda la informacion
        return $this->render('VisitaYucatanBundle:web/pages:avisoPrivacidad.html.twig', array('claseImg' => Generalkeys::CLASS_HEADER_TOUR));
    }

    private function getParams(Request $request){
        // Obtiene la session del request para obtener moneda e idioma
        $session = $request->getSession();
        // Obtiene el idioma de la sesion
        $idioma = $session->get('_locale');
        // Obtiene el idioma de la session
        $moneda = $session->get('_currency');
        //valida la moneda, si es null coloca la moneda mexicana
        if(is_null($moneda)){
            $moneda = Generalkeys::MEXICAN_CURRENCY;
            // colocal la moneda en session
            $session->set('_currency', $moneda);
        }
        // Encuentra el id de el idioma actual si no hay en sesion coloca idioma español
        $idIdioma = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->getIdIdiomaByAbreviatura($idioma);
        // Valida el idioma
        if(is_null($idioma) || empty($idioma)){
            $session->set('_locale', Generalkeys::SPANISH_LANGUAGE);
        }


        // Declarp nuevo array para mandar los datos
        $datos = Array();
        // coloco la informacion
        $datos[Generalkeys::NUMBER_ZERO] = $idIdioma;
        $datos[Generalkeys::NUMBER_ONE] = $moneda;
        // Regreso los datos
        return $datos;
    }
    
}
