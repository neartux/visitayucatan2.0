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

        service.findHotelsActives= function(){
            var path = $("#pathListHotel").val();
            service.listHotel.data = [];
            return $http.get(path).then(function(data){
                service.listHotel.data = data.data;
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
            //alert(JSON.stringify(hotel));
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

        return service;
    });
})();