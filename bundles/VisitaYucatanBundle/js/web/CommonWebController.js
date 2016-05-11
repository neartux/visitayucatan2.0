/**
 * Created by ricardo on 26/03/16.
 */
(function () {
    var app = angular.module('Web', ['WebProvider']).config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.filter('unsafe', function($sce) { return $sce.trustAsHtml; });

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
        ctrlWeb.minimoPersonas = 0;


        ctrlWeb.initTour = function (rateChild, rateAdult, exchangeRate) {
            console.info("en init detalle", angular.element(document.querySelector('#symbolCurrencyHidden')).context.value, exchangeRate, rateChild, rateAdult);
            ctrlWeb.configureParametersInit(rateChild, rateAdult, exchangeRate);
        };

        ctrlWeb.initReservaTour = function (fechaReserva, totalAdultos, totalMenores, rateChild, rateAdult, exchangeRate, minimoPerson){
            console.info(fechaReserva);
            ctrlWeb.totalPersons = {
                children : totalMenores,
                adults : totalAdultos
            };
            $('.datepicker').val(fechaReserva);
            ctrlWeb.configureParametersInit(rateChild, rateAdult, exchangeRate, minimoPerson);
        };

        ctrlWeb.configureParametersInit = function(rateChild, rateAdult, exchangeRate, minimoPerson){
            ctrlWeb.symbolCurrency = angular.element(document.querySelector('#symbolCurrencyHidden')).context.value;
            console.info("simbolo ", ctrlWeb.symbolCurrency);
            ctrlWeb.exchangeRate = parseFloat(exchangeRate);
            ctrlWeb.rateChild = parseFloat(rateChild);
            ctrlWeb.rateAdult = parseFloat(rateAdult);
            ctrlWeb.minimoPersonas = parseInt(minimoPerson);
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
        ctrlHotel.formRate = {};
        ctrlHotel.listRoomsHotelToSale = WebService.listRoomsHotelToSale;

        ctrlHotel.init = function(dateFrom, dateTo, idHotel) {
            ctrlHotel.hotel.idHotel = idHotel;
            console.info(dateFrom, dateTo, idHotel);
            angular.element(document.querySelector('#dateFrom')).context.value = dateFrom;
            angular.element(document.querySelector('#dateTo')).context.value = dateTo;
        };

        ctrlHotel.findTarifasHotel = function() {
            console.info("buscando tarifas formRate= ", ctrlHotel.formRate);
            ctrlHotel.formRate.dateFrom = angular.element(document.querySelector('#dateFrom')).context.value;
            ctrlHotel.formRate.dateTo = angular.element(document.querySelector('#dateTo')).context.value;
            return WebService.findRateRoomByHotel(ctrlHotel.formRate, ctrlHotel.hotel.idHotel);
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