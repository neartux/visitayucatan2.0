<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use VisitaYucatanBundle\utils\DateUtil;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\HotelUtils;
use VisitaYucatanBundle\utils\StringUtils;
use VisitaYucatanBundle\utils\TourUtils;

class HotelController extends Controller {

    /**
     * @Route("/hoteles/merida", name="web_hoteles_merida")
     * @Method("GET")
     */
    public function hotelesMeridaAction(Request $request) {
        // obtiene los datos de session moneda e idioma
        $datos = $this->getParamsTour($request);
        // lista de monedas e idiomas
        $currency = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->findAllCurrency();
        $idiomas = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->findAllLanguage();
        // encuentra la descripcio de la pagina, obtiene la descripcion corta
        $descriptionPage = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Articulo')->getArticuloPage(Generalkeys::TIPO_ARTICULO_PAGINA, Generalkeys::TIPO_ARTICULO_PAGINA_HOTEL, $datos[Generalkeys::NUMBER_ZERO]);
        $descripcion = $descriptionPage['descripcion'];
        $descripcionCorta = StringUtils::cutText($descriptionPage['descripcion'], Generalkeys::NUMBER_ZERO, Generalkeys::NUMBER_ONE_HUNDRED_FIFTEEN, Generalkeys::COLILLA_TEXT, Generalkeys::CIERRE_HTML_P);
        // busca todos los hoteles activos y publicados
        $hotels = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotel')->getHotelsByDestino($datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE], Generalkeys::ORIGEN_MERIDA ,Generalkeys::OFFSET_ROWS_ZERO, Generalkeys::LIMIT_ROWS_TWENTY);
        //print_r($hotels);exit;
        // renderiza la vista y manda la informacion
        return $this->render('VisitaYucatanBundle:web/pages:hotels.html.twig', array('hotels' => HotelUtils::getHotels($hotels),
            'pageDescription' => $descripcion, 'descripcionCorta' => $descripcionCorta, 'monedas' => $currency,
            'idiomas' => $idiomas, 'claseImg' => Generalkeys::CLASS_HEADER_HOTEL, 'logoSection' => Generalkeys::IMG_NAME_SECCION_WEB_HOTEL));
    }

    /**
     * @Route("/hoteles/cancun", name="web_hoteles_cancun")
     * @Method("GET")
     */
    public function hotelesCancunAction(Request $request) {
        // obtiene los datos de session moneda e idioma
        $datos = $this->getParamsTour($request);
        // lista de monedas e idiomas
        $currency = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->findAllCurrency();
        $idiomas = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->findAllLanguage();
        // encuentra la descripcio de la pagina, obtiene la descripcion corta
        $descriptionPage = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Articulo')->getArticuloPage(Generalkeys::TIPO_ARTICULO_PAGINA, Generalkeys::TIPO_ARTICULO_PAGINA_HOTEL, $datos[Generalkeys::NUMBER_ZERO]);
        $descripcion = $descriptionPage['descripcion'];
        $descripcionCorta = StringUtils::cutText($descriptionPage['descripcion'], Generalkeys::NUMBER_ZERO, Generalkeys::NUMBER_ONE_HUNDRED_FIFTEEN, Generalkeys::COLILLA_TEXT, Generalkeys::CIERRE_HTML_P);
        // busca todos los hoteles activos y publicados
        $hotels = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotel')->getHotelsByDestino($datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE], Generalkeys::ORIGEN_CANCUN ,Generalkeys::OFFSET_ROWS_ZERO, Generalkeys::LIMIT_ROWS_TWENTY);

        // renderiza la vista y manda la informacion
        return $this->render('VisitaYucatanBundle:web/pages:hotels.html.twig', array('hotels' => HotelUtils::getHotels($hotels),
            'pageDescription' => $descripcion, 'descripcionCorta' => $descripcionCorta, 'monedas' => $currency,
            'idiomas' => $idiomas, 'claseImg' => Generalkeys::CLASS_HEADER_HOTEL, 'logoSection' => Generalkeys::IMG_NAME_SECCION_WEB_HOTEL));
    }

    /**
     * @Route("/hotel/detail/id/{id}", name="web_hotel_detail")
     * @Method("GET")
     */
    public function detailTourAction($id, Request $request) {
        $datos = $this->getParamsTour($request);
        $currency = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->findAllCurrency();
        $idiomas = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->findAllLanguage();

        $hotel = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotel')->getHotelById($id, $datos[Generalkeys::NUMBER_ZERO]);
        $images = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotelimagen')->findHotelImagesByIdHotel($id);

        return $this->render('VisitaYucatanBundle:web/pages:detalle-hotel.html.twig', array('monedas' => $currency, 'hotel' => HotelUtils::getDetailHotel($hotel, $images),
            'idiomas' => $idiomas, 'claseImg' => Generalkeys::CLASS_HEADER_HOTEL, 'logoSection' => Generalkeys::IMG_NAME_SECCION_WEB_HOTEL,
            'dateFrom' => DateUtil::formatDateToString(DateUtil::summDayToDate(DateUtil::Now(), Generalkeys::NUMBER_TWO)),
            'dateTo' => DateUtil::formatDateToString(DateUtil::summDayToDate(DateUtil::Now(), Generalkeys::NUMBER_THREE))));
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
