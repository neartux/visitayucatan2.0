<?php 
namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\TourUtils;

class PaqueteController extends Controller {

	/**
     * @Route("/paquetes", name="web_paquetes")
     * @Method("GET")
    */
	public function PaqueteAction(Request $request){
		$data = $this->getParamsPaquete($request);
        $currency = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->findAllCurrency();
        $idiomas = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->findAllLanguage();
		$paquetes = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Paquete')->getPaquetes($data[Generalkeys::NUMBER_ZERO],$data[Generalkeys::NUMBER_ONE]);
		return $this->render('VisitaYucatanBundle:web/pages:paquetes.html.twig',array('paquetes'=>$paquetes,'monedas'=>$currency,'idiomas'=>$idiomas
        , 'claseImg' => Generalkeys::CLASS_HEADER_PACKAGE, 'logoSection' => Generalkeys::IMG_NAME_SECCION_WEB_PACKAGE));
	}

	private function getParamsPaquete($request){
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

        // Declarp nuevo array para mandar los datos
        $datos = Array();
        // coloco la informacion
        $datos[Generalkeys::NUMBER_ZERO] = $idIdioma;
        $datos[Generalkeys::NUMBER_ONE] = $moneda;
        // Regreso los datos
        return $datos;
    }
}