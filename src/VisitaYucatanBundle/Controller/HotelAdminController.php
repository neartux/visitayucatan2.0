<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\HotelUtils;
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
            $hotelContactoTO = $serializer->deserialize($request->get('hotelContacto'), 'VisitaYucatanBundle\utils\to\ContactoTO', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotelcontacto')->createHotelContacto($hotelContactoTO);

            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Contacto creado', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
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

    /**
     * @Route("/admin/hotel/find/by/language", name="hotel_find_by_language")
     * @Method("POST")
     */
    public function findHotelByIdAndLanguageAction(Request $request) {
        try {
            $idHotel = $request->get('idHotel');
            $idLanguage = $request->get('idLanguage');
            $hotel = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotelidioma')->findHotelByIdAndIdLanguage($idHotel, $idLanguage);
            return new Response($this->get('serializer')->serialize(HotelUtils::convertEntityHotelIdiomaToHotelidiomaTO($hotel), Generalkeys::JSON_STRING));
        } catch (\Exception $e) {
            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($this->get('serializer')->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/hotel/find/images", name="hotel_find_images")
     * @Method("POST")
     */
    public function findImagesHotelByIdAction(Request $request) {
        $idHotel = $request->get('idHotel');
        $images = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotelimagen')->findHotelImagesByIdHotel($idHotel);
        return new Response($this->get('serializer')->serialize(HotelUtils::getListImagenTO($images), Generalkeys::JSON_STRING));
    }

    /**
     * @Route("/admin/hotel/save/hotellanguage", name="hotel_save_hotellanguage")
     * @Method("POST")
     */
    public function saveHotelLanguageAction(Request $request) {
        $serializer = $this->get('serializer');
        try {
            $hotelLanguageJson = $request->get('hotelLanguage');
            $hotelIdiomaTO = $serializer->deserialize($hotelLanguageJson, 'VisitaYucatanBundle\utils\to\HotelidiomaTO', Generalkeys::JSON_STRING);
            $isNew = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotelidioma')->saveHotelLanguage($hotelIdiomaTO);
            $message = 'Se ha modificado la información para el hotel ' . $hotelIdiomaTO->getNombreHotel();
            if ($isNew) {
                $message = 'Se ha agregado la informacion para un nuevo idioma del hotel ' . $hotelIdiomaTO->getNombreHotel();
            }
            return new Response($serializer->serialize(new ResponseTO(Generalkeys::RESPONSE_TRUE, $message, Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK), Generalkeys::JSON_STRING));
        } catch (\Exception $e) {
            return new Response($serializer->serialize(new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode()), Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/hotel/upload/image", name="hotel_upload_image")
     * @Method("POST")
     */
    public function uploadImageHotelAction(Request $request) {
        try {
            $em = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotelimagen');
            // Obtiene los datos enviados, imagen y el id del hotel
            $image = $request->files->get('file');
            $idHotel = $request->get('idApplication');
            // Instancia el archivo al un objeto
            if (($image instanceof UploadedFile) && ($image->getError() == Generalkeys::NUMBER_ZERO)) {
                // Busca el folio siguiente
                $folio = $em->findNextFolio();
                // Si no se pudo encontrar el folio regresa mensaje error
                if ($folio == Generalkeys::NOT_FOUND_FOLIO) {
                    return new JsonResponse(array('answer' => 'No se pudo encontrar folio, intentar de nuevo'));
                }
                // Arma un nuevo nombre para la imagen, esto es por si se sube diferentes imagenes con el mismo nombre
                $newName = Generalkeys::PART_NAME_HOTEL . $idHotel . Generalkeys::PART_NAME_FOLIO . $folio . "." . $image->getClientOriginalExtension();
                // Mueve la imagen a su carpeta
                $image->move(Generalkeys::PATH_HOTELES_IMAGE, $newName);
                // Guarda el registro de la imagen hotel
                $em->uploadHotelImage($image->getClientOriginalName(), $newName, $folio, Generalkeys::PATH_HOTELES_IMAGE . $newName, $image->getClientOriginalExtension(), $idHotel);
                return new JsonResponse(array('answer' => 'Se ha cargado la imagen correctamente'));
            }
        } catch (\Exception $e) {
            return new JsonResponse(array('answer' => $e->getMessage()));
        }
    }

    /**
     * @Route("/admin/hotel/delete/image", name="hotel_delete_image")
     * @Method("POST")
     */
    public function deleteImageHotelAction(Request $request) {
        try {
            $idImageHotel = $request->get('idImageHotel');
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotelimagen')->deleteImageHotel($idImageHotel);
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Se ha eliminado correctamente la imagen con id ' . $idImageHotel, Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($this->get('serializer')->serialize($response, Generalkeys::JSON_STRING));
        } catch (\Exception $e) {
            return new Response($this->get('serializer')->serialize(new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode()), Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/hotel/principal/image", name="hotel_principal_image")
     * @Method("POST")
     */
    public function setPrincipalImageHotelAction(Request $request) {
        try {
            $idImageHotel = $request->get('idImageHotel');
            $idHotel = $request->get('idHotel');
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Hotelimagen')->setPrincipalImageHotel($idHotel, $idImageHotel);
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Nueva imagen principal asignada', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($this->get('serializer')->serialize($response, Generalkeys::JSON_STRING));
        } catch (\Exception $e) {
            return new Response($this->get('serializer')->serialize(new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode()), Generalkeys::JSON_STRING));
        }
    }

}

/*TODO AQUI LA SECCION QUE FALTA VALIDAR O AGREGAR PERO NO ES NECESARIO A PRIMERA INSTANCIA

1.- Validar que si es una imagen u otro tipo de archivo
2.- Cambiar los mensajes por messages_properties por idiomas
3.- Agregar plugin para visualizacion previa de imagen, y mejor presentacion
4.- Agregar campo fechacreacion a base de datos en hotel, hotelidioma

*/