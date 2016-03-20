<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class HomeController extends Controller {

    /**
     * @Route("/", name="web_home")
     * @Method("GET")
     */
    public function indexAction() {
        return $this->render('VisitaYucatanBundle:web/pages:home.html.twig');
    }
}
