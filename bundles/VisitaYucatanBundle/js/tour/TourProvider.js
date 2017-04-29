/**
 * Created by ricardo on 8/01/16.
 */
(function () {
    var app = angular.module('TourProvider', []);
    app.factory('TourService', function($http, $q){

        var service = {};

        service.listTour = {
            data: undefined
        };
        service.listLanguage = {
            data: undefined
        };
        service.tourIdiomaTO = {
            data: undefined
        };
        service.imagesTourList = {
            data: undefined
        };
        service.listaFechas = {
            data: []
        };

        service.findToursActives= function(){
            var path = $("#pathListTour").val();
            service.listTour.data = [];
            return $http.get(path).then(function(data){
                service.listTour.data = data.data;
            });
        };

        service.findLanguagesActives= function(){
            var path = $("#pathAllLanguages").val();
            service.listLanguage.data = [];
            return $http.get(path).then(function(data){
                service.listLanguage.data = data.data;
            });
        };

        service.findTourByIdAndLanguaje = function(idTour, idLanguage){
            var path = $("#pathTourByLanguage").val();
            return $http.post(path, $.param({idTour : idTour, idLanguage : idLanguage}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                service.tourIdiomaTO.data = data.data;
            });
        };

        service.findImagesTourByIdTour = function (idTour){
            var path = $("#pathImagesTour").val();
            return $http.post(path, $.param({idTour : idTour}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                service.imagesTourList.data = data.data;
            });
        };

        service.setPrincipalImage = function(idTour, idImageTour){
            var path = $("#pathSetPrincipalImage").val();
            return $http.post(path, $.param({idTour : idTour, idImageTour: idImageTour}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.deleteImageTour = function(idImageTour){
            var path = $("#pathDeleteImageTour").val();
            return $http.post(path, $.param({idImageTour : idImageTour}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.saveTourLanguage = function(tourIdiomaTO){
            var path = $("#pathSaveTourLanguage").val();
            return $http.post(path, $.param({tourLanguage : JSON.stringify(tourIdiomaTO)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.createTour = function(tour){
            var path = $("#pathCreateTour").val();
            return $http.post(path, $.param({tour : JSON.stringify(tour)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.updateTour = function(tour){
            var path = $("#pathUpdateTour").val();
            return $http.post(path, $.param({tour : JSON.stringify(tour)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.deleteTourById = function(idTour){
            var path = $("#pathDeleteTour").val();
            return $http.post(path, $.param({idTour : idTour}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.promovedTour = function(idTour){
            var path = $("#pathPromoveTour").val();
            return $http.post(path, $.param({idTour : idTour}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.removePromovedTour = function(idTour){
            var path = $("#pathRemovePromoveTour").val();
            return $http.post(path, $.param({idTour : idTour}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.deleteFechaCierreTour = function(idFechaCierre){
            var path = $("#pathDeleteFechaCierreTour").val();
            return $http.post(path, $.param({idFechaCierre : idFechaCierre}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.createOrUpdateFechaCierre = function(idFecha, idTour, fechaInicio, fechaFin){
            if(parseInt(idFecha) == 0){
                return $http.post($("#pathFechaCierreCreate").val(), $.param({idTour: idTour, fechaInicio : fechaInicio, fechaFin : fechaFin}), {
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                });
            }else{
                return $http.post($("#pathFechaCierreUpdate").val(), $.param({idFechaCierre : idFecha, fechaInicio : fechaInicio, fechaFin : fechaFin}), {
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                });
            }
        };

        service.findFechasByTour = function (idTour){
            var path = $("#pathFechaCierreFind").val();
            service.listaFechas.data = [];
            return $http.post(path, $.param({idTour : idTour}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                service.listaFechas.data = data.data;
            });
        };

        service.listaResetTour = function(){
            angular.forEach(service.listaFechas.data, function(valor, indice) {
                if (valor.classDanger != "") {
                    valor.classDanger = "";
                }
            });
        };

        return service;
    });
})();