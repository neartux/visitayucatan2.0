/**
 * Created by ricardo on 15/02/16.
 */
(function () {
    var app = angular.module('PaqueteProvider', []);
    app.factory('PaqueteService', function($http, $q){

        var service = {};

        /*service.listHotel = {
            data: undefined
        };
        service.listLanguage = {
            data: undefined
        };
        service.listDestino = {
            data: undefined
        };
        service.hotelIdiomaTO = {
            data: undefined
        };
        service.imagesHotelList = {
            data: undefined
        };
        service.contactHotelList = {
            data: undefined
        };*/

        service.findPaquetesList= function(path){
            return $http.get(path).then(function(data){
                return data.data;
            });
        };
        service.createPaquete = function(paquete,path){
            //var path = $("#pathCreateTour").val();
            return $http.post(path, $.param({paquete : JSON.stringify(paquete)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };
        service.deletePaqueteById = function(path,idPaquete){
            //var path = $("#pathDeleteHotel").val();
            return $http.post(path, $.param({idPaquete : idPaquete}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };
        service.updatePaquete = function(path,paquete){
            //var path = $("#pathUpdateTour").val();
            return $http.post(path, $.param({paquete : JSON.stringify(paquete)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };
        service.promovedPaquete = function(path,idPaquete){
            return $http.post(path, $.param({idPaquete : idPaquete}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };
        service.removePromovedPaquete = function(path,idPaquete){
            return $http.post(path, $.param({idPaquete : idPaquete}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };
        service.findAllLanguages = function(path){
            return $http.get(path).then(function(data){
                return data.data;
            })
        };
        service.findPaqueteByIdAndLanguaje = function(path,idPaquete, idLanguage){
            //var path = $("#pathTourByLanguage").val();
            return $http.post(path, $.param({idPaquete : idPaquete, idLanguage : idLanguage}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                return data.data;
                //service.tourIdiomaTO.data = data.data;
            });
        };

        service.savePaqueteLanguage = function(path,paqueteIdiomaTO){
            //var path = $("#pathSaveHotelLanguage").val();
            return $http.post(path, $.param({paqueteLanguage : JSON.stringify(paqueteIdiomaTO)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };
        service.findImagesPaqueteByIdPaquete = function(path,idPaquete) {
            return $http.post(path, $.param({idPaquete : idPaquete}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                return data.data;
            });
        };
        service.setPrincipalImage = function(path,idPaquete, idImagePaquete){
            return $http.post(path, $.param({idPaquete : idPaquete, idImagePaquete: idImagePaquete}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };
        service.deleteImagePaquete = function(path,idImagePaquete){
            //var path = $("#pathDeleteImageHotel").val();
            return $http.post(path, $.param({idImagePaquete : idImagePaquete}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };
        service.findAllHoteles = function(path){
            return $http.get(path).then(function(data){
                return data.data;
            });
        }
        service.findByIdCombiHotel = function(path,json){
            return $http.post(path, $.param({idPaquete : json.idPaquete,idHotel:json.idHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                return data.data;
            });
        }
        service.savePaqueteCombinacion = function(path,json){
            return $http.post(path, $.param({paqueteCombinacion : JSON.stringify(json)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                return data.data;
            });
        }
        service.listPaqueteCombinacion = function(path,idPaquete){
            return $http.post(path, $.param({idPaquete : idPaquete}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                return data.data;
            });
        }
        service.deletePaqueteCombinacionById = function(path,idPaqueteCombinacion){
            return $http.post(path, $.param({idPaqueteCombinacion : idPaqueteCombinacion}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        }
        service.updatePaqueteCombinacion = function(path,paqueteCombinacion){
            //var path = $("#pathUpdateTour").val();
            return $http.post(path, $.param({paqueteCombinacion : JSON.stringify(paqueteCombinacion)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };
        /*service.findContactsHotel = function(idHotel){
            var path = $("#pathContacts").val();
            service.contactHotelList.data = [];
            return $http.post(path, $.param({idHotel : idHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                console.log("contactos = "+JSON.stringify(data.data));
                service.contactHotelList.data = data.data;
            });
        };

        service.findDestinos = function(){
            var path = $("#pathDestinos").val();
            service.listDestino.data = [];
            return $http.get(path).then(function(data){
                service.listDestino.data = data.data;
            });
        };

        service.findLanguagesActives= function(){
            var path = $("#pathAllLanguages").val();
            service.listLanguage.data = [];
            return $http.get(path).then(function(data){
                service.listLanguage.data = data.data;
            });
        };

        service.findHotelByIdAndLanguaje = function(idHotel, idLanguage){
            var path = $("#pathHotelByLanguage").val();
            return $http.post(path, $.param({idHotel : idHotel, idLanguage : idLanguage}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                service.hotelIdiomaTO.data = data.data;
            });
        };

        service.findImagesHotelByIdHotel = function (idHotel){
            console.log("idhotel imagens = "+idHotel);
            var path = $("#pathImagesHotel").val();
            return $http.post(path, $.param({idHotel : idHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                console.log("iamges = "+JSON.stringify(data.data));
                service.imagesHotelList.data = data.data;
            });
        };

        service.setPrincipalImage = function(idHotel, idImageHotel){
            var path = $("#pathSetPrincipalImage").val();
            return $http.post(path, $.param({idHotel : idHotel, idImageHotel: idImageHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.deleteImageHotel = function(idImageHotel){
            var path = $("#pathDeleteImageHotel").val();
            return $http.post(path, $.param({idImageHotel : idImageHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.saveHotelLanguage = function(hotelIdiomaTO){
            var path = $("#pathSaveHotelLanguage").val();
            return $http.post(path, $.param({hotelLanguage : JSON.stringify(hotelIdiomaTO)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.createHotel = function(hotel){
            var path = $("#pathCreateHotel").val();
            return $http.post(path, $.param({hotel : JSON.stringify(hotel)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.updateHotel = function(hotel){
            var path = $("#pathUpdateHotel").val();
            return $http.post(path, $.param({hotel : JSON.stringify(hotel)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.deleteHotelById = function(idHotel){
            var path = $("#pathDeleteHotel").val();
            return $http.post(path, $.param({idHotel : idHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.promovedHotel = function(idHotel){
            var path = $("#pathPromoveHotel").val();
            return $http.post(path, $.param({idHotel : idHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.removePromovedHotel = function(idHotel){
            var path = $("#pathRemovePromoveHotel").val();
            return $http.post(path, $.param({idHotel : idHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.createContactHotel = function(hotelContacto){
            var path = $("#pathContactCreate").val();
            return $http.post(path, $.param({hotelContacto : JSON.stringify(hotelContacto)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.deleteContactHotel = function(idHotelContacto){
            var path = $("#pathContactDelete").val();
            return $http.post(path, $.param({idHotelContacto : idHotelContacto}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };*/

        return service;
    });
})();