<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/index", name="page_home_admin")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('VisitaYucatanBundle:Default:index.html.twig');
    }
}
