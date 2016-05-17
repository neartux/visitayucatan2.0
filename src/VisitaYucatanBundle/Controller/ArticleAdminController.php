<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\to\ResponseTO;

class ArticleAdminController extends Controller {

    /**
     * @Route("/admin/peninsula", name="peninsula_display_list")
     * @Method("GET")
     */
    public function displayArticleAction(Request $request){
        if (!$request->getSession()->get(Generalkeys::LABEL_STATUS)) {
            return $this->redirectToRoute('admin_login');
        }
        return $this->render('VisitaYucatanBundle:admin/articles:Peninsula.html.twig');

    }

    /**
     * @Route("/admin/peninsula/find/list", name="peninsula_find_list")
     * @Method("GET")
     */
    public function findAllPeninsulaAction(){
        $articulosPeninsula = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Articulo')->findAllArticulos(Generalkeys::TIPO_ARTICULO_PENINSULA);
        return new Response($this->get('serializer')->serialize($articulosPeninsula, Generalkeys::JSON_STRING));
    }

    /**
     * @Route("/admin/peninsula/create", name="peninsula_crear")
     * @Method("POST")
     */
    public function createPeninsulaAction(Request $request){
        $serializer = $this->get('serializer');
        try {
            $seccionPeninsula = null;
            $peninsula = $request->get('peninsula');
            $id = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Articulo')->createArticulo($peninsula, Generalkeys::TIPO_ARTICULO_PENINSULA, $seccionPeninsula);

            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, "Peninsula creado Correctamente", Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            $response->setId($id);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch ( \Exception $e) {
            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }


    /**
     * @Route("/admin/peninsula/update", name="peninsula_update")
     * @Method("POST")
     */
    public function udpateArticleAction(Request $request){
        $serializer = $this->get('serializer');
        try {
            $id = $request->get('idPeninsula');
            $peninsula = $request->get('peninsula');

            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Articulo')->updateArticulo($id, "$peninsula");


            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Península actualizada correctamente', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch( \Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/peninsula/delete", name="peninsula_delete")
     * @Method("POST")
     */
    public function deleteActicleAction(Request $request){
        $serializer = $this->get('serializer');
        try{
            $idPeninsula = $request->get('idPeninsula');
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Articulo')->deleteArticulo($idPeninsula);

            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Peninsula eliminado correctamente', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        }catch (\Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }

    /**
     * @Route("/admin/peninsula/find/peninsula/by/idpeninsula/idlanguage", name="peninsula_find_by_language")
     * @Method("POST")
     */
    public function findArticleByIdAndLanguageAction(Request $request) {

        try {
            $idPeninsula = $request->get('idPeninsula');
            $idLanguage = $request->get('idLanguage');
            $tipoArticulo = Generalkeys::TIPO_ARTICULO_PENINSULA;
            $peninsula = $this->getDoctrine()->getRepository('VisitaYucatanBundle:ArticuloIdioma')->findPeninsulaByIdAndIdLanguage($idPeninsula, $idLanguage, $tipoArticulo);


            return new Response($this->get('serializer')->serialize($peninsula, Generalkeys::JSON_STRING));


        } catch (\Exception $e) {
            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($this->get('serializer')->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/peninsula/save/peninsulalanguage", name="peninsula_save_peninsulalanguage")
     * @Method("POST")
     */
    public function saveArticleLanguageAction(Request $request){
        $serializer = $this->get('serializer');

        try {
            $descripcion = $request->get('descripcion');
            $nombre = $request->get('nombre');

            $idArticulo = $request->get('idPeninsula');
            $idIdioma = $request->get('idLanguage');
            $peninsula = $this->getDoctrine()->getRepository('VisitaYucatanBundle:ArticuloIdioma')->createArticuloIdioma($nombre,      $descripcion, $idArticulo, $idIdioma);
            $message = 'Se ha agregado la informacion para un nuevo idioma para la península ' . $nombre;

            return new Response($serializer->serialize(new ResponseTO(Generalkeys::RESPONSE_TRUE, $message, Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK), Generalkeys::JSON_STRING));

        } catch (\Exception $e) {
            return new Response($serializer->serialize(new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode()), Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/peninsula/update/peninsulalanguage", name="peninsula_update_peninsulalanguage")
     * @Method("POST")
     */

    public function udpateArticleLanguageAction(Request $request){
        $serializer = $this->get('serializer');

        try {
            $descripcion = $request->get('descripcion');
            $idArticuloIdioma = $request->get('idarticuloidioma');
            $nombre = $request->get('nombre');
            $articulo = $this->getDoctrine()->getRepository('VisitaYucatanBundle:ArticuloIdioma')->editArticuloIdioma($idArticuloIdioma, $nombre, $descripcion);
            $message = 'Se ha modificado la información para el Artículo ' . $nombre;
            return new Response($serializer->serialize(new ResponseTO(Generalkeys::RESPONSE_TRUE, $message, Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK), Generalkeys::JSON_STRING));

        } catch (Exception $e) {
            return new Response($serializer->serialize(new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode()), Generalkeys::JSON_STRING));
        }
    }
}
