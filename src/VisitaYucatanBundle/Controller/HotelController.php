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
     * @Route("/hoteles/{city}", name="web_hoteles_merida")
     * @Method("GET")
     */
    public function hotelesPorCiudadAction(Request $request, $city) {
        // obtiene los datos de session moneda e idioma
        $datos = $this->getParamsTour($request);
        // encuentra la descripcio de la pagina, obtiene la descripcion corta
        $descriptionPage = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Articulo')->getArticuloPage(Generalkeys::TIPO_ARTICULO_PAGINA, Generalkeys::TIPO_ARTICULO_PAGINA_HOTEL, $datos[Generalkeys::NUMBER_ZERO]);
        $descripcion = $descriptionPage['descripcion'];
        $descripcionCorta = StringUtils::cutText($descriptionPage['descripcion'], Generalkeys::NUMBER_ZERO, Generalkeys::NUMBER_ONE_HUNDRED_FIFTEEN, Generalkeys::COLILLA_TEXT, Generalkeys::CIERRE_HTML_P);
        // busca todos los hoteles activos y publicados
        $hotels = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotel')->getHotelsByDestino($datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE], $city ,Generalkeys::OFFSET_ROWS_ZERO, Generalkeys::LIMIT_ROWS_TWENTY);
        // renderiza la vista y manda la informacion
        return $this->render('VisitaYucatanBundle:web/pages:hotels.html.twig', array('hotels' => HotelUtils::getHotels($hotels),
            'pageDescription' => $descripcion, 'descripcionCorta' => $descripcionCorta,
            'claseImg' => Generalkeys::CLASS_HEADER_HOTEL, 'logoSection' => Generalkeys::IMG_NAME_SECCION_WEB_HOTEL));
    }

    /**
     * @Route("/hotel/detail/id/{id}", name="web_hotel_detail")
     * @Method("GET")
     */
    public function detailHotelAction($id, Request $request) {
        $datos = $this->getParamsTour($request);

        $hotel = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotel')->getHotelById($id, $datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE]);
        $images = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotelimagen')->findHotelImagesByIdHotel($id);
        $idContract = $this->getDoctrine()->getRepository('VisitaYucatanBundle:HotelContrato')->findIdContractActiveByHotel($id);
        if($idContract == ""){
            $idContract = Generalkeys::NUMBER_ZERO;
        }
        $planAlimentos = $this->getDoctrine()->getRepository('VisitaYucatanBundle:HotelContrato')->findPlanAlimentosByContract($idContract);
        $edadMenor = $this->getDoctrine()->getRepository('VisitaYucatanBundle:HotelContrato')->findAgeMinorByContract($idContract);
        if($edadMenor == "") {
            $edadMenor = Generalkeys::NUMBER_ZERO;
        }
        return $this->render('VisitaYucatanBundle:web/pages:detalle-hotel.html.twig', array('hotel' => HotelUtils::getDetailHotel($hotel, $images),
            'dateFrom' => DateUtil::formatDateToString(DateUtil::summDayToDate(DateUtil::Now(), Generalkeys::NUMBER_ZERO)),
            'dateTo' => DateUtil::formatDateToString(DateUtil::summDayToDate(DateUtil::Now(), Generalkeys::NUMBER_ONE)),
            'ageMinor' => $edadMenor,
            'planAlimentos' => $planAlimentos));
    }

    /**
     * @Route("/hotel/reserva", name="web_hotel_reserva")
     * @Method("POST")
     */
    public function reservaHotelAction(Request $request) {
        $datos = $this->getParamsTour($request);

        $idHotel = $request->get('idHotel');
        $idHabitacion = $request->get('idHabitacion');
        $fechaInicio = $request->get('fechaInicio');
        $fechaFin = $request->get('fechaFin');
        $adultos = $request->get('adultos');
        $menores = $request->get('menores');

        //echo "hotel = ".$idHotel." habitacion = ".$idHabitacion." fechaInicio = ".$fechaInicio." fechafin = ".$fechaFin." adultos = ".$adultos." menores = ".$menores;

        $hotel = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotel')->getHotelById($idHotel, $datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE]);
        $tarifa = $this->getDoctrine()->getRepository('VisitaYucatanBundle:HotelTarifa')->findDetailHotel(DateUtil::formatDate($fechaInicio), $idHotel, $idHabitacion, $datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE]);
        $reserva = HotelUtils::getHotelReserva($fechaInicio, $fechaFin, $adultos, $menores,$hotel, $tarifa);
        $reserva->setIdHotel((int)$idHotel);
        $reserva->setIdHabitacion((int)$idHabitacion);
        return $this->render('VisitaYucatanBundle:web/pages:reserv-hotel.html.twig', array('dateFrom' => $fechaInicio, 'dateTo' => $fechaFin, 'reserva' => $reserva,
            'tipoCambioMexico' => $this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->findMonedaMexico()));
    }

    /**
     * @Route("/hotel/createReservationHotel", name="web_hotel_reserva_create")
     * @Method("POST")
     */
    public function createReservationHotel(Request $request) {
        $serializer = $this->get('serializer');
        $em = $this->getDoctrine()->getManager();

        $em->getConnection()->beginTransaction();
        try {
            $ventaCompletaTO = $serializer->deserialize($request->get('ventaCompletaTO'), 'VisitaYucatanBundle\utils\to\VentaCompletaTO', Generalkeys::JSON_STRING);
            $idVenta = $em->getRepository('VisitaYucatanBundle:Venta')->createSaleHotel($ventaCompletaTO);
            $em->getConnection()->commit();
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Se ha creado la reserva', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            $response->setId($idVenta);
            $request->getSession()->set("idVentaGenerada", $idVenta);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/hotel/find/rates", name="web_hotel_rates")
     * @Method("POST")
     */
    public function getPricesRoom(Request $request) {
        try {
            // obtiene los datos de session moneda e idioma
            $datos = $this->getParamsTour($request);
            $adults = $request->get('adults');
            $minors = $request->get('minors');
            $dateFrom = $request->get('from');
            $dateTo = $request->get('to');
            $idHotel = $request->get('idHotel');
            //echo "adultos = ".$adults;
            //TODO path test = http://localhost/visitayucatan2.0/hotel/find/rates?adults=2&minors=3&from=08/05/2016&to=31/05/2016&idHotel=1
            $idContract = $this->getDoctrine()->getRepository('VisitaYucatanBundle:HotelContrato')->findIdContractActiveByHotel($idHotel);
            //echo "idcontrado activo = ".$idContract." <br>";
            $dateClosing = $this->getDoctrine()->getRepository('VisitaYucatanBundle:HotelFechaCierre')->findClosingDateByContractAndHotel($idHotel, $idContract);
            //echo "fechas cierre = ".print_r($dateClosing); echo " <br>";
            $costosRoom = $this->getDoctrine()->getRepository('VisitaYucatanBundle:HotelTarifa')->getRateByRooms(DateUtil::formatDate($dateFrom), DateUtil::subtractOneDayTodate(DateUtil::formatDate($dateTo)), $idHotel, $datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE], $idContract);

            $costs = HotelUtils::getCotizationRoom($costosRoom, $adults, $minors, $dateClosing);
            
            //print_r($costs);
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, Generalkeys::EMPTY_STRING, Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);

            $response->setData($costs);
            // TODO siguiente codigo comentado para impresion de fechas y costos mas rapido
            /*foreach ($response->getData() as $value) {
                echo "habitacion = ".$value->getNombre()."<br> descripcion = ".$value->getDescripcion()."<br>";
                echo "<br><br>";
                foreach ($value->getHotelTarifasTOCollection() as $item) {
                    echo "capacidad maxima = ".$item->getCapacidadMaxima()." fecha = ".$item->getSmallDate()." costo = ".$item->getCosto()." disponible = ".$item->getIsAvailable()." msj = ".$item->getMsjAvailable();
                    echo "<br>";
                }
                echo "GRAND TOTAL = ".$value->getTotalCostoHabitacion();
                echo "<br><br>";
                echo "cambio de habitacion *****************************************************************************************************************************";
                echo "<br><br>";

            }*/

            return new Response($this->get('serializer')->serialize($response, Generalkeys::JSON_STRING));
            
        }catch (\Exception $e) {
            return new Response($this->get('serializer')->serialize(new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode()), Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/hotel/find/fechasCierreHotel/{idHotel}", name="find_fechas_cierre_hotel")
     * @Method("GET")
     */
    public function findFechasCierresByHotel($idHotel){
        $idContract = $this->getDoctrine()->getRepository('VisitaYucatanBundle:HotelContrato')->findIdContractActiveByHotel($idHotel);
        $dateClosing = $this->getDoctrine()->getRepository('VisitaYucatanBundle:HotelFechaCierre')->findClosingDateByContractAndHotel($idHotel, $idContract);
        return new Response($this->get('serializer')->serialize(HotelUtils::getArrayClosingDates($dateClosing), Generalkeys::JSON_STRING));
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