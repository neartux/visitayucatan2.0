<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\Entity\Tourimagen;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\to\ResponseTO;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use VisitaYucatanBundle\utils\TourUtils;

class TourAdminController extends Controller
{

    /**
     * @Route("/admin/tours", name="tour_display_list")
     * @Method("GET")
     */
    public function displayToursAction(Request $request)
    {
        if (!$request->getSession()->get(Generalkeys::LABEL_STATUS)) {
            return $this->redirectToRoute('admin_login');
        }
        return $this->render('VisitaYucatanBundle:admin/tours:Tours.html.twig');
    }

    /**
     * @Route("/admin/tour/find/list", name="tour_find_list")
     * @Method("GET")
     */
    public function findAllToursAction()
    {
        $tours = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->findAllTours();
        return new Response($this->get('serializer')->serialize($tours, Generalkeys::JSON_STRING));
    }

    /**
     * @Route("/admin/tour/create", name="tour_create")
     * @Method("POST")
     */
    public function createTourAction(Request $request)
    {
        $serializer = $this->get('serializer');
        try {
            $tourJson = $request->get('tour');
            $tour = $serializer->deserialize($tourJson, 'VisitaYucatanBundle\Entity\Tour', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->createTour($tour);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("tour.report.label.tour.created"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/tour/update", name="tour_update")
     * @Method("POST")
     */
    public function udpateTourAction(Request $request)
    {
        $serializer = $this->get('serializer');
        try {
            $tourJson = $request->get('tour');
            $tour = $serializer->deserialize($tourJson, 'VisitaYucatanBundle\Entity\Tour', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->updateTour($tour);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("tour.report.label.tour.updated"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/tour/delete", name="tour_delete")
     * @Method("POST")
     */
    public function deleteTourAction(Request $request)
    {
        $serializer = $this->get('serializer');
        try {
            $idTour = $request->get('idTour');
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->deleteTour($idTour);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("tour.report.label.tour.deleted"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }

    /**
     * @Route("/admin/tour/promove", name="tour_promove")
     * @Method("POST")
     */
    public function promoveTourAction(Request $request)
    {
        $serializer = $this->get('serializer');
        try {
            $idTour = $request->get('idTour');
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->promoveOrNotPromoveTour($idTour, Generalkeys::BOOLEAN_TRUE);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("tour.report.label.tour.promoved"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }

    /**
     * @Route("/admin/tour/remove/promove", name="tour_remove_promove")
     * @Method("POST")
     */
    public function removePromoveTourAction(Request $request)
    {
        $serializer = $this->get('serializer');
        try {
            $idTour = $request->get('idTour');
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->promoveOrNotPromoveTour($idTour, Generalkeys::BOOLEAN_FALSE);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("tour.report.label.tour.removed.promoved"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }

    /**
     * @Route("/admin/tour/find/tour/by/idtour/idlanguage", name="tour_find_by_language")
     * @Method("POST")
     */
    public function findTourByIdAndLanguageAction(Request $request) {
        try {
            $idTour = $request->get('idTour');
            $idLanguage = $request->get('idLanguage');
            $tour = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Touridioma')->findTourByIdAndIdLanguage($idTour, $idLanguage);
            return new Response($this->get('serializer')->serialize(TourUtils::convertEntityTouriomaToTouridiomaTO($tour), Generalkeys::JSON_STRING));
        } catch (\Exception $e){
            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($this->get('serializer')->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/tour/find/images", name="tour_find_images")
     * @Method("POST")
     */
    public function findImagesTourByIdAction(Request $request) {
        $idTour = $request->get('idTour');
        $images = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tourimagen')->findTourImagesByIdTour($idTour);
        return new Response($this->get('serializer')->serialize(TourUtils::getListImagenTO($images), Generalkeys::JSON_STRING));
    }

    /**
     * @Route("/admin/tour/upload/image", name="tour_upload_image")
     * @Method("POST")
     */
    public function uploadImageTourAction(Request $request) {
        try {
            $em = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tourimagen');
            // Obtiene los datos enviados, imagen y el id del tour
            $image = $request->files->get('file');
            $idTour = $request->get('idApplication');
            // Instancia el archivo al un objeto
            if (($image instanceof UploadedFile) && ($image->getError() == Generalkeys::NUMBER_ZERO)) {
                // Busca el folio siguiente
                $folio = $em->findNextFolio();
                // Si no se pudo encontrar el folio regresa mensaje error
                if ($folio == Generalkeys::NOT_FOUND_FOLIO) {
                    return new JsonResponse(array('answer' => 'No se pudo encontrar folio, intentar de nuevo'));
                }
                // Arma un nuevo nombre para la imagen, esto es por si se sube diferentes imagenes con el mismo nombre
                $newName = Generalkeys::PART_NAME_TOUR . $idTour . Generalkeys::PART_NAME_FOLIO . $folio . "." . $image->getClientOriginalExtension();
                // Mueve la imagen a su carpeta
                $image->move(Generalkeys::PATH_TOURS_IMAGE, $newName);
                // Guarda el registro de la imagen tour
                $em->uploadTourImage($image->getClientOriginalName(), $newName, $folio, Generalkeys::PATH_TOURS_IMAGE . $newName, $image->getClientOriginalExtension(), $idTour);
                return new JsonResponse(array('answer' => 'Se ha cargado la imagen correctamente'));
            }
        }catch (\Exception $e){
            return new JsonResponse(array('answer' => $e->getMessage()));
        }
    }

    /**
     * @Route("/admin/tour/delete/image", name="tour_delete_image")
     * @Method("POST")
     */
    public function deleteImageTourAction(Request $request){
        try{
            $idImageTour = $request->get('idImageTour');
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tourimagen')->deleteImageTour($idImageTour);
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Se ha eliminado correctamente la imagen con id '.$idImageTour, Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($this->get('serializer')->serialize($response, Generalkeys::JSON_STRING));
        } catch (\Exception $e){
            return new Response($this->get('serializer')->serialize(new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode()), Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/tour/principal/image", name="tour_principal_image")
     * @Method("POST")
     */
    public function setPrincipalImageTourAction(Request $request){
        try{
            $idImageTour = $request->get('idImageTour');
            $idTour = $request->get('idTour');
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tourimagen')->setPrincipalImageTour($idTour, $idImageTour);
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Nueva imagen principal asignada', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($this->get('serializer')->serialize($response, Generalkeys::JSON_STRING));
        } catch (\Exception $e){
            return new Response($this->get('serializer')->serialize(new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode()), Generalkeys::JSON_STRING));
        }
    }

}

/*TODO AQUI LA SECCION QUE FALTA VALIDAR O AGREGAR PERO NO ES NECESARIO A PRIMERA INSTANCIA

1.- Validar que si es una imagen u otro tipo de archivo
2.- Cambiar los mensajes por messages_properties por idiomas
3.- Agregar plugin para visualizacion previa de imagen, y mejor presentacion

*/
