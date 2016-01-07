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
     * @Route("/admin/tour/list", name="tour_display_list")
     * @Method("GET")
     */
    public function displayToursAction(Request $request){
        if(! $request->getSession()->get(Generalkeys::LABEL_STATUS)){
            return $this->redirectToRoute('admin_login');
        }
        return $this->render('VisitaYucatanBundle:admin/tours:Tours.html.twig');
    }

    /**
     * @Route("/admin/tour/find/list", name="tour_find_list")
     * @Method("GET")
     */
    public function findAllToursAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $tours = $em->getRepository('VisitaYucatanBundle:Tour')->findAllTours();
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
            $this->getDoctrine()->getEntityManager()->getRepository('VisitaYucatanBundle:Tour')->createTour($tour);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("catalog.user.report.message.success.create"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
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
            $this->getDoctrine()->getEntityManager()->getRepository('VisitaYucatanBundle:Tour')->updateTour($tour);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("catalog.user.report.message.success.update"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
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
            $em = $this->getDoctrine()->getEntityManager();
            $em->getRepository('VisitaYucatanBundle:Tour')->deleteTour($idTour);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("catalog.user.report.message.delete"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        }catch (\Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }
}
