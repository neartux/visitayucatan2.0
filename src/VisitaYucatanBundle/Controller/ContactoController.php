<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use VisitaYucatanBundle\utils\Generalkeys;

class ContactoController extends Controller {

    /**
     * @Route("/contacto", name="web_contacto")
     * @Method("GET")
     */
    public function indexAction(Request $request) {
        // obtiene los datos de session moneda e idioma
        $datos = $this->getParamsTour($request);
        // lista de monedas e idiomas
        $currency = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->findAllCurrency();
        $idiomas = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->findAllLanguage();

        // renderiza la vista y manda la informacion
        return $this->render('VisitaYucatanBundle:web/pages:contacto.html.twig', array('claseImg' => Generalkeys::CLASS_HEADER_TOUR,
            'logoSection' => Generalkeys::IMG_NAME_SECCION_WEB_TOUR, 'monedas' => $currency, 'idiomas' => $idiomas));
    }

    /**
     * @Route("/contacto/solicitud/informacion", name="web_contactar")
     * @Method("POST")
     */
    public function sendMailContact(Request $request) {
        $message = \Swift_Message::newInstance();
        $message->setSubject('Se ha generado un nuevo prospecto | Visita Yucatan‏');
        $message->setFrom('notificaciones@visitayucatan.com');
        // TODO desconmentar la siguiente linea cuando ya este en produccion
        //$message->setTo(Generalkeys::gabino_martinez_email);
        // TODO eliminar la siguiente linea cuando este en produccion
        $message->setTo(Generalkeys::bcc_email);
        $message->setReplyTo(Generalkeys::no_responder_email);
        // TODO desconmentar la siguiente linea cuando ya este en produccion
        //$message->setCc(Generalkeys::getMailsCcContact());
        $message->setBcc(Generalkeys::bcc_email);
        $message->setBody(
            $this->renderView('@VisitaYucatan/web/pages/mail/contacto.html.twig',
                array('nombre' => $request->get('nombre'), 'telefono' => $request->get('telefono'), 'email' => $request->get('email'), 'comentarios' => $request->get('comentarios'))), 'text/html'
        );
        $this->get('mailer')->send($message);

        return $this->redirectToRoute('web_contacto');
    }

    private function getParamsTour($request) {
        // Obtiene la session del request para obtener moneda e idioma
        $session = $request->getSession();
        // Obtiene el idioma de la sesion
        $idioma = $session->get('_locale');
        // Obtiene el idioma de la session
        $moneda = $session->get('_currency');
        //valida la moneda, si es null coloca la moneda mexicana
        if (is_null($moneda)) {
            $moneda = Generalkeys::MEXICAN_CURRENCY;
            // colocal la moneda en session
            $session->set('_currency', $moneda);
        }
        // Encuentra el id de el idioma actual si no hay en sesion coloca idioma español
        $idIdioma = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->getIdIdiomaByAbreviatura($idioma);

        // Valida el idioma
        if (is_null($idioma)) {
            $session->set('_locale', Generalkeys::SPANISH_LANGUAGE);
        }

        // Declarp nuevo array para mandar los datos
        $datos = Array();
        // coloco la informacion
        $datos[Generalkeys::NUMBER_ZERO] = $idIdioma;
        $datos[Generalkeys::NUMBER_ONE] = $moneda;
        // Regreso los datos
        return $datos;
    }
}
