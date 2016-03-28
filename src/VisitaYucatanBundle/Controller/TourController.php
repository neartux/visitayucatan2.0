<?php

namespace VisitaYucatanBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\StringUtils;
use VisitaYucatanBundle\utils\TourUtils;


class TourController extends Controller {

    /**
     * @Route("/tours", name="web_tours")
     * @Method("GET")
     */
    public function indexAction(Request $request) {
        // obtiene los datos de session moneda e idioma
        $datos = $this->getParamsTour($request);
        // lista de monedas e idiomas
        $currency = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->findAllCurrency();
        $idiomas = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->findAllLanguage();
        // encuentra la descripcio de la pagina, obtiene la descripcion corta
        $descriptionPage = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Articulo')->getArticuloPage(Generalkeys::TIPO_ARTICULO_PAGINA, Generalkeys::TIPO_ARTICULO_PAGINA_TOUR, $datos[Generalkeys::NUMBER_ZERO]);
        $descripcion = $descriptionPage['descripcion'];
        $descripcionCorta = StringUtils::cutText($descriptionPage['descripcion'], Generalkeys::NUMBER_ZERO, Generalkeys::NUMBER_ONE_HUNDRED_FIFTEEN, Generalkeys::COLILLA_TEXT, Generalkeys::CIERRE_HTML_P);
        // busca todos los tours activos y publicados
        $tours = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->getTours($datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE], Generalkeys::OFFSET_ROWS_ZERO, Generalkeys::LIMIT_ROWS_TWENTY);
        // renderiza la vista y manda la informacion
        return $this->render('VisitaYucatanBundle:web/pages:tours.html.twig', array('tours' => TourUtils::getTours($tours),
            'pageDescription' => $descripcion, 'descripcionCorta' => $descripcionCorta, 'monedas' => $currency,
            'idiomas' => $idiomas, 'claseImg' => Generalkeys::CLASS_HEADER_TOUR, 'logoSection' => Generalkeys::IMG_NAME_SECCION_WEB_TOUR));
    }

    /**
     * @Route("/tour/detail/id/{id}", name="web_tour_detail")
     * @Method("GET")
     */
    public function detailTourAction($id, Request $request) {
        $datos = $this->getParamsTour($request);
        $currency = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->findAllCurrency();
        $idiomas = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->findAllLanguage();

        $tour = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->getTourById($id, $datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE]);
        $imagesTour = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tourimagen')->findTourImagesByIdTour($id);

        return $this->render('VisitaYucatanBundle:web/pages:detalle-tour.html.twig', array('tour' => TourUtils::getTourTO($tour, $imagesTour), 'monedas' => $currency,
            'idiomas' => $idiomas, 'claseImg' => Generalkeys::CLASS_HEADER_TOUR, 'logoSection' => Generalkeys::IMG_NAME_SECCION_WEB_TOUR));
    }

    /**
     * @Route("/tour/reserva", name="web_tour_reserva")
     * @Method("POST")
     */
    public function displayReservaTourAction(Request $request) {
        echo $idTour = $request->get('idTour');
        echo $fechaReserva = $request->get('fechaReserva');
        echo $numeroAdultos = $request->get('numeroAdultos');
        echo $numeroMenores = $request->get('numeroMenores');
        $currency = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->findAllCurrency();
        $idiomas = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->findAllLanguage();
        $datos = $this->getParamsTour($request);
        $tour = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->getTourById($idTour, $datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE]);

        return $this->render('VisitaYucatanBundle:web/pages:reserva-tour.html.twig', array('monedas' => $currency, 'idiomas' => $idiomas, 'claseImg' => Generalkeys::CLASS_HEADER_TOUR,
            'logoSection' => Generalkeys::IMG_NAME_SECCION_WEB_TOUR, 'tour' => TourUtils::getTourTO($tour, new ArrayCollection())));
    }

    private function getParamsTour($request){
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
}
