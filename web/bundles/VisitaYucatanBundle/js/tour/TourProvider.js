/**
 * Created by ricardo on 8/01/16.
 */
(function () {
    var app = angular.module('TourProvider', []);
    app.factory('TourService', function($http, $q){

        var service = {};

        service.listTour = {
            data:undefined
        };
        service.listLanguage = {
            data:undefined
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
                console.info("idiomas = "+JSON.stringify(data.data));
                service.listLanguage.data = data.data;
            });
        };

        service.findTourByIdAndLanguaje = function(idTour, idLanguage){
            console.info(idTour, idLanguage);
            var path = $("#pathTourByLanguage").val();
            return $http.post(path, $.param({idTour : idTour, idLanguage : idLanguage}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                console.log("datos = "+JSON.stringify(data.data));
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

        return service;
    });
})();