<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\to\ResponseTO;

class MonedaController extends Controller{

    /**
     * @Route("/admin/monedas", name="moneda_display_list")
     * @Method("GET")
     */
    public function displayCurrencyAction(Request $request){
        if(! $request->getSession()->get(Generalkeys::LABEL_STATUS)){
            return $this->redirectToRoute('admin_login');
        }
        return $this->render('VisitaYucatanBundle:admin/catalogs/currency:Currency.html.twig');
    }

    /**
     * @Route("/admin/moneda/find/list", name="moneda_find_list")
     * @Method("GET")
     */
    public function findAllCurrencyAction(){
        $currency = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->findAllCurrency();
        return new Response($this->get('serializer')->serialize($currency, Generalkeys::JSON_STRING));
    }


    /**
     * @Route("/admin/moneda/create", name="moneda_crear")
     * @Method("POST")
     */
    public function createCurrencyAction(Request $request){
        $serializer = $this->get('serializer');
        try {
            $monedaJson = $request->get('currency');
            $moneda = $serializer->deserialize($monedaJson, 'VisitaYucatanBundle\Entity\Moneda', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->createCurrency($moneda);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("catalog.currency.report.message.success.create"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch( \Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/moneda/update", name="moneda_editar")
     * @Method("POST")
     */
    public function udpateCurrencyAction(Request $request){
        $serializer = $this->get('serializer');
        try {
            $monedaJson = $request->get('currency');
            $moneda = $serializer->deserialize($monedaJson, 'VisitaYucatanBundle\Entity\Moneda', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->updateCurrency($moneda);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("catalog.currency.report.message.success.update"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch( \Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/moneda/delete", name="moneda_delete")
     * @Method("POST")
     */
    public function deleteCurrencyAction(Request $request){
        $serializer = $this->get('serializer');
        try{
            $idCurrency = $request->get('idCurrency');
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->deleteCurrency($idCurrency);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("catalog.currency.report.message.delete"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        }catch (\Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }

    /**
     * @Route("/findAllCurrency", name="web_get_currency")
     * @Method("GET")
     */
    public function findAllCurrency() {
        return new Response($this->get('serializer')->serialize($this->getDoctrine()->getRepository('VisitaYucatanBundle:Moneda')->findAllCurrency(), Generalkeys::JSON_STRING));
    }

}

/*TODO AQUI LA SECCION QUE FALTA VALIDAR O AGREGAR PERO NO ES NECESARIO A PRIMERA INSTANCIA

1.- Agregar campo fechacreacion a base de datos en tour y touridioma

*/