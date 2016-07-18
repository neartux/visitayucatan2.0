/**
 * Created by ricardo on 26/03/16.
 */
(function () {
    var app = angular.module('WebProvider', []);
    app.factory('WebService', function($http, $q){

        var service = {};
        service.listRoomsHotelToSale = {
            data: undefined
        };
        service.listLanguages = {
            data: []
        };
        service.listCurrency = {
            data: []
        };
        service.contextPath = '';
        
        service.setContextPath = function (contextPath) {
            service.contextPath = contextPath;  
        };
        service.listItemsSimilar = {
            data: []
        };

        service.changeCurrencyOrLanguageSession = function(language, currency){
            var path = angular.element(document.querySelector('#pathCatalogsReload')).context.value;
            return $http.post(path, $.param({language : language, currency : currency}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.findItemsSimilar = function(path, id){
            return $http.post(path, $.param({id : id}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                console.info("response = ", response);
                service.listItemsSimilar.data = response.data;
            });
        };
        
        service.findRateRoomByHotel = function (formRate) {
            console.info("buscando ", formRate);
            service.listRoomsHotelToSale.data = undefined;
            var path = angular.element(document.querySelector('#pathRatesFind')).context.value;
            return $http.post(path, $.param(
                {
                    adults : formRate.adults,
                    minors : formRate.minors,
                    from : formRate.dateFrom,
                    to : formRate.dateTo,
                    idHotel : formRate.idHotel
                }
            ), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                console.info(response);
                service.listRoomsHotelToSale.data = response.data.data;
            });
        };

        service.isRangeDateValid = function (firstDate, endDate) {
            var firstDateParts = firstDate.split("/");
            var endDateParts = endDate.split("/");
            var date1 = new Date(firstDateParts[2]+'-'+firstDateParts[1]+'-'+firstDateParts[0]);
            var date2 = new Date(endDateParts[2]+'-'+endDateParts[1]+'-'+endDateParts[0]);
            return date1.getTime() <= date2.getTime();
        };
        service.paqueteReserva = function(path,idCombinacion){
            return $http.post(path, $.param(
                {
                    idCombinacion : idCombinacion
                }
            ), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                console.info(response);
                //service.listRoomsHotelToSale.data = response.data.data;
            });
        };

        service.findAllLanguages= function(){
            var path = $("#web_get_languages_path").val();
            return $http.get(path).then(function(data){
                service.listLanguages.data = data.data;
            });
        };

        service.findAllCurrency = function(){
            var path = $("#web_get_currency_path").val();
            return $http.get(path).then(function(data){
                service.listCurrency.data = data.data;
            });
        };

        service.createReservationHotel = function(ventaCompletaTO){
            return $http.post(service.contextPath+'/hotel/createReservationHotel', $.param({ventaCompletaTO : JSON.stringify(ventaCompletaTO)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        return service;
    });
})();