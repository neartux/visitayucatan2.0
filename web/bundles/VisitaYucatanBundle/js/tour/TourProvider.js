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

        service.findToursActives= function(){
            var path = $("#pathListTour").val();
            service.listTour.data = [];
            return $http.get(path).then(function(data){
                service.listTour.data = data.data;
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