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
use VisitaYucatanBundle\utils\PaqueteUtils;

class PaqueteAdminController extends Controller {
	/**
     * @Route("/admin/paquetes", name="paquete_display_list")
     * @Method("GET")
   */
	public function displayPaquetesAction(Request $request) {
	  if (!$request->getSession()->get(Generalkeys::LABEL_STATUS)) {
	      return $this->redirectToRoute('admin_login');
	   }
	  return $this->render('VisitaYucatanBundle:admin/paquetes:Paquetes.html.twig');
	}

	/**
     * @Route("/admin/paquete/find/list", name="paquete_find_list")
     * @Method("GET")
     */
	public function findAllPaquetesAction() {
	  $tours = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Paquete')->findAllPaquetes();
	  return new Response($this->get('serializer')->serialize($tours, Generalkeys::JSON_STRING));
	}

	/**
     * @Route("/admin/paquete/create", name="paquete_create")
     * @Method("POST")
     */
	public function createPaqueteAction(Request $request) {
		$serializer = $this->get('serializer');
		try {
		   $paqueteJson = $request->get('paquete');
		   $paqueteTO = $serializer->deserialize($paqueteJson,'VisitaYucatanBundle\utils\to\PaqueteTO',Generalkeys::JSON_STRING);
		   //$tourTO = $serializer->deserialize($tourJson, 'VisitaYucatanBundle\utils\to\TourTO', Generalkeys::JSON_STRING);
		   //print_r($tourTO);
		   $this->getDoctrine()->getRepository('VisitaYucatanBundle:Paquete')->createPaquete($paqueteTO);

		   $translator = $this->get('translator');
		   $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("El paquete se ha creado"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
		   return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

		} catch (\Exception $e) {

		   $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
		   return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
		}
 	}

 	/**
     * @Route("/admin/paquete/update", name="paquete_update")
     * @Method("POST")
   */
	public function updatePaqueteAction(Request $request) {
		$serializer = $this->get('serializer');
        try {
            $paqueteJson = $request->get('paquete');
            $paqueteTO = $serializer->deserialize($paqueteJson, 'VisitaYucatanBundle\utils\to\PaqueteTO', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Paquete')->updatePaquete($paqueteTO);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Paquete actualizado', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
	}

 	/**
     * @Route("/admin/paquete/delete", name="paquete_delete")
     * @Method("POST")
   */
	public function deleteTourAction(Request $request) {
		$serializer = $this->get('serializer');
		try {
		   $idPaquete = $request->get('idPaquete');
		   $this->getDoctrine()->getRepository('VisitaYucatanBundle:Paquete')->deletePaquete($idPaquete);

		   $translator = $this->get('translator');
		   $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("tour.report.label.tour.deleted"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
		   return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

		} catch (\Exception $e) {

		   $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
		   return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
		}

	}

	/**
     * @Route("/admin/paquete/find/paquete/by/idtpaquete/idlanguage", name="paquete_find_by_language")
     * @Method("POST")
    */
	public function findPaqueteByIdAndLanguageAction(Request $request) {
		try {
			$idPaquete = $request->get('idPaquete');
			$idLanguage = $request->get('idLanguage');
			$paquete = $this->getDoctrine()->getRepository('VisitaYucatanBundle:PaqueteIdioma')->findPaqueteByIdAndIdLanguage($idPaquete, $idLanguage);
			/*if(is_null($paquete)){
				//echo "es nullo paquete";
				$response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Es nullo', Generalkeys::RESPONSE_ERROR, Generalkeys::RESPONSE_CODE_OK);
				return new Response($this->get('serializer')->serialize($response,Generalkeys::JSON_STRING));
			}else
			{*/
				return new Response($this->get('serializer')->serialize(PaqueteUtils::convertEntityPaqueteiomaToPaqueteidiomaTO($paquete), Generalkeys::JSON_STRING));
			//}
			
		} catch (\Exception $e) {
			$response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
			return new Response($this->get('serializer')->serialize($response, Generalkeys::JSON_STRING));
		}
	}

	/**
     * @Route("/admin/paquete/save/paquetelanguage", name="paquete_save_paquetelanguage")
     * @Method("POST")
     */
    public function savePaqueteLanguageAction(Request $request) {
        $serializer = $this->get('serializer');
        try {
            $paqueteLanguageJson = $request->get('paqueteLanguage');
            $paqueteIdiomaTO = $serializer->deserialize($paqueteLanguageJson, 'VisitaYucatanBundle\utils\to\PaqueteidiomaTO', Generalkeys::JSON_STRING);
            $isNew = $this->getDoctrine()->getRepository('VisitaYucatanBundle:PaqueteIdioma')->savePaqueteLanguage($paqueteIdiomaTO);
            $message = 'Se ha modificado la información para el paquete ' . $paqueteIdiomaTO->getDescripcion();
            if ($isNew) {
                $message = 'Se ha agregado la informacion para un nuevo idioma del paquete ' . $paqueteIdiomaTO->getDescripcion();
            }
            return new Response($serializer->serialize(new ResponseTO(Generalkeys::RESPONSE_TRUE, $message, Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK), Generalkeys::JSON_STRING));
        } catch (\Exception $e) {
            return new Response($serializer->serialize(new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode()), Generalkeys::JSON_STRING));
        }
    }
}
