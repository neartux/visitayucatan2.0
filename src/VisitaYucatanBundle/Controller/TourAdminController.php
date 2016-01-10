<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\to\ResponseTO;

class TourAdminController extends Controller{

    /**
     * @Route("/admin/tours", name="tour_display_list")
     * @Method("GET")
     */
    public function displayToursAction(Request $request){
        if(! $request->getSession()->get(Generalkeys::LABEL_STATUS)){
            return $this->redirectToRoute('admin_login');
        }
        $this->get('session')->set('_locale', 'es');
        return $this->render('VisitaYucatanBundle:admin/tours:Tours.html.twig');
    }

    /**
     * @Route("/admin/tour/find/list", name="tour_find_list")
     * @Method("GET")
     */
    public function findAllToursAction(){
        $tours = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->findAllTours();
        return new Response($this->get('serializer')->serialize($tours, Generalkeys::JSON_STRING));
    }

    /**
     * @Route("/admin/tour/create", name="tour_create")
     * @Method("POST")
     */
    public function createTourAction(Request $request){
        $serializer = $this->get('serializer');
        try {
            $tourJson = $request->get('tour');
            $tour = $serializer->deserialize($tourJson, 'VisitaYucatanBundle\Entity\Tour', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->createTour($tour);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("tour.report.label.tour.created"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch( \Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/tour/update", name="tour_update")
     * @Method("POST")
     */
    public function udpateTourAction(Request $request){
        $serializer = $this->get('serializer');
        try {
            $tourJson = $request->get('tour');
            $tour = $serializer->deserialize($tourJson, 'VisitaYucatanBundle\Entity\Tour', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->updateTour($tour);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("tour.report.label.tour.updated"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch( \Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/tour/delete", name="tour_delete")
     * @Method("POST")
     */
    public function deleteTourAction(Request $request){
        $serializer = $this->get('serializer');
        try{
            $idTour = $request->get('idTour');
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->deleteTour($idTour);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("tour.report.label.tour.deleted"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        }catch (\Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }

    /**
     * @Route("/admin/tour/promove", name="tour_promove")
     * @Method("POST")
     */
    public function promoveTourAction(Request $request){
        $serializer = $this->get('serializer');
        try{
            $idTour = $request->get('idTour');
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->promoveOrNotPromoveTour($idTour, Generalkeys::BOOLEAN_TRUE);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("tour.report.label.tour.promoved"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        }catch (\Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }

    /**
     * @Route("/admin/tour/remove/promove", name="tour_remove_promove")
     * @Method("POST")
     */
    public function removePromoveTourAction(Request $request){
        $serializer = $this->get('serializer');
        try{
            $idTour = $request->get('idTour');
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->promoveOrNotPromoveTour($idTour, Generalkeys::BOOLEAN_FALSE);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("tour.report.label.tour.removed.promoved"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        }catch (\Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }
}
