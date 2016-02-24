/**
 * Proveedor para controllerjs de hotel
 * Created by ricardo on 3/02/16.
 */
(function () {
    var app = angular.module('HotelProvider', []);
    app.factory('HotelService', function($http, $q){

        var service = {};

        service.listHotel = {
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
        };
        service.listaFechas = {
            data: undefined
        };
        service.listaContratos = {
            data: undefined
        };

        service.findHotelsActives= function(){
            var path = $("#pathListHotel").val();
            service.listHotel.data = [];
            return $http.get(path).then(function(data){
                service.listHotel.data = data.data;
            });
        };

        service.findContactsHotel = function(idHotel){
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
        };

        service.deleteHotelFechaCierre = function(idFechaCierre){
            var path = $("#pathFechaCierreDelete").val();
            return $http.post(path, $.param({idFechaCierre : idFechaCierre}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.createOrUpdateFechaCierre = function(idFecha, idHotel, fechaInicio, fechaFin){
            console.log("id fecha = "+idFecha);
            if(parseInt(idFecha) == 0){
                console.log("es nuevo");
                return $http.post($("#pathFechaCierreCreate").val(), $.param({idHotel : idHotel, fechaInicio : fechaInicio, fechaFin : fechaFin}), {
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                });
            }else{
                console.log("es update");
                return $http.post($("#pathFechaCierreUpdate").val(), $.param({idFechaCierre : idFecha, fechaInicio : fechaInicio, fechaFin : fechaFin}), {
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                });
            }
        };
        service.findFechasByHotel = function (idHotel){
            var path = $("#pathFechaCierreFind").val();
            service.listaFechas.data = [];
            return $http.post(path, $.param({idHotel : idHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                service.listaFechas.data = data.data;
            });
        };


        return service;
    });
})();