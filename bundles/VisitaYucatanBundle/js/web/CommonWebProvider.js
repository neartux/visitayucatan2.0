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

        service.changeCurrencyOrLanguageSession = function(language, currency){
            var path = angular.element(document.querySelector('#pathCatalogsReload')).context.value;
            return $http.post(path, $.param({language : language, currency : currency}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
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

        return service;
    });
})();