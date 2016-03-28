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
		   $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("tour.report.label.tour.created"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
		   return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

		} catch (\Exception $e) {

		   $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
		   return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
		}
 	}
}
