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
    public function indexAction() {
        return $this->render('VisitaYucatanBundle:web/pages:contacto.html.twig', array('claseImg' => Generalkeys::CLASS_HEADER_TOUR,
            'isVisibleHotels' => $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->isVisibleHotels()));
    }

    /**
     * @Route("/contacto/solicitud/informacion", name="web_contactar")
     * @Method("POST")
     */
    public function sendMailContact(Request $request) {
        $message = \Swift_Message::newInstance();
        $message->setSubject('TEST(ZV) Se ha generado un nuevo prospecto | Visita Yucatan‏');
        $message->setFrom(Generalkeys::from_email_contact);
        // TODO desconmentar la siguiente linea cuando ya este en produccion
        $message->setTo(Generalkeys::gabino_martinez_email);
        // TODO eliminar la siguiente linea cuando este en produccion
        //$message->setTo(Generalkeys::gabriel_email);
        $message->setReplyTo(Generalkeys::no_responder_email);
        // TODO desconmentar la siguiente linea cuando ya este en produccion
        $message->setCc(Generalkeys::getMailsCcContact());
        $message->setBcc(Generalkeys::bcc_email);
        $message->setBody(
            $this->renderView('@VisitaYucatan/web/pages/mail/contacto.html.twig',
                array('nombre' => $request->get('nombre'), 'telefono' => $request->get('telefono'), 'email' => $request->get('email'), 'comentarios' => $request->get('comentarios'))), 'text/html'
        );
        $this->get('mailer')->send($message);

        return $this->redirectToRoute('web_contacto');
    }
}
