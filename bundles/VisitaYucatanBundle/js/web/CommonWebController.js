/**
 * Created by ricardo on 26/03/16.
 */
(function () {
    var app = angular.module('Web', ['ngSanitize', 'WebProvider','WebDirectives']).config(['$interpolateProvider', function ($interpolateProvider) {
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
        ctrlHotel.formRate = {};
        ctrlHotel.listRoomsHotelToSale = WebService.listRoomsHotelToSale;
        ctrlHotel.symbolCurrency = 'MXP';

        ctrlHotel.init = function(idHotel, ageMinor) {
            ctrlHotel.formRate = {
                idHotel: idHotel,
                adults: "2",
                minors: "0",
                ageMinor: ageMinor
            };
            ctrlHotel.symbolCurrency = angular.element(document.querySelector('#symbolCurrencyHidden')).context.value;
            console.info("moneda = ", ctrlHotel.symbolCurrency);
            ctrlHotel.findTarifasHotel();
        };

        ctrlHotel.findTarifasHotel = function() {
            ctrlHotel.formRate.dateFrom = angular.element(document.querySelector('#dateFrom')).context.value;
            ctrlHotel.formRate.dateTo = angular.element(document.querySelector('#dateTo')).context.value;
            console.info("buscando tarifas formRate= ", ctrlHotel.formRate);
            var isValid = ctrlHotel.validateAgeMinors();
            console.info("is valid = ", isValid);
            if(isValid){
                if(WebService.isRangeDateValid(ctrlHotel.formRate.dateFrom, ctrlHotel.formRate.dateTo)){
                    return WebService.findRateRoomByHotel(ctrlHotel.formRate);
                }
            }
        };

        ctrlHotel.validateAgeMinors = function () {
            var isValid = true;
            if(ctrlHotel.formRate.minors > 0){
                for (var i = 0; i < ctrlHotel.formRate.minors; i++) {
                    var ageMinor = parseInt($("#minor_"+(i+1)).val());
                    if(ageMinor > ctrlHotel.formRate.ageMinor){
                        isValid = false;
                    }
                }
            }
            return isValid;
        };

        ctrlHotel.displayInputsMinors = function () {
            console.info("en metodo = ", ctrlHotel.formRate.minors);
            if(ctrlHotel.formRate.minors > 0){
                var inputs = "<tr>";
                console.info("ctrlHotel.formRate.minors = ", ctrlHotel.formRate.minors);
                for (var i = 0; i < ctrlHotel.formRate.minors; i++) {
                    inputs += "<td>Menor " + (i+1) + " <br>" +
                        "<input type='text' id='minor_"+(i+1)+"'/></td>";
                }
                inputs += "</tr>";
                $("#tableMenors").html(inputs);
            } else {
                $("#tableMenors").html('');
            }
        };

        ctrlHotel.confirmReservaHotel = function (idHabitacion) {
            console.info("ctrlWeb.formRate = ", ctrlHotel.formRate);
            $("#fechaInicio").val(ctrlHotel.formRate.dateFrom);
            $("#fechaFin").val(ctrlHotel.formRate.dateFrom);
            $("#adultsHidden").val(ctrlHotel.formRate.adults);
            $("#minorsHidden").val(ctrlHotel.formRate.minors);
            $("#idHabitacion").val(idHabitacion);
            $("#frmReserveHotel").submit();
        };
        
    });

    app.controller('WebCommonsController', function($scope, $http, WebService){
        var ctrlCommons = this;
        ctrlCommons.listLanguages = WebService.listLanguages;
        ctrlCommons.listCurrency = WebService.listCurrency;
        ctrlCommons.objCatalog = {
            language : undefined,
            currency : undefined
        };

        ctrlCommons.initCommons = function(language, currency){
            ctrlCommons.objCatalog.language = language;
            ctrlCommons.objCatalog.currency = currency;
            WebService.findAllLanguages();
            WebService.findAllCurrency();
        };

        ctrlCommons.changeCurrencyOrLanguage = function() {
            WebService.changeCurrencyOrLanguageSession(ctrlCommons.objCatalog.language, ctrlCommons.objCatalog.currency).then(function(data){
               if(data.data){
                   document.location.reload (true);
               }
            });
        };

    });

    app.controller('WebPaqueteController',function($scope,WebService){
        var paqWebVM = this;

        paqWebVM.habCombinaciones = undefined;
        paqWebVM.initPaquete = function(combinacionespaquete){
            paqWebVM.habitacion='sencillo';
            paqWebVM.combinacionesPaquete = JSON.parse(combinacionespaquete);
            console.info("combinacionesPaquete",paqWebVM.combinacionesPaquete);
            paqWebVM.changeHabitacion('sencillo');
        }
        paqWebVM.initReservaPaquete= function(detailReserva,paqueteCombinacion,importe){
            paqWebVM.detailReserva = JSON.detailReserva;
            paqWebVM.importe = importe;
            paqWebVM.paqueteCombinacion=paqueteCombinacion;
        }
        paqWebVM.changeHabitacion = function(ocupacion){
            switch(ocupacion){
                case 'sencillo':
                        paqWebVM.habCombinaciones = paqWebVM.armarCostos(paqWebVM.combinacionesPaquete,'costosencillo');
                    break;
                case 'doble':
                        paqWebVM.habCombinaciones = paqWebVM.armarCostos(paqWebVM.combinacionesPaquete,'costodoble');
                    break;
                case 'triple':
                        paqWebVM.habCombinaciones = paqWebVM.armarCostos(paqWebVM.combinacionesPaquete,'costotriple');
                    break;
                case 'cuadruple':
                        paqWebVM.habCombinaciones = paqWebVM.armarCostos(paqWebVM.combinacionesPaquete,'costocuadruple');
                    break;
            }
        }
        paqWebVM.armarCostos = function(array,ocupacion){
            angular.forEach(array,function(o){
                o.costo = eval('o.'+ocupacion);
                o.ocupacion = ocupacion
            });
            return array;
        };
        paqWebVM.reservar = function(item){
        }
    });

})();