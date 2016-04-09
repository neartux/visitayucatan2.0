/**
 * Created by ricardo on 26/03/16.
 */
(function () {
    var app = angular.module('Web', ['WebProvider']).config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('WebTourController', function ($scope, $http, WebService) {
        var ctrlWeb = this;
        ctrlWeb.symbolCurrency = 'MXP';
        ctrlWeb.exchangeRate = 1;
        //Variables tour
        ctrlWeb.rateChild = 0;
        ctrlWeb.rateAdult = 0;
        ctrlWeb.totalPersons = {
            children : '0',
            adults : '2'
        };


        ctrlWeb.initTour = function (rateChild, rateAdult, exchangeRate) {
            console.info("en init detalle", angular.element(document.querySelector('#symbolCurrencyHidden')).context.value, exchangeRate, rateChild, rateAdult);
            ctrlWeb.configureParametersInit(rateChild, rateAdult, exchangeRate);
        };

        ctrlWeb.initReservaTour = function (fechaReserva, totalAdultos, totalMenores, rateChild, rateAdult, exchangeRate){
            console.info(fechaReserva);
            ctrlWeb.totalPersons = {
                children : totalMenores,
                adults : totalAdultos
            };
            $('.datepicker').val(fechaReserva);
            ctrlWeb.configureParametersInit(rateChild, rateAdult, exchangeRate);
        };

        ctrlWeb.configureParametersInit = function(rateChild, rateAdult, exchangeRate){
            ctrlWeb.symbolCurrency = angular.element(document.querySelector('#symbolCurrencyHidden')).context.value;
            console.info("simbolo ", ctrlWeb.symbolCurrency);
            ctrlWeb.exchangeRate = parseFloat(exchangeRate);
            ctrlWeb.rateChild = parseFloat(rateChild);
            ctrlWeb.rateAdult = parseFloat(rateAdult);
        };

        ctrlWeb.recalculateCostTour = function(){
            var totalAdults = parseInt(ctrlWeb.totalPersons.adults);
            var totalChildren = parseInt(ctrlWeb.totalPersons.children);

            var costTotalAdults = totalAdults * ctrlWeb.rateAdult;
            var costTotalChildren = totalChildren * ctrlWeb.rateChild;

            var totalCost = costTotalAdults + costTotalChildren;

            $('#totalCostTour').text('$'+totalCost.toLocaleString()+' '+ctrlWeb.symbolCurrency);

        }

    });

    app.controller("WebHotelController", function ($scope, $http, WebService) {
        var ctrlHotel = this;
        ctrlHotel.hotel = {};

        ctrlHotel.init = function(dateFrom, dateTo, idHotel) {
            ctrlHotel.hotel.idHotel = idHotel;
            console.info(dateFrom, dateTo);
            angular.element(document.querySelector('#dateFrom')).context.value = dateFrom;
            angular.element(document.querySelector('#dateTo')).context.value = dateTo;
        };

        ctrlHotel.findTarifasHotel = function() {

        };

        ctrlHotel.isSammeDates = function (dateFrom, dateTo){
            console.info(dateFrom, dateTo);
            if(dateFrom == dateTo){
                alert("es misma fecha");
            }
        };
    });

    app.controller('WebCommonsController', function($scope, $http, WebService){
        var ctrlCommons = this;
        ctrlCommons.objCatalog = {
            language : undefined,
            currency : undefined
        };

        ctrlCommons.initCommons = function(language, currency){
            ctrlCommons.objCatalog.language = language;
            ctrlCommons.objCatalog.currency = currency;
        };

        ctrlCommons.changeCurrencyOrLanguage = function() {
            WebService.changeCurrencyOrLanguageSession(ctrlCommons.objCatalog.language, ctrlCommons.objCatalog.currency).then(function(data){
               if(data.data){
                   document.location.reload (true);
               }
            });
        };

    });

})();