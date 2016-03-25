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
}
