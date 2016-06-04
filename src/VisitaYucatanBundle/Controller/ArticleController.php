<?php 
namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use VisitaYucatanBundle\utils\Generalkeys;



class ArticleController extends Controller{

     /**
     * @Route("/peninsula", name="web_peninsula")
     * @Method("GET")
     */
     public function indexAction(Request $request){
      // obtione los datos de session moneda e idioma
      $datos = $this->getParamsPeninsula($request);
      // encuentra la descripcion de la pagina, obtiene la descripcion corta
      
      // busca todos las peninsulas activos y publicados
      $peninsulas = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Articulo')->getPeninsulas($datos[Generalkeys::NUMBER_ZERO], $datos[Generalkeys::NUMBER_ONE], Generalkeys::OFFSET_ROWS_ZERO, Generalkeys::LIMIT_ROWS_TWENTY);
      // renderiza la vista y manda la informacion
        return $this->render('VisitaYucatanBundle:web/pages:peninsulas.html.twig',  array('peninsulas' => $peninsulas,
             'claseImg' => Generalkeys::CLASS_HEADER_TOUR, 'logoSection' => Generalkeys::IMG_NAME_SECCION_WEB_TOUR));

     }

     private function getParamsPeninsula($request){
      // Obtiene la session del request para obtener moneda e idioma
      $session = $request->getSession();
      // Obtine el idioma de la sesion
      $idioma = $session->get('_locale');
      // Obteniene el idioma de la session
      $moneda = $session->get('_currency');
      //valida la moneda, si es null coloca la moneda mexicana
      if (is_null($moneda)) {
      $moneda = Generalkeys::MEXICAN_CURRENCY;
      // coloca la moneda en session

      $session->set('_currency', $moneda);
      }
      // Encuentra el id del idioma actual si no hay en session coloca idima español
      $idIdioma = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->getIdIdiomaByAbreviatura($idioma);

      // Declaro nuevo array para mandar los datos
      $datos = Array();
      // Coloco la información
      $datos[Generalkeys::NUMBER_ZERO] = $idIdioma;
      $datos[Generalkeys::NUMBER_ONE] = $moneda;
      // Regreso los datos
      return $datos;

     }


}

 ?>