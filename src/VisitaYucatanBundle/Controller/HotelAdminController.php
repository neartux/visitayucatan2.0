<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\to\ResponseTO;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class HotelAdminController extends Controller {

    /**
     * @Route("/admin/hoteles", name="hotel_display_list")
     * @Method("GET")
     */
    public function displayHotelsAction(Request $request) {
        if (!$request->getSession()->get(Generalkeys::LABEL_STATUS)) {
            return $this->redirectToRoute('admin_login');
        }
        return $this->render('VisitaYucatanBundle:admin/hotels:Hotels.html.twig');
    }

    /**
     * @Route("/admin/hotel/find/destinos", name="hotel_find_list_destinos")
     * @Method("GET")
     */
    public function findAllDestinosAction() {
        $hotels = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Destino')->findAllDestinos();
        return new Response($this->get('serializer')->serialize($hotels, Generalkeys::JSON_STRING));
    }

    /**
     * @Route("/admin/hotel/find/list", name="hotel_find_list")
     * @Method("GET")
     */
    public function findAllHotelsAction() {
        $hotels = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotel')->findAllHotels();
        return new Response($this->get('serializer')->serialize($hotels, Generalkeys::JSON_STRING));
    }

    /**
     * @Route("/admin/hotel/find/contacts", name="hotel_find_list_contacts")
     * @Method("POST")
     */
    public function findContactsByHotelAction(Request $request) {
        $contacts = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotelcontacto')->findContactoByIdHotel($request->get('idHotel'));
        return new Response($this->get('serializer')->serialize($contacts, Generalkeys::JSON_STRING));
    }

    /**
     * @Route("/admin/hotel/create", name="hotel_create")
     * @Method("POST")
     */
    public function createHotelAction(Request $request) {
        $serializer = $this->get('serializer');
        try {
            $hotelTO = $serializer->deserialize($request->get('hotel'), 'VisitaYucatanBundle\utils\to\HotelTO', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotel')->createHotel($hotelTO);

            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Hotel '.$hotelTO->getDescripcion().' creado', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/hotel/update", name="hotel_update")
     * @Method("POST")
     */
    public function udpateHotelAction(Request $request) {
        $serializer = $this->get('serializer');
        try {
            $hotelTO = $serializer->deserialize($request->get('hotel'), 'VisitaYucatanBundle\utils\to\HotelTO', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotel')->updateHotel($hotelTO);

            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Hotel '.$hotelTO->getDescripcion().' modificado', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/hotel/delete", name="hotel_delete")
     * @Method("POST")
     */
    public function deleteHotelAction(Request $request) {
        $serializer = $this->get('serializer');
        try {
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotel')->deleteHotel($request->get('idHotel'));

            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'El hotel se ha eliminado del sistema', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }

    /**
     * @Route("/admin/hotel/create/contact", name="hotel_contact_create")
     * @Method("POST")
     */
    public function createHotelContactAction(Request $request) {
        $serializer = $this->get('serializer');
        try {
            print_r($request->get('hotelContacto'));
            $hotelContactoTO = $serializer->deserialize($request->get('hotelContacto'), 'VisitaYucatanBundle\utils\to\ContactoTO', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotelcontacto')->createHotelContacto($hotelContactoTO);

            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Contacto '.$hotelContactoTO->getNombres().' creado', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/hotel/contacto/delete", name="hotel_contacto_delete")
     * @Method("POST")
     */
    public function deleteHotelContactAction(Request $request) {
        $serializer = $this->get('serializer');
        try {
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotelcontacto')->deleteContactHotel($request->get('idHotelContacto'));

            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'El contacto del hotel se ha eliminado del sistema', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }

    /**
     * @Route("/admin/hotel/promove", name="hotel_promove")
     * @Method("POST")
     */
    public function promoveHotelAction(Request $request) {
        $serializer = $this->get('serializer');
        try {
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotel')->promoveOrNotPromoveHotel($request->get('idHotel'), Generalkeys::BOOLEAN_TRUE);
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Se ha promovido un nuevo hotel', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }

    /**
     * @Route("/admin/hotel/remove/promove", name="hotel_remove_promove")
     * @Method("POST")
     */
    public function removePromoveHotelAction(Request $request) {
        $serializer = $this->get('serializer');
        try {
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotel')->promoveOrNotPromoveHotel($request->get('idHotel'), Generalkeys::BOOLEAN_FALSE);
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Accion realizado correctamente', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }

}

/*TODO AQUI LA SECCION QUE FALTA VALIDAR O AGREGAR PERO NO ES NECESARIO A PRIMERA INSTANCIA

1.- Validar que si es una imagen u otro tipo de archivo
2.- Cambiar los mensajes por messages_properties por idiomas
3.- Agregar plugin para visualizacion previa de imagen, y mejor presentacion
4.- Agregar campo fechacreacion a base de datos en hotel, hotelidioma

*/
