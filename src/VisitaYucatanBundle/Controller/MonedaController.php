<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\ResponseTO;

class MonedaController extends Controller{

    /**
     * @Route("/moneda/list", name="moneda_display_list")
     * @Method("GET")
     */
    public function displayCurrencyAction(){
        return $this->render('VisitaYucatanBundle:admin/catalogs/currency:Currency.html.twig');
    }

    /**
     * @Route("/moneda/find/list", name="moneda_find_list")
     * @Method("GET")
     */
    public function findAllCurrencyAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $currency = $em->getRepository('VisitaYucatanBundle:Moneda')->findAllCurrency();
        $serializer = $this->get('serializer');
        return new Response($serializer->serialize($currency, Generalkeys::JSON_STRING));
    }


    /**
     * @Route("/moneda/create", name="moneda_crear")
     * @Method("POST")
     */
    public function createCurrencyAction(Request $request){
        $serializer = $this->get('serializer');
        try {
            $monedaJson = $request->get('currency');
            $moneda = $serializer->deserialize($monedaJson, 'VisitaYucatanBundle\Entity\Moneda', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getEntityManager()->getRepository('VisitaYucatanBundle:Moneda')->createCurrency($moneda);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("catalog.currency.report.message.success.create"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch( \Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/moneda/update", name="moneda_editar")
     * @Method("POST")
     */
    public function udpateCurrencyAction(Request $request){
        $serializer = $this->get('serializer');
        try {
            $monedaJson = $request->get('currency');
            $moneda = $serializer->deserialize($monedaJson, 'VisitaYucatanBundle\Entity\Moneda', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getEntityManager()->getRepository('VisitaYucatanBundle:Moneda')->updateCurrency($moneda);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("catalog.currency.report.message.success.update"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch( \Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/moneda/delete", name="moneda_delete")
     * @Method("POST")
     */
    public function deleteCurrencyAction(Request $request){
        $serializer = $this->get('serializer');
        try{
            $idCurrency = $request->get('idCurrency');
            $em = $this->getDoctrine()->getEntityManager();
            $em->getRepository('VisitaYucatanBundle:Moneda')->deleteCurrency($idCurrency);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("catalog.currency.report.message.delete"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        }catch (\Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }

}

