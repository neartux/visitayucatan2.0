<?php
namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\PaqueteUtils;
use VisitaYucatanBundle\utils\StringUtils;
use VisitaYucatanBundle\utils\to\ResponseTO;

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
            'pageDescription' => $descripcion, 'descripcionCorta' => $descripcionCorta,
            'isVisibleHotels' => $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->isVisibleHotels(),
            'metaDescription' => $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->findParameterValueByKey(Generalkeys::META_DESCRIPTION_PACKAGE)));
	}

	private function getParamsPaquete(Request $request){
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
        return $this->render('VisitaYucatanBundle:web/pages:detalle-package.html.twig', array('paquete' => PaqueteUtils::getPaqueteTO($paquete, $imagesPaquete,$paqueteCombinacion),
            'isVisibleHotels' => $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->isVisibleHotels(),
            'metaDescription' => $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->findParameterValueByKey(Generalkeys::META_DESCRIPTION_PACKAGE)));
    }
    /**
     * @Route("/paquete/reserva", name="web_paquete_reserva")
     * @Method("POST")
    */
    public function reservaPaqueteAction(Request $request){
        $id= $request->get('id');
        $idPackage = $request->get('idPackage');
        $ocupacion = $request->get('typeocupacion');
        $costo = $request->get('costo');
        $namePaquete = $request->get('namepaquete');
        $datos = $this->getParamsPaquete($request);

        $menores = 0;
        $adultos = 0;
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
        $paquete = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Paquete')->getPaqueteById($idPackage, $datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE]);
         $importeTotal = $costo * $adultos;
         $paqueteCombinacion = $this->getDoctrine()->getRepository('VisitaYucatanBundle:PaqueteCombinacionHotel')->findCombinacionPaqueteById((int)$id,$datos[Generalkeys::NUMBER_ONE]);
        $imagesPaquete = $this->getDoctrine()->getRepository('VisitaYucatanBundle:PaqueteImagen')->findPaqueteImagesByIdPaquete($idPackage);

         return $this->render('VisitaYucatanBundle:web/pages:reserv-paquete.html.twig', array('paqueteCombinacion' => PaqueteUtils::getPaqueteTO(null, null,$paqueteCombinacion),'detailPaquete'=>$detailPaquete,'importe'=>number_format($importeTotal),
             'paquete' => PaqueteUtils::getPaqueteTO($paquete, $imagesPaquete,$paqueteCombinacion), 
             'tipoCambioMexico' => $this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->findMonedaMexico(),
             'isVisibleHotels' => $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->isVisibleHotels(),
             'metaDescription' => $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->findParameterValueByKey(Generalkeys::META_DESCRIPTION_PACKAGE)));
    }

    /**
     * @Route("/paquete/find/similares", name="paquete_find_list_similares")
     * @Method("POST")
     */
    public function findPackageSimilar(Request $request) {
        $datos = $this->getParamsPaquete($request);
        $paquetes = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Paquete')->findPaquetesSimilares($request->get('id'), 5, $datos[1], $datos[0]);
        return new Response($this->get('serializer')->serialize($paquetes, Generalkeys::JSON_STRING));
    }

    /**
     * @Route("/paquete/find/imagenes/hotel", name="paquete_find_list_hotel_images")
     * @Method("POST")
     */
    public function findImagenesHotel(Request $request) {
        $imagenes = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotelimagen')->findPathImagesHotel($request->get('idHotel'));
        return new Response($this->get('serializer')->serialize($imagenes, Generalkeys::JSON_STRING));
    }

    /**
     * @Route("/paquete/createReservationPackage", name="web_package_reserva_create")
     * @Method("POST")
     */
    public function createReservationTour(Request $request) {
        $serializer = $this->get('serializer');
        $em = $this->getDoctrine()->getManager();

        $em->getConnection()->beginTransaction();
        try {
            $ventaCompletaTO = $serializer->deserialize($request->get('ventaCompletaTO'), 'VisitaYucatanBundle\utils\to\VentaCompletaTO', Generalkeys::JSON_STRING);
            $idVenta = $em->getRepository('VisitaYucatanBundle:Venta')->createSalePackage($ventaCompletaTO);
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
}