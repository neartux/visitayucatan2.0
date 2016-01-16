<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\to\ResponseTO;

class UserController extends Controller{

    /**
     * @Route("/admin/users", name="user_display_list")
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
        $users = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Usuario')->findAllUsers();
        return new Response($this->get('serializer')->serialize($users, Generalkeys::JSON_STRING));
    }

    /**
     * @Route("/admin/user/create", name="user_create")
     * @Method("POST")
     */
    public function createUserAction(Request $request){
        $serializer = $this->get('serializer');
        try {
            $userJson = $request->get('user');
            //print_r($userJson);
            $user = $serializer->deserialize($userJson, 'VisitaYucatanBundle\utils\to\UsuarioTO', Generalkeys::JSON_STRING);
            //print_r($user);
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Usuario')->createUser($user);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("catalog.user.report.message.success.create"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
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
            $user = $serializer->deserialize($userJson, 'VisitaYucatanBundle\utils\to\UsuarioTO', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Usuario')->updateUser($user);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("catalog.user.report.message.success.update"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
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
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Usuario')->deleteUser($idUser);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("catalog.user.report.message.delete"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        }catch (\Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }
}


/*TODO AQUI LA SECCION QUE FALTA VALIDAR O AGREGAR PERO NO ES NECESARIO A PRIMERA INSTANCIA

1.- Validar que si un usuario elimino o edito su proprio usuario redireccionar a la pagina de login
2.- Agregar imagen a perfil de usuario
3.- Hacer aplicacion para cambiar la contraseña de usuario

*/