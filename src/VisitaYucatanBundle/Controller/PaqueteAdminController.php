<?php

namespace VisitaYucatanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VisitaYucatanBundle\utils\Generalkeys;
use VisitaYucatanBundle\utils\HotelUtils;
use VisitaYucatanBundle\utils\to\ResponseTO;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use VisitaYucatanBundle\utils\PaqueteUtils;

class PaqueteAdminController extends Controller {
	/**
     * @Route("/admin/paquetes", name="paquete_display_list")
     * @Method("GET")
   */
	public function displayPaquetesAction(Request $request) {
	  if (!$request->getSession()->get(Generalkeys::LABEL_STATUS)) {
	      return $this->redirectToRoute('admin_login');
	   }
	  return $this->render('VisitaYucatanBundle:admin/paquetes:Paquetes.html.twig');
	}

	/**
     * @Route("/admin/paquete/find/list", name="paquete_find_list")
     * @Method("GET")
     */
	public function findAllPaquetesAction() {
	  $tours = $this->getDoctrine()->getRepository('VisitaYucatanBundle:Paquete')->findAllPaquetes();
	  return new Response($this->get('serializer')->serialize($tours, Generalkeys::JSON_STRING));
	}

	/**
     * @Route("/admin/paquete/create", name="paquete_create")
     * @Method("POST")
     */
	public function createPaqueteAction(Request $request) {
		$serializer = $this->get('serializer');
		try {
		   $paqueteJson = $request->get('paquete');
		   $paqueteTO = $serializer->deserialize($paqueteJson,'VisitaYucatanBundle\utils\to\PaqueteTO',Generalkeys::JSON_STRING);
		   //$tourTO = $serializer->deserialize($tourJson, 'VisitaYucatanBundle\utils\to\TourTO', Generalkeys::JSON_STRING);
		   //print_r($tourTO);
		   $this->getDoctrine()->getRepository('VisitaYucatanBundle:Paquete')->createPaquete($paqueteTO);

		   $translator = $this->get('translator');
		   $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("El paquete se ha creado"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
		   return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

		} catch (\Exception $e) {

		   $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
		   return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
		}
 	}

 	/**
     * @Route("/admin/paquete/update", name="paquete_update")
     * @Method("POST")
   */
	public function updatePaqueteAction(Request $request) {
		$serializer = $this->get('serializer');
        try {
            $paqueteJson = $request->get('paquete');
            $paqueteTO = $serializer->deserialize($paqueteJson, 'VisitaYucatanBundle\utils\to\PaqueteTO', Generalkeys::JSON_STRING);
            $this->getDoctrine()->getRepository('VisitaYucatanBundle:Paquete')->updatePaquete($paqueteTO);

            $translator = $this->get('translator');
            $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Paquete actualizado', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

        } catch (\Exception $e) {

            $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
            return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
        }
	}

 	/**
     * @Route("/admin/paquete/delete", name="paquete_delete")
     * @Method("POST")
   */
	public function deleteTourAction(Request $request) {
		$serializer = $this->get('serializer');
		try {
		   $idPaquete = $request->get('idPaquete');
		   $this->getDoctrine()->getRepository('VisitaYucatanBundle:Paquete')->deletePaquete($idPaquete);

		   $translator = $this->get('translator');
		   $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, $translator->trans("tour.report.label.tour.deleted"), Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
		   return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));

		} catch (\Exception $e) {

		   $response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
		   return new Response($serializer->serialize($response, Generalkeys::JSON_STRING));
		}

	}

	/**
     * @Route("/admin/paquete/find/paquete/by/idtpaquete/idlanguage", name="paquete_find_by_language")
     * @Method("POST")
    */
	public function findPaqueteByIdAndLanguageAction(Request $request) {
		try {
			$idPaquete = $request->get('idPaquete');
			$idLanguage = $request->get('idLanguage');
			$paquete = $this->getDoctrine()->getRepository('VisitaYucatanBundle:PaqueteIdioma')->findPaqueteByIdAndIdLanguage($idPaquete, $idLanguage);
			/*if(is_null($paquete)){
				//echo "es nullo paquete";
				$response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Es nullo', Generalkeys::RESPONSE_ERROR, Generalkeys::RESPONSE_CODE_OK);
				return new Response($this->get('serializer')->serialize($response,Generalkeys::JSON_STRING));
			}else
			{*/
				return new Response($this->get('serializer')->serialize(PaqueteUtils::convertEntityPaqueteiomaToPaqueteidiomaTO($paquete), Generalkeys::JSON_STRING));
			//}
			
		} catch (\Exception $e) {
			$response = new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode());
			return new Response($this->get('serializer')->serialize($response, Generalkeys::JSON_STRING));
		}
	}

	/**
     * @Route("/admin/paquete/save/paquetelanguage", name="paquete_save_paquetelanguage")
     * @Method("POST")
     */
    public function savePaqueteLanguageAction(Request $request) {
        $serializer = $this->get('serializer');
        try {
            $paqueteLanguageJson = $request->get('paqueteLanguage');
            $paqueteIdiomaTO = $serializer->deserialize($paqueteLanguageJson, 'VisitaYucatanBundle\utils\to\PaqueteidiomaTO', Generalkeys::JSON_STRING);
            $isNew = $this->getDoctrine()->getRepository('VisitaYucatanBundle:PaqueteIdioma')->savePaqueteLanguage($paqueteIdiomaTO);
            $message = 'Se ha modificado la información para el paquete ' . $paqueteIdiomaTO->getDescripcion();
            if ($isNew) {
                $message = 'Se ha agregado la informacion para un nuevo idioma del paquete ' . $paqueteIdiomaTO->getDescripcion();
            }
            return new Response($serializer->serialize(new ResponseTO(Generalkeys::RESPONSE_TRUE, $message, Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK), Generalkeys::JSON_STRING));
        } catch (\Exception $e) {
            return new Response($serializer->serialize(new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode()), Generalkeys::JSON_STRING));
        }
    }
   /**
     * @Route("/admin/paquete/find/images", name="paquete_find_images")
     * @Method("POST")
     */
	public function findImagesPaquetesByIdAction(Request $request) {
		$idPaquete = $request->get('idPaquete');
		$images = $this->getDoctrine()->getRepository('VisitaYucatanBundle:PaqueteImagen')->findPaqueteImagesByIdPaquete($idPaquete);
		return new Response($this->get('serializer')->serialize(PaqueteUtils::getListImagenTO($images), Generalkeys::JSON_STRING));
	}
	
	/**
     * @Route("/admin/paquete/upload/image", name="paquete_upload_image")
     * @Method("POST")
     */
    public function uploadImagePaqueteAction(Request $request) {
        try {
            $em = $this->getDoctrine()->getRepository('VisitaYucatanBundle:PaqueteImagen');
            // Obtiene los datos enviados, imagen y el id del paquete
            $image = $request->files->get('file');
            $idPaquete = $request->get('idApplication');
            // Instancia el archivo al un objeto
            if (($image instanceof UploadedFile) && ($image->getError() == Generalkeys::NUMBER_ZERO)) {
                // Busca el folio siguiente
                $folio = $em->findNextFolio();
                // Si no se pudo encontrar el folio regresa mensaje error
                if ($folio == Generalkeys::NOT_FOUND_FOLIO) {
                    return new JsonResponse(array('answer' => 'No se pudo encontrar folio, intentar de nuevo'));
                }
                // Arma un nuevo nombre para la imagen, esto es por si se sube diferentes imagenes con el mismo nombre
                $newName = Generalkeys::PART_NAME_PAQUETE . $idPaquete . Generalkeys::PART_NAME_FOLIO . $folio . "." . $image->getClientOriginalExtension();
                // Mueve la imagen a su carpeta
                $image->move(Generalkeys::PATH_PAQUETES_IMAGE, $newName);
                // Guarda el registro de la imagen tour
                $em->uploadPaqueteImage($image->getClientOriginalName(), $newName, $folio, Generalkeys::PATH_PAQUETES_IMAGE . $newName, $image->getClientOriginalExtension(), $idPaquete);
                return new JsonResponse(array('answer' => 'Se ha cargado la imagen correctamente'));
            }
        } catch (\Exception $e) {
            return new JsonResponse(array('answer' => $e->getMessage()));
        }
    }
   /**
	* @Route("/admin/paquete/delete/image", name="paquete_delete_image")
	* @Method("POST")
	*/
	public function deleteImagePaqueteAction(Request $request) {
	  try {
	      $idImagePaquete = $request->get('idImagePaquete');
	      $this->getDoctrine()->getRepository('VisitaYucatanBundle:PaqueteImagen')->deleteImagePaquete($idImagePaquete);
	      $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Se ha eliminado correctamente la imagen con id ' . $idImagePaquete, Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
	      return new Response($this->get('serializer')->serialize($response, Generalkeys::JSON_STRING));
	  } catch (\Exception $e) {
	      return new Response($this->get('serializer')->serialize(new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode()), Generalkeys::JSON_STRING));
	  }
	}

	/**
	* @Route("/admin/paquete/principal/image", name="paquete_principal_image")
	* @Method("POST")
	*/
	public function setPrincipalImagePaqueteAction(Request $request) {
	  try {
	      $idImagePaquete = $request->get('idImagePaquete');
	      $idPaquete = $request->get('idPaquete');
	      $this->getDoctrine()->getRepository('VisitaYucatanBundle:PaqueteImagen')->setPrincipalImagePaquete($idPaquete, $idImagePaquete);
	      $response = new ResponseTO(Generalkeys::RESPONSE_TRUE, 'Nueva imagen principal asignada', Generalkeys::RESPONSE_SUCCESS, Generalkeys::RESPONSE_CODE_OK);
	      return new Response($this->get('serializer')->serialize($response, Generalkeys::JSON_STRING));
	  } catch (\Exception $e) {
	      return new Response($this->get('serializer')->serialize(new ResponseTO(Generalkeys::RESPONSE_FALSE, $e->getMessage(), Generalkeys::RESPONSE_ERROR, $e->getCode()), Generalkeys::JSON_STRING));
	  }
	}
}
