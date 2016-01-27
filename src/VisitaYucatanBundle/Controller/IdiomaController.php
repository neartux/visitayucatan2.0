<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\utils\Generalkeys;

class IdiomaController extends Controller {

    /**
     * @Route("/admin/language/find/all", name="language_find_all")
     * @Method("GET")
     */
    public function findAllLanguageAction() {
        $serializer = $this->get('serializer');
        return new Response($serializer->serialize($this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->findAllLanguage(), Generalkeys::JSON_STRING));
    }
}
