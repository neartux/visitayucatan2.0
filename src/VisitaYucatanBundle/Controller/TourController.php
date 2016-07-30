<?php

namespace VisitaYucatanBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\utils\DateUtil;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\StringUtils;
use VisitaYucatanBundle\utils\to\ResponseTO;
use VisitaYucatanBundle\utils\to\VentaCompletaTO;
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
        $tour = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->getTourById($id, $datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE]);
        $imagesTour = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tourimagen')->findTourImagesByIdTour($id);

        return $this->render('VisitaYucatanBundle:web/pages:detalle-tour.html.twig', array('tour' => TourUtils::getTourTO($tour, $imagesTour), 
            'claseImg' => Generalkeys::CLASS_HEADER_TOUR_DETAIL,
            'fechaReserva' => DateUtil::formatDateToString(DateUtil::summDayToDate(DateUtil::Now(), 2)) ));
    }

    /**
     * @Route("/tour/reserva", name="web_tour_reserva")
     * @Method("POST")
     */
    public function displayReservaTourAction(Request $request) {
        $idTour = $request->get('idTour');
        $fechaReserva = $request->get('fechaReserva');
        $numeroAdultos = $request->get('numeroAdultos');
        $numeroMenores = $request->get('numeroMenores');
        
        $datos = $this->getParamsTour($request);
        $tour = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->getTourById($idTour, $datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE]);
        $tourTO = TourUtils::getTourTO($tour, new ArrayCollection());
        $tourTO->setFechaReserva($fechaReserva);
        $tourTO->setTotalAdultos($numeroAdultos);
        $tourTO->setTotalMenores($numeroMenores);
        $costoTotal = ($tourTO->getTotalAdultos() * $tourTO->getTarifaadulto()) + ($tourTO->getTotalMenores() * $tourTO->getTarifamenor());
        return $this->render('VisitaYucatanBundle:web/pages:reserv-tour.html.twig', array('tour' => $tourTO, 'costoTotal' => number_format($costoTotal)));
    }

    /**
     * @Route("/tour/createReservationTour", name="web_tour_reserva_create")
     * @Method("POST")
     */
    public function createReservationTour(Request $request) {
        $serializer = $this->get('serializer');
        $em = $this->getDoctrine()->getManager();

        $em->getConnection()->beginTransaction();
        try {
            $ventaCompletaTO = $serializer->deserialize($request->get('ventaCompletaTO'), 'VisitaYucatanBundle\utils\to\VentaCompletaTO', Generalkeys::JSON_STRING);
            $em->getRepository('VisitaYucatanBundle:Venta')->createSaleTour($ventaCompletaTO);
            $em->getConnection()->commit();
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Se ha creado la reserva', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
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

    /**
     * @Route("/tours/find/similares", name="tours_find_list_similares")
     * @Method("POST")
     */
    public function findPackageSimilar(Request $request) {
        $datos = $this->getParamsTour($request);
        $tours = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->getToursSimilares($datos[0], $datos[1], $request->get('id'), 3);
        return new Response($this->get('serializer')->serialize($tours, Generalkeys::JSON_STRING));
    }
}
