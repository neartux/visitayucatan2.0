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
        service.listaPlanes = {
            data: undefined
        };
        service.listaHabitacionesHotel = {
            data: undefined
        };
        service.hotelHabitacionIdiomaTO = {
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
            var path = $("#pathImagesHotel").val();
            return $http.post(path, $.param({idHotel : idHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
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
            if(parseInt(idFecha) == 0){
                return $http.post($("#pathFechaCierreCreate").val(), $.param({idHotel : idHotel, fechaInicio : fechaInicio, fechaFin : fechaFin}), {
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                });
            }else{
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

        service.findContractById = function (idContract){
            var path = $("#pathContractById").val();
            return $http.post(path, $.param({idContract : idContract}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.findListContracts = function(idHotel){
            var path = $("#pathContratos").val();
            return $http.post(path, $.param({idHotel : idHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                service.listaContratos.data = data.data;
            });
        };

        service.planesAlimentos = function(){
            var path = $("#pathContratoPlanes").val();
            return $http.post(path, {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                service.listaPlanes.data = data.data;
            });
        };

        service.createContract = function(hotelContract){
            var path = $("#pathContratoCreate").val();
            return $http.post(path, $.param({hotelContrato : JSON.stringify(hotelContract)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.updateContract = function(hotelContract){
            var path = $("#pathContratoUpdate").val();
            return $http.post(path, $.param({hotelContrato : JSON.stringify(hotelContract)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.findHabitacionById = function (idHabitacion){
            var path = $("#pathHabitacionOne").val();
            return $http.post(path, $.param({idHabitacion : idHabitacion}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.findHabitacionesHotel = function(idHotel){
            var path = $("#pathHabitaciones").val();
            return $http.post(path, $.param({idHotel : idHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                console.info("habitaciones = "+JSON.stringify(data.data));
                service.listaHabitacionesHotel.data = data.data;
            });
        };

        service.createHabitacion = function(hotelHabitacion){
            var path = $("#pathHabitacionCreate").val();
            return $http.post(path, $.param({hotelHabitacion : JSON.stringify(hotelHabitacion)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.updateHabitacion = function(hotelHabitacion){
            var path = $("#pathHabitacionUpdate").val();
            return $http.post(path, $.param({hotelHabitacion : JSON.stringify(hotelHabitacion)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.findHabitacionByIdAndIdioma = function(idHotelHabitacion, idLanguage){
            var path = $("#pathHabitacionIdioma").val();
            return $http.post(path, $.param({idHotelHabitacion : idHotelHabitacion, idIdioma : idLanguage}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                service.hotelHabitacionIdiomaTO.data = data.data;
            });
        };

        service.saveHabitacionIdioma = function(hotelHabitacion){
            console.log("guardar = "+JSON.stringify(hotelHabitacion));
            var path = $("#pathCreateHabitacionIdioma").val();
            return $http.post(path, $.param({hotelHabitacionIdioma : JSON.stringify(hotelHabitacion)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        return service;
    });
})();