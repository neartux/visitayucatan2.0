<?php 
namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\PaqueteUtils;
use VisitaYucatanBundle\utils\StringUtils;
use VisitaYucatanBundle\utils\TourUtils;

class PaqueteController extends Controller {

	/**
     * @Route("/paquetes", name="web_paquetes")
     * @Method("GET")
    */
	public function PaqueteAction(Request $request){
		$data = $this->getParamsPaquete($request);
        $descriptionPage = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Articulo')->getArticuloPage(Generalkeys::TIPO_ARTICULO_PAGINA, Generalkeys::TIPO_ARTICULO_PAGINA_PAQUETE, $data[Generalkeys::NUMBER_ZERO]);
        $descripcion = $descriptionPage['descripcion'];
        $descripcionCorta = StringUtils::cutText($descriptionPage['descripcion'], Generalkeys::NUMBER_ZERO, Generalkeys::NUMBER_ONE_HUNDRED_FIFTEEN, Generalkeys::COLILLA_TEXT, Generalkeys::CIERRE_HTML_P);
		$paquetes = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Paquete')->getPaquetes($data[Generalkeys::NUMBER_ZERO],$data[Generalkeys::NUMBER_ONE], Generalkeys::OFFSET_ROWS_ZERO, Generalkeys::LIMIT_ROWS_TWENTY);
		return $this->render('VisitaYucatanBundle:web/pages:paquetes.html.twig',array('paquetes'=> PaqueteUtils::convertArrayPaqueteToArrayPaqueteTO($paquetes),
            'claseImg' => Generalkeys::CLASS_HEADER_PACKAGE, 'logoSection' => Generalkeys::IMG_NAME_SECCION_WEB_PACKAGE,
            'pageDescription' => $descripcion, 'descripcionCorta' => $descripcionCorta));
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

        // Valida el idioma
        if(is_null($idioma)){
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

    /**
     * @Route("/paquete/detail/id/{id}", name="web_paquete_detail")
     * @Method("GET")
     */
    public function detailPaqueteAction($id, Request $request) {
        $datos = $this->getParamsPaquete($request);
        $paquete = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Paquete')->getPaqueteById($id, $datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE]);
        $imagesPaquete = $this->getDoctrine()->getRepository('VisitaYucatanBundle:PaqueteImagen')->findPaqueteImagesByIdPaquete($id);
        $paqueteCombinacion = $this->getDoctrine()->getRepository('VisitaYucatanBundle:PaqueteCombinacionHotel')->findPaqueteCombinacionById($id,$datos[Generalkeys::NUMBER_ONE]);
        //print_r($paquete);

        return $this->render('VisitaYucatanBundle:web/pages:detalle-paquete.html.twig', array('paquete' => PaqueteUtils::getPaqueteTO($paquete, $imagesPaquete,$paqueteCombinacion), 'claseImg' => Generalkeys::CLASS_HEADER_PACKAGE, 'logoSection' => Generalkeys::IMG_NAME_SECCION_WEB_PACKAGE));
        //return $paquete;
        /*$imagesTour = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tourimagen')->findTourImagesByIdTour($id);

        return $this->render('VisitaYucatanBundle:web/pages:detalle-tour.html.twig', array('tour' => TourUtils::getTourTO($tour, $imagesTour), 'monedas' => $currency,
            'idiomas' => $idiomas, 'claseImg' => Generalkeys::CLASS_HEADER_TOUR, 'logoSection' => Generalkeys::IMG_NAME_SECCION_WEB_TOUR));*/
    }
    /**
     * @Route("/paquete/reserva", name="web_paquete_reserva")
     * @Method("POST")
    */
    public function reservaPaqueteAction(Request $request){
         $id= $request->get('id');
         $ocupacion = $request->get('typeocupacion'); 
         $costo = $request->get('costo');
         $namePaquete = $request->get('namepaquete');
         $datos = $this->getParamsPaquete($request);
          // lista de monedas e idiomas
        $currency = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->findAllCurrency();
        $idiomas = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->findAllLanguage();
         $menores = 0;
         switch($ocupacion){
             case 'costosencillo':
                $ocupacion = 'Sencilla';
                $adultos = 1;
                break;
             case 'costodoble':
                $ocupacion = 'Doble';
                $adultos = 2;
                break;
             case 'costotriple':
                $ocupacion = 'Triple';
                $adultos = 3;
                break;
             case 'costocuadruple':
                $ocupacion = 'Cuadruple';
                $adultos = 4;
                break;
         }
         $detailPaquete = array(
           'costo'=>$costo,
           'paqueteSelect'=> $namePaquete,
           'adultos' => $adultos,
           'menores' =>$menores,
           'ocupacion'=> $ocupacion
         );
         $importeTotal = $costo * $adultos;
         $paqueteCombinacion = $this->getDoctrine()->getRepository('VisitaYucatanBundle:PaqueteCombinacionHotel')->findCombinacionPaqueteById((int)$id,$datos[Generalkeys::NUMBER_ONE]);
         
         //print_r($paqueteCombinacion);
         //print_r(PaqueteUtils::getPaqueteTO(null, null,$paqueteCombinacion));
         //exit();

         return $this->render('VisitaYucatanBundle:web/pages:reserva-paquete.html.twig', array('paqueteCombinacion' => PaqueteUtils::getPaqueteTO(null, null,$paqueteCombinacion),'detailPaquete'=>$detailPaquete,'importe'=>number_format($importeTotal),
          'claseImg' => Generalkeys::CLASS_HEADER_PACKAGE, 'logoSection' => Generalkeys::IMG_NAME_SECCION_WEB_PACKAGE));

         /*return $this->render('VisitaYucatanBundle:web/pages:reserva-paquete.html.twig', array('paqueteCombinacion' => PaqueteUtils::getPaqueteTO(null, null,$paqueteCombinacion),'detailPaquete'=>$detailPaquete,'importe'=>$importeTotal, 'claseImg' => Generalkeys::CLASS_HEADER_PACKAGE, 'logoSection' => Generalkeys::IMG_NAME_SECCION_WEB_PACKAGE));*/
        //$paqueteCombinacion=$this->getDoctrine()->getRepository('VisitaYucatanBundle:PaqueteCombinacionHotel')->findCombinacionPaqueteById($id);
        //print_r($paqueteCombinacion);
        //exit();
    }
}