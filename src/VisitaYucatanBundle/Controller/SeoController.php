<?php
/**
 * User: ricardo
 * Date: 27/12/17
 */

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use VisitaYucatanBundle\utils\Generalkeys;


class SeoController extends Controller {

    /**
     * @Route("/admin/seo/tours", name="seo_tours")
     * @Method("GET")
     */
    public function displayToursAction(Request $request) {
        if (!$request->getSession()->get(Generalkeys::LABEL_STATUS)) {
            return $this->redirectToRoute('admin_login');
        }
        $metaDescription = $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->findParameterValueByKey(Generalkeys::META_DESCRIPTION_TOUR);
        return $this->render('VisitaYucatanBundle:admin/seo/tours:seo-tours.html.twig', array('metaDescription' => $metaDescription));
    }

    /**
     * @Route("/admin/seo/tours", name="seo_tours_change")
     * @Method("POST")
     */
    public function changeValue(Request $request) {
        $description = $request->get('description');
        $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->updateParameterValueByKey(Generalkeys::META_DESCRIPTION_TOUR, $description);
        $metaDescription = $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->findParameterValueByKey(Generalkeys::META_DESCRIPTION_TOUR);
        return $this->render('VisitaYucatanBundle:admin/seo/tours:seo-tours.html.twig', array('metaDescription' => $metaDescription));
    }

    /**
     * @Route("/admin/seo/hotels", name="seo_hotels")
     * @Method("GET")
     */
    public function displayHotelsAction(Request $request) {
        if (!$request->getSession()->get(Generalkeys::LABEL_STATUS)) {
            return $this->redirectToRoute('admin_login');
        }
        $metaDescription = $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->findParameterValueByKey(Generalkeys::META_DESCRIPTION_HOTEL);
        return $this->render('VisitaYucatanBundle:admin/seo/hotels:seo-hotels.html.twig', array('metaDescription' => $metaDescription));
    }

    /**
     * @Route("/admin/seo/hotels", name="seo_hotels_change")
     * @Method("POST")
     */
    public function changeValueHotels(Request $request) {
        $description = $request->get('description');
        $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->updateParameterValueByKey(Generalkeys::META_DESCRIPTION_HOTEL, $description);
        $metaDescription = $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->findParameterValueByKey(Generalkeys::META_DESCRIPTION_HOTEL);
        return $this->render('VisitaYucatanBundle:admin/seo/hotels:seo-hotels.html.twig', array('metaDescription' => $metaDescription));
    }

    /**
     * @Route("/admin/seo/packages", name="seo_packages")
     * @Method("GET")
     */
    public function displayPackageAction(Request $request) {
        if (!$request->getSession()->get(Generalkeys::LABEL_STATUS)) {
            return $this->redirectToRoute('admin_login');
        }
        $metaDescription = $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->findParameterValueByKey(Generalkeys::META_DESCRIPTION_PACKAGE);
        return $this->render('VisitaYucatanBundle:admin/seo/packages:seo-packages.html.twig', array('metaDescription' => $metaDescription));
    }

    /**
     * @Route("/admin/seo/packages", name="seo_packages_change")
     * @Method("POST")
     */
    public function changeValuePackage(Request $request) {
        $description = $request->get('description');
        $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->updateParameterValueByKey(Generalkeys::META_DESCRIPTION_PACKAGE, $description);
        $metaDescription = $this->getDoctrine()->getRepository('VisitaYucatanBundle:ConfigurationVar')->findParameterValueByKey(Generalkeys::META_DESCRIPTION_PACKAGE);
        return $this->render('VisitaYucatanBundle:admin/seo/packages:seo-packages.html.twig', array('metaDescription' => $metaDescription));
    }

}