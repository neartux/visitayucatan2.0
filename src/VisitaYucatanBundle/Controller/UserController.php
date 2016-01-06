<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\ResponseTO;

class UserController extends Controller{

    /**
     * @Route("/admin/user/list", name="user_display_list")
     * @Method("GET")
     */
    public function displayUserAction(Request $request){
        if(! $request->getSession()->get(Generalkeys::LABEL_STATUS)){
            return $this->redirectToRoute('admin_login');
        }
        return $this->render('VisitaYucatanBundle:admin/catalogs/user:User.html.twig');
    }

    /**
     * @Route("/admin/user/find/list", name="user_find_list")
     * @Method("GET")
     */
    public function findAllUsersAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $currency = $em->getRepository('VisitaYucatanBundle:Usuario')->findAllUsers();
        return new Response($this->get('serializer')->serialize($currency, Generalkeys::JSON_STRING));
    }

    /**
     * @Route("/admin/user/create", name="user_create")
     * @Method("POST")
     */
    public function createUserAction(Request $request){
        $serializer = $this->get('serializer');
        try {
            $userJson = $request->get('user');
            print_r($userJson);
            $user = $serializer->deserialize($userJson, 'VisitaYucatanBundle\Entity\Usuario', Generalkeys::JSON_STRING);
            print_r($user);
            //$this->getDoctrine()->getEntityManager()->getRepository('VisitaYucatanBundle:Usuario')->createUser($user);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("catalog.currency.report.message.success.create"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch( \Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/user/update", name="user_update")
     * @Method("POST")
     */
    public function udpateUserAction(Request $request){
        $serializer = $this->get('serializer');
        try {
            $userJson = $request->get('user');
            $user = $serializer->deserialize($userJson, 'VisitaYucatanBundle\Entity\Usuario', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getEntityManager()->getRepository('VisitaYucatanBundle:Usuario')->updateUser($user);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("catalog.currency.report.message.success.update"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch( \Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/user/delete", name="user_delete")
     * @Method("POST")
     */
    public function deleteUserAction(Request $request){
        $serializer = $this->get('serializer');
        try{
            $idUser = $request->get('idUser');
            $em = $this->getDoctrine()->getEntityManager();
            $em->getRepository('VisitaYucatanBundle:Usuario')->deleteUser($idUser);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("catalog.currency.report.message.delete"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        }catch (\Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }
}
