<?php
/**
 * User: ricardo
 * Date: 25/12/15
 */

namespace VisitaYucatanBundle\utils;


class Generalkeys{

    const JSON_STRING = "json";
    const RESPONSE_TRUE = true;
    const RESPONSE_FALSE = false;
    const RESPONSE_INFO = "info";
    const RESPONSE_SUCCESS = "success";
    const RESPONSE_ERROR = "error";
    const RESPONSE_CODE_OK = "OK";
    const USER_IN_SESSION = true;
    const LABEL_STATUS = "status";
    const PATTERN_DATE_MYSQL = "Y-m-d";
    const NUMBER_ZERO = 0;
    const NUMBER_ONE = 1;
    const NUMBER_TWO = 2;
    const NUMBER_THREE = 3;
    const STRING_SLASH = '/';
    const STRING_DASH = '-';
    const NUMBER_ONE_HUNDRED = 100;
    const NUMBER_TWO_HUNDRED = 200;
    const NUMBER_ONE_HUNDRED_FIFTEEN = 156;
    const BOOLEAN_TRUE = true;
    const BOOLEAN_FALSE = false;
    const PATH_TOURS_IMAGE = "bundles/VisitaYucatanBundle/images/tours/";
    const PATH_PAQUETES_IMAGE = "bundles/VisitaYucatanBundle/images/paquetes/";
    const PATH_HOTELES_IMAGE = "bundles/VisitaYucatanBundle/images/hoteles/";
    const PATH_IMAGE_NOT_FOUND = "bundles/VisitaYucatanBundle/images/web/image-not-found.png";
    const NOT_FOUND_FOLIO = -1;
    const PART_NAME_TOUR = "tour-";
    const PART_NAME_PAQUETE = "paquete-";
    const PART_NAME_FOLIO = "-folio-";
    const PART_NAME_HOTEL = "hotel-";
    const IDIOMA_ESPANOL = 1;
    const ORIGEN_MERIDA = 1;
    const ORIGEN_CANCUN = 2;
    const MEXICAN_CURRENCY = 1;
    const SPANISH_LANGUAGE = 'es';
    const LIMIT_ROWS_TWENTY = 20;
    const OFFSET_ROWS_ZERO = 0;
    const COLILLA_TEXT = "...";
    const CIERRE_HTML_P = '</p>';
    const TIPO_ARTICULO_PENINSULA = 'peninsula';
    const TIPO_ARTICULO_PAGINA = 'pagina';
    const TIPO_ARTICULO_PAGINA_TOUR = 'tour';
    const TIPO_ARTICULO_PAGINA_PENINSULA = 'peninsula';
    const TIPO_ARTICULO_PAGINA_PAQUETE = 'paquete';
    const TIPO_ARTICULO_PAGINA_HOTEL = 'hotel';
    const CLASS_HEADER_TOUR = 'img-tours';
    const CLASS_HEADER_HOTEL = 'img-hoteles';
    const CLASS_HEADER_PACKAGE = 'img-paquetes';
    const IMG_NAME_SECCION_WEB_TOUR = 'bundles/VisitaYucatanBundle/img/web/titulo-tours.png';
    const IMG_NAME_SECCION_WEB_HOTEL = 'bundles/VisitaYucatanBundle/img/web/titulo-hoteles.png';
    const IMG_NAME_SECCION_WEB_PACKAGE = 'bundles/VisitaYucatanBundle/img/web/titulo-paquetes.png';
    const bcc_email = 'near31_3112@hotmail.com';
    const gabino_martinez_email = 'gmartinez@visitayucatan.com';
    const director_viyuc_email = 'director@visitayucatan.com';
    const f_capetillo_email = 'fcapetilloc@visitayucatan.com';
    const faustino_pech_email = 'faustinopech@posadatoledo.com';
    const no_responder_email = 'noresponder@visitayucatan.com';
    const from_email_contact = 'notificaciones@visitayucatan.com';
    const RATE_SIMPLE = 1;
    const RATE_DOUBLE = 2;
    const RATE_TRIPLE = 3;
    const RATE_QUADRUPLE = 4;
    const NOT_AVAILABLE_MSJ = "No disponible";
    const EMPTY_STRING = "";
    const ID_USER_ADMIN = 4;
    const CITY_MERIDA=1;
    const CITY_TELCHAC=2;
    const CITY_VALLADOLID=3;
    const CITY_IZAMAL=4;
    const CITY_CAMPECHE=5;
    const CITY_CHAMPOTON=6;
    const CITY_CHICANNA=7;
    const CITY_QUINTANA_ROO=8;
    const TIPO_PRODUCTO_TOUR=1;
    const TIPO_PRODUCTO_HOTEL=2;
    const TIPO_PRODUCTO_PAQUETE=3;
    // TODO cuando este en producccion al parecer no debe llevar la primera parte
    // TODO hay que crear la carpeta de voucher y de hoteles
    // TODO dar permisos
    const PATH_VOUCHER_HOTELES = 'visitayucatan2.0/bundles/VisitaYucatanBundle/voucher/hotel/';
    
    public static function getMailsCcContact(){
        return Array(self::director_viyuc_email, self::f_capetillo_email, self::faustino_pech_email);
    }
}