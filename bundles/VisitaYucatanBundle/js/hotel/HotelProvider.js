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
        service.listaTarifasHotel = {
            data: undefined
        };
        service.listStates = {
            data: []
        };
        
        service.listCities = {
            data: []
        };
        
        service.listaResetHotel = function(){
          angular.forEach(service.listaFechas.data, function(valor, indice) {
                if (valor.classDanger != "") {
                    valor.classDanger = "";
                }                                  
            });
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

        service.findStates = function(){
            var path = $("#pathStates").val();
            return $http.get(path).then(function(data){
                service.listStates.data = data.data;
            });
        };

        service.findCities = function(idState){
            var path = $("#pathCities").val();
            service.listCities.data = [];
            return $http.post(path, $.param({idState : idState}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}}).then(function(data){
                service.listCities.data = data.data;
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

        service.updateContactHotel = function(hotelContacto){
            var path = $("#pathContactUpdate").val();
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
            var path = $("#pathContratosAll").val();
            return $http.post(path, $.param({idHotel : idHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                service.listaContratos.data = data.data;
            });
        };

        service.findListContractsActivos = function(idHotel){
            var path = $("#pathContratos").val();
            return $http.post(path, $.param({idHotel : idHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                service.listaContratos.data = data.data;
            });
        };

        service.isAvailableContrato = function(idHotel, idContrato, descripcion){
            var path = $("#pathContratodisponible").val();
            return $http.post(path, $.param({idHotel : idHotel, idContrato: idContrato, descripcion: descripcion}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
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
            });
        };

        service.saveHabitacionIdioma = function(hotelHabitacion){
            var path = $("#pathCreateHabitacionIdioma").val();
            return $http.post(path, $.param({hotelHabitacionIdioma : JSON.stringify(hotelHabitacion)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.getListTarifa = function(fechaInicio, fechaFin, idContrato, idHabitacion, idHotel){
            var path = $("#pathRateList").val();
            return $http.post(path, $.param({fechaInicio : fechaInicio, fechaFin : fechaFin, idContrato : idContrato, idHabitacion : idHabitacion, idHotel : idHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function(data){
                service.listaTarifasHotel.data = data.data;
            });
        };

        service.saveTarifaHotel = function(hotelTarifaTO){
            var path = $("#pathSaveTarifa").val();
            return $http.post(path, $.param({hotelTarifaTO : JSON.stringify(hotelTarifaTO)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.initValues = function () {
            service.listaFechas.data = [];
            service.listaContratos.data = [];
            service.listaHabitacionesHotel.data = [];
            service.listaTarifasHotel.data = [];
        };

        return service;
    });
})();