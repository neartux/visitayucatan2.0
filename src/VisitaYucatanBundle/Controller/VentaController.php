<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\Resources\payment\Merchant;
use VisitaYucatanBundle\Resources\payment\Parser;
use VisitaYucatanBundle\utils\DateUtil;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\to\ResponseTO;
use VisitaYucatanBundle\utils\to\VentaCompletaTO;
use VisitaYucatanBundle\utils\VentaUtils;

class VentaController extends Controller {

    /**
     * @Route("/venta/send/voucher/tour", name="web_voucher_tour")
     * @Method("GET")
     */
    public function voucherTour(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $em->getConnection()->beginTransaction();
        try {
            $idVenta = $request->getSession()->get("idVentaGenerada");
            // limpia variable para no cargar otra vez la pagina
            $request->getSession()->set("idVentaGenerada", null);
            if(is_null($idVenta)){
                return $this->redirectToRoute('web_home');
            }
            // renderiza la vista y manda la informacion
            $venta = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Venta')->find($idVenta);

            $tour = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->getTourById($venta->getVentaDetalle()->get(0)->getTour()->getId(), $venta->getIdioma()->getId(), $venta->getMoneda()->getId());
            $ventaCompletaTO = VentaUtils::getVentaCompleteTOTour($venta, $tour);
            $mes = DateUtil::getFullNameMonth(date_format($venta->getFechaVenta(), 'm'));
            $mesReserva = DateUtil::getFullNameMonth(date_format($venta->getDatosReserva()->getCheckIn(), 'm'));
            $html = $this->renderView('@VisitaYucatan/web/pages/pdf/tour/reserva-tour-pdf.html.twig',array('ventaCompleta' => $ventaCompletaTO, 'mes' => $mes, 'mesReserva' => $mesReserva));
            $file = $this->getPdf($html, $ventaCompletaTO, Generalkeys::PATH_VOUCHER_TOURS, Generalkeys::NAME_VENTA_FILE);
            $this->sendMailSale($ventaCompletaTO->getEmail(), $file);

            return $this->render('@VisitaYucatan/web/pages/pdf/tour/success-sale-tour.html.twig', array('ventaCompleta' => $ventaCompletaTO, 'mes' => $mes, 'mesReserva' => $mesReserva));

        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            return $this->redirectToRoute('web_home');
        }
    }
    
    /**
     * @Route("/venta/send/voucher/hotel", name="web_voucher_hotel")
     * @Method("GET")
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $em->getConnection()->beginTransaction();
        try {

            $idVenta = $request->getSession()->get("idVentaGenerada");
            // limpia variable para no cargar otra vez la pagina
            $request->getSession()->set("idVentaGenerada", null);
            if(is_null($idVenta)){
                return $this->redirectToRoute('web_home');
            }

            // renderiza la vista y manda la informacion
            $ventas = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Venta')->find($idVenta);
            $idContract = $this->getDoctrine()->getRepository('VisitaYucatanBundle:HotelContrato')->findIdContractActiveByHotel($ventas->getVentaDetalle()->get(0)->getHotel()->getId());
            $venta = VentaUtils::getVentaCompletaTOHotel($this->getDoctrine()->getRepository('VisitaYucatanBundle:Venta')->getDetailsSaleHotel($ventas->getId(), $idContract));
            $date = DateUtil::getFullNameMonth(date_format($venta->getFechaVenta(), 'm'));
            $monthChekIn = DateUtil::getFullNameMonth(date_format($venta->getCheckIn(), 'm'));
            $monthChekOut = DateUtil::getFullNameMonth(date_format($venta->getCheckOut(), 'm'));
            $html = $this->renderView('@VisitaYucatan/web/pages/pdf/hotel/reserva-hotel-pdf.html.twig',array('ventaCompleta' => $venta,
                'mes' => $date, 'mesCheckIn' => $monthChekIn, 'monthCheckOut' => $monthChekOut));

            $file = $this->getPdf($html, $venta, Generalkeys::PATH_VOUCHER_HOTELES, Generalkeys::NAME_VENTA_FILE);
            $this->sendMailSale($venta->getEmail(), $file);

            return $this->render('@VisitaYucatan/web/pages/pdf/hotel/success-sale-hotel.html.twig', array('ventaCompleta' => $venta,
                'mes' => $date, 'mesCheckIn' => $monthChekIn, 'monthCheckOut' => $monthChekOut));

        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            return $this->redirectToRoute('web_home');
        }
    }

    /**
     * @Route("/venta/send/voucher/paquete", name="web_voucher_paquete")
     * @Method("GET")
     */
    public function voucherPackage(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $em->getConnection()->beginTransaction();
        try {
            $idVenta = $request->getSession()->get("idVentaGenerada");
            // limpia variable para no cargar otra vez la pagina
            $request->getSession()->set("idVentaGenerada", null);
            if(is_null($idVenta)){
                return $this->redirectToRoute('web_home');
            }
            
            // renderiza la vista y manda la informacion
            $venta = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Venta')->find($idVenta);
            
            $paquete = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Paquete')->find($venta->getVentaDetalle()->get(0)->getPaquete()->getId());
            $ventaCompletaTO = VentaUtils::getVentaCompleteTOPackage($venta, $paquete);
            $mes = DateUtil::getFullNameMonth(date_format($venta->getFechaVenta(), 'm'));
            $mesReserva = DateUtil::getFullNameMonth(date_format($venta->getDatosReserva()->getCheckIn(), 'm'));
            $html = $this->renderView('@VisitaYucatan/web/pages/pdf/paquete/reserva-package-pdf.html.twig',array('ventaCompleta' => $ventaCompletaTO, 'mes' => $mes, 'mesReserva' => $mesReserva));
            $file = $this->getPdf($html, $ventaCompletaTO, Generalkeys::PATH_VOUCHER_PAQUETES, Generalkeys::NAME_VENTA_FILE);
            $this->sendMailSale($ventaCompletaTO->getEmail(), $file);


            return $this->render('@VisitaYucatan/web/pages/pdf/paquete/success-sale-paquete-html.twig', array('ventaCompleta' => $ventaCompletaTO, 'mes' => $mes, 
                'mesReserva' => $mesReserva));

        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            return $this->redirectToRoute('web_home');
        }
    }

    private function getPdf($html, VentaCompletaTO $ventaCompletaTO, $pathDir, $nameFile){
        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor('VisitaYucatan.com');
        $pdf->SetTitle(('Voucher Electrónico'));
        $pdf->SetSubject('Voucher Electrónico');
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        $pdf->AddPage();

        $file = $_SERVER["DOCUMENT_ROOT"].Generalkeys::DOMAIN_VY.$pathDir.$nameFile.$ventaCompletaTO->getIdVenta().'.pdf';

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output($file,'F'); // This will output the PDF as a response directly (F => mueve a directorio, I => ver en linea)
        return $file;
    }

    private function sendMailSale($email, $file) {
        $message = \Swift_Message::newInstance();
        $message->setSubject('TEST(ZV) Informe de su reservacion‏');
        $message->setFrom(Generalkeys::from_email_contact);
        // TODO desconmentar la siguiente linea cuando ya este en produccion
        //$message->setTo(Generalkeys::gabino_martinez_email);
        // TODO eliminar la siguiente linea cuando este en produccion
        $message->setTo($email);
        $message->setReplyTo(Generalkeys::no_responder_email);
        // TODO desconmentar la siguiente linea cuando ya este en produccion
        //$message->setCc(Generalkeys::getMailsCcSale());
        $message->setBcc(Generalkeys::bcc_email);
        $message->setBody('Confirmación  de Reservación');
        $message->attach(\Swift_Attachment::fromPath($file));
        $this->get('mailer')->send($message);
    }

    /**
     * @Route("/venta/reenvio/reservacion", name="reenvio_reservacion")
     * @Method("POST")
     */
    public function reenvioReservacion(Request $request) {
        $idVenta = $request->get('idVenta');
        $path = $request->get('path');
        $fullPath = $_SERVER["DOCUMENT_ROOT"].Generalkeys::DOMAIN_VY.$path;
        $venta = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Venta')->find($idVenta);
        $this->sendMailSale($venta->getDatosUbicacion()->getEmail(), $fullPath);
        $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Se ha reenviado la reserva ', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
        return new Response($this->get('serializer')->serialize($response, Generalkeys::JSON_STRING));
    }

    /**
     * @Route("/venta/findVentaById/{idVenta}", name="find_venta_by_id")
     * @Method("GET")
     */
    public function findVentaById(Request $request, $idVenta) {
        $venta = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Venta')->findVentaById($idVenta);
        return new Response($this->get('serializer')->serialize($venta, Generalkeys::JSON_STRING));
    }

    /**
     * @Route("/venta/process", name="procesa_pago")
     * @Method("POST")
     */
    public function process(Request $requestG) {
        $configArray = Generalkeys::getConfigurationPayment();


        if (array_key_exists("submit", $_POST))
            unset($_POST["submit"]);

        $merchantObj = new Merchant($configArray);
        $parserObj = new Parser($merchantObj);

        if (array_key_exists("version", $_POST)) {
            $merchantObj->SetVersion($_POST["version"]);
            unset($_POST["version"]);
        }

        $request = $parserObj->ParseRequest($merchantObj, $_POST);

        if ($request == "")
            die();

//        if ($merchantObj->GetDebug())
//            echo $request . "<br/><br/>";

        $requestUrl = $parserObj->FormRequestUrl($merchantObj);

//        if ($merchantObj->GetDebug())
//            echo $requestUrl . "<br/><br/>";

        $response = $parserObj->SendTransaction($merchantObj, $request);

//        if ($merchantObj->GetDebug()) {
//            // replace the newline chars with html newlines
//            $response = str_replace("\n", "<br/>", $response);
//            echo $response . "<br/><br/>";
//            die();
//        }

        //TODO receipt.php
        $errorMessage = "";
        $errorCode = "";
        $gatewayCode = "";
        $result = "";

        $responseArray = array();

        if (strstr($response, "cURL Error") != FALSE) {
            print("Communication failed. Please review payment server return response (put code into debug mode).");
            die();
        }

        if (strlen($response) != 0) {
            $pairArray = explode("&", $response);
            foreach ($pairArray as $pair) {
                $param = explode("=", $pair);
                $responseArray[urldecode($param[0])] = urldecode($param[1]);
            }
        }

        if (array_key_exists("result", $responseArray))
            $result = $responseArray["result"];

        if ($result == "FAILURE") {
            $pagado = Generalkeys::NUMBER_ZERO;
            if (array_key_exists("failureExplanation", $responseArray)) {
                $errorMessage = rawurldecode($responseArray["failureExplanation"]);
            }
            else if (array_key_exists("supportCode", $responseArray)) {
                $errorMessage = rawurldecode($responseArray["supportCode"]);
            }
            else {
                $errorMessage = "Reason unspecified.";
            }

            if (array_key_exists("failureCode", $responseArray)) {
                $errorCode = "Error (" . $responseArray["failureCode"] . ")";
            }
            else {
                $errorCode = "Error (UNSPECIFIED)";
            }
        } else {
            $pagado = Generalkeys::NUMBER_ONE;
            if (array_key_exists("response.gatewayCode", $responseArray))
                $gatewayCode = rawurldecode($responseArray["response.gatewayCode"]);
            else
                $gatewayCode = "Response not received.";
        }
//
//        if ($errorCode != "" || $errorMessage != "") {
//            echo $errorCode." = = = ".$errorMessage;
//        }else {
//            echo $gatewayCode." = =  = ".$result."<br>";
//        }
//
//        foreach ($responseArray as $field => $value) {
//            echo $field." **** ".$value."<br>";
//        }
        $receipt = array_key_exists("transaction.receipt", $responseArray) ? $responseArray["transaction.receipt"]: Generalkeys::NUMBER_ZERO;
        $tarjeta = array_key_exists("sourceOfFunds.provided.card.brand", $responseArray) ? $responseArray["sourceOfFunds.provided.card.brand"] : "";
        $numAutorizacion = array_key_exists("transaction.authorizationCode", $responseArray) ? $responseArray["transaction.authorizationCode"] : Generalkeys::NUMBER_ZERO;
        $idVenta = $requestG->getSession()->get("idVentaGenerada");

        // Actualiza la informacion de pago, con el resultado de transaccion de pago
        $this->updateDatosPago($pagado, $receipt, $tarjeta, $numAutorizacion, $idVenta);

        return new JsonResponse(Array("pagado" => $pagado));

    }



    private function updateDatosPago($pagado, $receipt, $tarjeta, $numeroAutorizacion, $idVenta) {
        $venta = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Venta')->find($idVenta);
        $numAfected = $this->getDoctrine()->getRepository('VisitaYucatanBundle:DatosPago')->updateDatosPagoVenta($venta->getDatosPago()->getId(), $pagado, $receipt, $numeroAutorizacion, $tarjeta, $idVenta);
	    return $numAfected > Generalkeys::NUMBER_ZERO;
    }
}
