/**
 * Created by ricardo on 26/03/16.
 */
(function () {
    var app = angular.module('Web', ['WebProvider']).config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('WebController', function ($scope, $http, WebService) {
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
            ctrlWeb.symbolCurrency = angular.element(document.querySelector('#symbolCurrencyHidden')).context.value;
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