<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\to\ResponseTO;
use VisitaYucatanBundle\utils\VentaUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use VisitaYucatanBundle\Resources\captcha\ReCaptcha\ReCaptcha;

class LoginController extends Controller {

    /**
     * @Route("/index", name="page_home_admin")
     * @Method("GET")
     */
    public function indexAction(Request $request) {
        if(! $request->getSession()->get(Generalkeys::LABEL_STATUS)){
            return $this->redirectToRoute('admin_login');
        }
        $ventas = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Venta')->findBy([], ['id' => 'DESC']);
        return $this->render('VisitaYucatanBundle:Default:index.html.twig', array("ventas" => VentaUtils::getAllVentas($ventas)));
    }

    /**
     * @Route("/admin/login", name="admin_login")
     * @Method("GET")
     */
    public function displayLoginAction(Request $request){
        if($request->getSession()->get(Generalkeys::LABEL_STATUS)){
            return $this->redirectToRoute('page_home_admin');
        }
        $siteKeyRecaptcha = $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->findParameterValueByKey(Generalkeys::KEY_SITE_KEY_RECAPTCHA);
        return $this->render('VisitaYucatanBundle:admin/login:Login.html.twig', array("siteKey" => $siteKeyRecaptcha));
    }


    /**
     * @Route("/admin/logincheck", name="admin_login_check")
     * @Method("GET")
     */
    public function loginCheckAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager()->getRepository('VisitaYucatanBundle:Usuario');
        $serializer = $this->get('serializer');
        $translator = $this->get('translator');
        $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $translator->trans('login.validate.message.user.not.exist'), Generalkeys::RESPONSE_INFO, Generalkeys::RESPONSE_CODE_OK);
        $user = $request->query->get('user');
        $password = $request->query->get('pass');

        if ($em->existUser($user)) {
            $usuario = $em->findUserByUsernameAndPassword($user, $password);
            if ($usuario) {
                $session = $request->getSession();
                $session->set(Generalkeys::LABEL_STATUS, Generalkeys::USER_IN_SESSION);
                $session->set("iduser", $usuario->getId());
                $session->set("user", $usuario->getUsername());
                $session->set("nombre", $usuario->getDatosPersonales()->getNombres() . " " . $usuario->getDatosPersonales()->getApellidos());
                $response->setStatus(Generalkeys::RESPONSE_TRUE);
                // TODO coloca durante toda la sesion el idioma
                $session->set('_locale', 'es');
            }

            $response->setMessage($translator->trans('login.validate.message.pass.not.coincidence'));

        }
        return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
    }

    /**
     * @Route("/admin/captchaVerify", name="admin_login_captcha")
     * @Method("GET")
     */
    public function captchaVerify(Request $request) {
        $captcha = $request->query->get('g-recaptcha-response');
        $response = false;
        if($captcha != ""){
            $secretKey = $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->findParameterValueByKey(Generalkeys::KEY_SECRET_KEY_RECAPTCHA);
            $recaptcha = new ReCaptcha($secretKey);

            $resp = $recaptcha->verify($captcha, $_SERVER['REMOTE_ADDR']);

            if ($resp->isSuccess()) {
                $response = true;
            }
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/admin/logout", name="admin_logout")
     * @Method("GET")
     */
    public function logoutAction(Request $request){
        $session = $request->getSession();
        $session->clear();
        return $this->redirect($this->generateUrl('admin_login'));
    }

}


/*TODO AQUI LA SECCION QUE FALTA VALIDAR O AGREGAR PERO NO ES NECESARIO A PRIMERA INSTANCIA

1.- Agregar fecha login y logout de usuario

*/