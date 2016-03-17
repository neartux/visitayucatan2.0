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

class LanguagesController extends Controller{

    /**
     * @Route("/admin/idioma", name="idioma_display_list")
     * @Method("GET")
     */
    public function displayLanguageAction(Request $request){
        if(! $request->getSession()->get(Generalkeys::LABEL_STATUS)){
            return $this->redirectToRoute('admin_login');
        }
        return $this->render('VisitaYucatanBundle:admin/catalogs/language:language.html.twig');
    }

    /**
     * @Route("/admin/language/find/all", name="language_find_all")
     * @Method("GET")
     */
    public function findAllLanguageAction() {
        $serializer = $this->get('serializer');
        return new Response($serializer->serialize($this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->findAllLanguage(), Generalkeys::JSON_STRING));
    }


    /**
     * @Route("/admin/idioma/create", name="idioma_crear")
     * @Method("POST")
     */
    public function createLanguageAction(Request $request){
        $serializer = $this->get('serializer');
        try {
            $idiomaJson = $request->get('language');
            $idioma = $serializer->deserialize($idiomaJson, 'VisitaYucatanBundle\Entity\Idioma', Generalkeys::JSON_STRING);
            $id = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->createLanguage($idioma);

            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, "Idioma creado correctamente", Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            $response->setId($id);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch( \Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/idioma/update", name="idioma_editar")
     * @Method("POST")
     */
    public function udpateLanguageAction(Request $request){
        $serializer = $this->get('serializer');
        try {
            $idiomaJson = $request->get('language');
            $idioma = $serializer->deserialize($idiomaJson, 'VisitaYucatanBundle\Entity\Idioma', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->updateLanguage($idioma);

            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Idioma actualizada correctamente', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch( \Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
    }

    /**
     * @Route("/admin/idioma/delete", name="idioma_delete")
     * @Method("POST")
     */
    public function deleteLanguageAction(Request $request){
        $serializer = $this->get('serializer');
        try{
            $idLanguage = $request->get('idLanguage');
$this->getDoctrine()->getRepository('VisitaYucatanBundle:Idioma')->deleteLanguage($idLanguage);

            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Idioma eliminado correctamente', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        }catch (\Exception $e){

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }

    }

}

/*TODO AQUI LA SECCION QUE FALTA VALIDAR O AGREGAR PERO NO ES NECESARIO A PRIMERA INSTANCIA

1.- Agregar campo fechacreacion a base de datos en tour y touridioma

*/