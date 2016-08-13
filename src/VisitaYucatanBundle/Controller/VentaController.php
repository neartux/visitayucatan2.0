<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\utils\DateUtil;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\to\ResponseTO;
use VisitaYucatanBundle\utils\to\VentaCompletaTO;
use VisitaYucatanBundle\utils\VentaUtils;

class VentaController extends Controller {

    /**
     * @Route("/venta/send/voucher/tour", name="web_voucher_tour")
     * @Method("POST")
     */
    public function voucherTour(Request $request) {
        $serializer = $this->get('serializer');
        $em = $this->getDoctrine()->getManager();

        $em->getConnection()->beginTransaction();
        try {
            // renderiza la vista y manda la informacion
            $venta = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Venta')->find($request->get('idVenta'));

            $tour = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Tour')->getTourById($venta->getVentaDetalle()->get(0)->getTour()->getId(), $venta->getIdioma()->getId(), $venta->getIdioma()->getId());
            $ventaCompletaTO = VentaUtils::getVentaCompleteTOTour($venta, $tour);
            $mes = DateUtil::getFullNameMonth(date_format($venta->getFechaVenta(), 'm'));
            $html = $this->renderView('@VisitaYucatan/web/pages/pdf/reserva-tour-pdf.html.twig',array('ventaCompleta' => $ventaCompletaTO, 'mes' => $mes));
            $this->getPdf($html, $ventaCompletaTO, Generalkeys::PATH_VOUCHER_TOURS);
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'El voucher se ha enviado', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);


            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }
    
    /**
     * @Route("/send/voucher/hotel", name="web_voucher_hotel")
     * @Method("GET")
     */
    public function indexAction(Request $request) {
        $serializer = $this->get('serializer');
        $em = $this->getDoctrine()->getManager();

        $em->getConnection()->beginTransaction();
        try {

            // renderiza la vista y manda la informacion
            $ventas = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Venta')->find($request->get('idVenta'));
            $idContract = $this->getDoctrine()->getRepository('VisitaYucatanBundle:HotelContrato')->findIdContractActiveByHotel($ventas->getVentaDetalle()->get(0)->getHotel()->getId());
            $venta = VentaUtils::getVentaCompletaTOHotel($this->getDoctrine()->getRepository('VisitaYucatanBundle:Venta')->getDetailsSaleHotel($ventas->getId(), $idContract));
            $date = DateUtil::getFullNameMonth(date_format($venta->getFechaVenta(), 'm'));
            $monthChekIn = DateUtil::getFullNameMonth(date_format($venta->getCheckIn(), 'm'));
            $monthChekOut = DateUtil::getFullNameMonth(date_format($venta->getCheckOut(), 'm'));
            $html = $this->renderView('@VisitaYucatan/web/pages/pdf/reserva-hotel-pdf.html.twig',array('ventaCompleta' => $venta,
                'mes' => $date, 'mesCheckIn' => $monthChekIn, 'monthCheckOut' => $monthChekOut));

            $this->getPdf($html, $venta, Generalkeys::PATH_VOUCHER_HOTELES);

            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'El voucher se ha enviado', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);


            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    private function getPdf($html, VentaCompletaTO $ventaCompletaTO, $pathDir){
        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor('VisitaYucatan.com');
        $pdf->SetTitle(('Voucher Electrónico'));
        $pdf->SetSubject('Voucher Electrónico');
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        $pdf->AddPage();

        $file = $_SERVER["DOCUMENT_ROOT"].Generalkeys::DOMAIN_VY.$pathDir.'VIYUC-'.$ventaCompletaTO->getIdVenta().'.pdf';

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output($file,'F'); // This will output the PDF as a response directly (F => mueve a directorio, I => ver en linea)
        $this->sendMailSale($ventaCompletaTO->getEmail(), $file);
    }

    private function sendMailSale($email, $file) {
        $message = \Swift_Message::newInstance();
        $message->setSubject('Informe de su reservacion‏');
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


        //return $this->redirectToRoute('web_contacto');
    }

    /**
     * @Route("/venta/findVentaById", name="find_venta_by_id")
     * @Method("GET")
     */
    public function findAllDestinosAction(Request $request) {
        $venta = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Venta')->findVentaById($request->get('idVenta'));
        return new Response($this->get('serializer')->serialize($venta, Generalkeys::JSON_STRING));
    }
}
