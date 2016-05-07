<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\utils\DateUtil;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\HotelUtils;
use VisitaYucatanBundle\utils\StringUtils;
use VisitaYucatanBundle\utils\to\ResponseTO;
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
    public function detailHotelAction($id, Request $request) {
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

    /**
     * @Route("/hotel/find/rates", name="web_hotel_rates")
     * @Method("GET")
     */
    public function getPricesRoom(Request $request) {
        $serializer = $this->get('serializer');
        try {
            // obtiene los datos de session moneda e idioma
            $datos = $this->getParamsTour($request);
            $adults = $request->get('adults');
            $minors = $request->get('minors');
            $dateFrom = $request->get('from');
            $dateTo = $request->get('to');
            $idHotel = $request->get('idHotel');
            //TODO path test = http://localhost/visitayucatan2.0/hotel/find/rates?adults=2&minors=3&from=08/05/2016&to=31/05/2016&idHotel=1
            echo "adultos = ".$adults." menores = ".$minors." dateFrom = ".$dateFrom." dateTO = ".$dateTo." idHotel = ".$idHotel." ****<br> ";
            // idcontrato actual 
            $idContract = $this->getDoctrine()->getRepository('VisitaYucatanBundle:HotelContrato')->findIdContractActiveByHotel($idHotel);
            echo("idcontrato = ".$idContract."<br>");
            $dateClosing = $this->getDoctrine()->getRepository('VisitaYucatanBundle:HotelFechaCierre')->findClosingDateByContractAndHotel($idHotel, $idContract);
            echo("fechas cierre ******************************************************<br>");
                print_r($dateClosing); echo "<br>";
            echo("fechas cierre ******************************************************<br>");
            $costosRoom = $this->getDoctrine()->getRepository('VisitaYucatanBundle:HotelTarifa')->getRateByRooms($idHotel, $datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE]);
            echo("COSTOS ******************************************************<br>");
            print_r($costosRoom); echo "<br>";
            echo("COSTOS ******************************************************<br><br><br><br><br>");
            $costs = HotelUtils::getCotizationRoom($costosRoom, $adults, $minors, $dateClosing);
            
            print_r($costs);
            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, Generalkeys::EMPTY_STRING, Generalkeys::RESPONSE_ERROR, Generalkeys::RESPONSE_CODE_OK);

            $response->setData($costs);

            return new Response($this->get('serializer')->serialize($response, Generalkeys::JSON_STRING));
            
        }catch (\Exception $e) {
            return new Response($this->get('serializer')->serialize(new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode()), Generalkeys::JSON_STRING));
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
}
// TODO cuando se aga reserva de hotel hay que actualizar el allotment