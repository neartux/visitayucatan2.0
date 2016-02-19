<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\TourUtils;


class TourController extends Controller {

    /**
     * @Route("/tours", name="web_tours")
     * @Method("GET")
     */
    public function indexAction(Request $request) {
        $session = $request->getSession();
        $idioma = $session->get('_locale');
        $moneda = $session->get('_currency');
        $idIdioma = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->getIdIdiomaByAbreviatura($idioma);
        $toursa = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->getTours($idIdioma, $moneda, Generalkeys::OFFSET_ROWS_ZERO, Generalkeys::LIMIT_ROWS_TWENTY);
        $tours = TourUtils::getTours($toursa);
        foreach($tours as $tour){
            if($tour->getId() == 5 || $tour->getId() == 4)
            echo ($tour->getDescripcion());
            echo "<br><br><br><br><br><br><br>";
        }
        exit;
    }
}
