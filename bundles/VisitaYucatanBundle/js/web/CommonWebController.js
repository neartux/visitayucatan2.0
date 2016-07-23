/**
 * Created by ricardo on 26/03/16.
 */
(function () {
    var app = angular.module('Web', ['ngSanitize', 'WebProvider','WebDirectives','WebFilters']).config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('WebTourController', function ($scope, $http, WebService) {
        var ctrlWeb = this;
        ctrlWeb.listItemsSimilar = WebService.listItemsSimilar;
        ctrlWeb.symbolCurrency = 'MXP';
        ctrlWeb.exchangeRate = 1;
        ctrlWeb.idTour = 0;
        //Variables tour
        ctrlWeb.rateChild = 0;
        ctrlWeb.rateAdult = 0;
        ctrlWeb.totalPersons = {
            numeroMenores : '0',
            numeroAdultos : '2'
        };
        ctrlWeb.minimoPersonas = 0;


        ctrlWeb.initTour = function (rateChild, rateAdult, exchangeRate, idTour) {
            ctrlWeb.configureParametersInit(rateChild, rateAdult, exchangeRate);
            ctrlWeb.idTour = idTour;
            ctrlWeb.findItemsSimilar();
        };

        ctrlWeb.findItemsSimilar = function () {
            var path = angular.element(document.querySelector('#toursSimilars')).context.value;
            WebService.findItemsSimilar(path, ctrlWeb.idTour);
        };

        ctrlWeb.initReservaTour = function (fechaReserva, totalAdultos, totalMenores, rateChild, rateAdult, exchangeRate, minimoPerson){
            ctrlWeb.totalPersons = {
                numeroMenores : totalMenores,
                numeroAdultos : totalAdultos
            };
            $('.datepicker').val(fechaReserva);
            ctrlWeb.configureParametersInit(rateChild, rateAdult, exchangeRate, minimoPerson);
            ctrlWeb.findItemsSimilar();
        };

        ctrlWeb.configureParametersInit = function(rateChild, rateAdult, exchangeRate, minimoPerson){
            ctrlWeb.symbolCurrency = angular.element(document.querySelector('#symbolCurrencyHidden')).context.value;
            ctrlWeb.exchangeRate = parseFloat(exchangeRate);
            ctrlWeb.rateChild = parseFloat(rateChild);
            ctrlWeb.rateAdult = parseFloat(rateAdult);
            ctrlWeb.minimoPersonas = parseInt(minimoPerson);
        };

        ctrlWeb.recalculateCostTour = function(){
            var totalAdults = parseInt(ctrlWeb.totalPersons.numeroAdultos);
            var totalChildren = parseInt(ctrlWeb.totalPersons.numeroMenores);

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
        ctrlHotel.listItemsSimilar = WebService.listItemsSimilar;
        ctrlHotel.symbolCurrency = 'MXP';
        ctrlHotel.ventaCompletaTO = {};
        ctrlHotel.arrayEstrellas = [];

        ctrlHotel.init = function(idHotel, ageMinor, estrellas) {
            ctrlHotel.formRate = {
                idHotel: idHotel,
                adults: "2",
                minors: "0",
                ageMinor: ageMinor
            };
            ctrlHotel.symbolCurrency = angular.element(document.querySelector('#symbolCurrencyHidden')).context.value;
            ctrlHotel.findTarifasHotel();
            ctrlHotel.getRangeStars(estrellas)
        };

        ctrlHotel.getRangeStars = function (estrellas) {
            var array = [];
            for(var i = 1; i <= estrellas; i++){
                array.push(i);
            }
            ctrlHotel.arrayEstrellas = array;
        };
        
        ctrlHotel.initReserva = function (tarifaAdulto, tarifaMenor, idIdioma, idMoneda, tipoCambio, costoTotal, checkIn, checkOut, adultos, menores, contextPath) {
            console.info(tarifaAdulto, tarifaMenor, idIdioma, idMoneda, tipoCambio, costoTotal, checkIn, checkOut, adultos, menores, contextPath);
            WebService.setContextPath(contextPath);
            ctrlHotel.ventaCompletaTO = {
                tarifaAdulto: tarifaAdulto,
                tarifaMenor: tarifaMenor,
                idIdioma: idIdioma,
                idMoneda: idMoneda,
                tipoCambio: tipoCambio,
                costoTotal: costoTotal,
                checkIn: checkIn,
                checkOut: checkOut,
                numeroMenores: menores,
                numeroAdultos: adultos
            }

        };

        ctrlHotel.createRerservaHotel = function () {
            WebService.createReservationHotel(ctrlHotel.ventaCompletaTO).then(function (response) {
            });
        };

        ctrlHotel.findTarifasHotel = function() {
            ctrlHotel.formRate.dateFrom = angular.element(document.querySelector('#dateFrom')).context.value;
            ctrlHotel.formRate.dateTo = angular.element(document.querySelector('#dateTo')).context.value;
            var isValid = ctrlHotel.validateAgeMinors();
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
            console.info("ctrlHotel.formRate.minors = ", ctrlHotel.formRate.minors);
            if(ctrlHotel.formRate.minors > 0){
                var inputs = "<tr>";
                for (var i = 0; i < ctrlHotel.formRate.minors; i++) {
                    inputs += "<td width='20%'>Edad Menor " + (i+1) + " <br>" +
                        "<input type='text' id='minor_"+(i+1)+"' class='form-control'/></td><td>&nbsp;</td>";
                }
                inputs += "</tr>";
                $("#tableMenors").html(inputs);
            } else {
                $("#tableMenors").html('');
            }
        };

        ctrlHotel.confirmReservaHotel = function (idHabitacion) {
            $("#fechaInicio").val(ctrlHotel.formRate.dateFrom);
            $("#fechaFin").val(ctrlHotel.formRate.dateTo);
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
        paqWebVM.listItemsSimilar = WebService.listItemsSimilar;
        paqWebVM.reservar = {};
        paqWebVM.menores = [
            {id:0,value:0,label:"0"},
            {id:1,value:1,label:"1"},
            {id:2,value:2,label:"2"},
        ];
        paqWebVM.idPaquete = 0;
        paqWebVM.initPaquete = function(combinacionespaquete, idPackage){
            paqWebVM.idPaquete = idPackage;
            paqWebVM.habitacion='doble';
            paqWebVM.combinacionesPaquete = JSON.parse(combinacionespaquete);
            paqWebVM.changeHabitacion('doble');
            paqWebVM.findItemsSimilar();
        };
        
        paqWebVM.findItemsSimilar = function () {
            var path = angular.element(document.querySelector('#pathSimilars')).context.value;
            WebService.findItemsSimilar(path, paqWebVM.idPaquete);
        };
        
        paqWebVM.changeHabitacion = function(ocupacion){
            
            $(".area-package-item").slideUp("fast");
            
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
            
        };
        paqWebVM.armarCostos = function(array,ocupacion){
            angular.forEach(array,function(o){
                o.costo = eval('o.'+ocupacion);
                o.ocupacion = ocupacion
            });
            $(".area-package-item").slideDown("fast");
            return array;
        };
        //paqWebVM.initReservaPaquete= function(detailReserva,paqueteCombinacion,importe){
        paqWebVM.initReservaPaquete= function(detailReserva,paqueteCombinacion,importe){
            paqWebVM.detailReserva = JSON.parse(detailReserva);
            paqWebVM.importe = importe;
            var combinacion = JSON.parse(paqueteCombinacion);
            paqWebVM.paqueteCombinacion= combinacion[0];
            paqWebVM.reservar = {
                adultos:paqWebVM.detailReserva.adultos.toString(),
                menores:paqWebVM.menores[paqWebVM.detailReserva.menores],
            };
            switch (parseInt( paqWebVM.detailReserva.adultos)) {
                case 1:
                        paqWebVM.detailReserva.costo = paqWebVM.paqueteCombinacion.costosencillo;
                    break;
                case 2:
                        paqWebVM.detailReserva.costo = paqWebVM.paqueteCombinacion.costodoble;
                    break;
                case 3:
                        paqWebVM.detailReserva.costo = paqWebVM.paqueteCombinacion.costotriple;
                    break;
                case 4:
                        paqWebVM.detailReserva.costo = paqWebVM.paqueteCombinacion.costocuadruple;
                    break;
            }
            paqWebVM.simbolCurrency = paqWebVM.paqueteCombinacion.simbolo;

            paqWebVM.calculateCostoPaquete(paqWebVM.detailReserva.adultos,paqWebVM.detailReserva.menores);
            paqWebVM.findItemsSimilar();
        };
        paqWebVM.calculateCostoPaquete = function(adultos,menores){
            var costoAdultos = parseFloat(paqWebVM.detailReserva.costo) * adultos;
            var costoMenores = parseFloat(paqWebVM.paqueteCombinacion.costomenor) * menores;
            paqWebVM.importeTotal = costoAdultos + costoMenores;
        };
        paqWebVM.ocupacionHab = function(adultos,menores){
            adultos =  parseInt(adultos);
            menores =  parseInt(menores);
            switch (adultos) {
                case 1:
                        
                        paqWebVM.detailReserva.ocupacion="Sencilla";
                        paqWebVM.detailReserva.costo = parseFloat(paqWebVM.paqueteCombinacion.costosencillo);
                        paqWebVM.menores = [
                            {id:0,value:0,label:"0"},
                            {id:1,value:1,label:"1"},
                            {id:2,value:2,label:"2"},
                        ];
                        paqWebVM.calculateCostoPaquete(adultos,menores);
                    break;
                case 2:
                        
                        paqWebVM.detailReserva.ocupacion="Doble";
                        paqWebVM.detailReserva.costo = parseFloat(paqWebVM.paqueteCombinacion.costodoble);
                        paqWebVM.menores = [
                            {id:0,value:0,label:"0"},
                            {id:1,value:1,label:"1"},
                            {id:2,value:2,label:"2"},
                        ];
                        paqWebVM.calculateCostoPaquete(adultos,menores);
                    break;
                case 3:
                        paqWebVM.calculateCostoPaquete(adultos,menores);
                        paqWebVM.detailReserva.ocupacion="Triple";
                        paqWebVM.detailReserva.costo = parseFloat(paqWebVM.paqueteCombinacion.costotriple);
                        //if(paqWebVM.reserva.adultos==3){
                            if(paqWebVM.reservar.menores.value>1){
                                paqWebVM.reservar.menores=paqWebVM.menores[0];
                            }
                        //}
                        paqWebVM.menores = [
                            {id:0,value:0,label:"0"},
                            {id:1,value:1,label:"1"}
                        ];
                        paqWebVM.calculateCostoPaquete(adultos,menores);           
                    break;
                case 4:
                        paqWebVM.calculateCostoPaquete(adultos,menores);
                        paqWebVM.detailReserva.ocupacion="Cuádruple";
                        paqWebVM.detailReserva.costo = parseFloat(paqWebVM.paqueteCombinacion.costocuadruple);
                        if(paqWebVM.reservar.menores.value>0){
                            paqWebVM.reservar.menores=paqWebVM.menores[0];
                        }
                        paqWebVM.menores = [
                            {id:0,value:0,label:"0"}
                        ];
                        paqWebVM.calculateCostoPaquete(adultos,menores);
                    break;
                default:
                    break;
            }
        }
        paqWebVM.reservar = function(item){
        }
        $scope.$watch('paqWebVM.reservar.menores',function(val){
            if(val){
                if(paqWebVM.reservar.adultos==3){
                    paqWebVM.calculateCostoPaquete(paqWebVM.reservar.adultos,paqWebVM.reservar.menores.value);
                    
                }
                if(paqWebVM.reservar.adultos==4){
                   paqWebVM.calculateCostoPaquete(paqWebVM.reservar.adultos,paqWebVM.reservar.menores.value);
                }
            }
        });
        paqWebVM.getRangeStars = function (hotel) {
            var array = [];
            for(var i = 1; i <= hotel.estrellashotel; i++){
                array.push(i);
            }
            hotel.totalEstrellas = array;
        };
        
        paqWebVM.enviarReserva = function (id) {
            $('#frm-rsv-'+id).submit();  
        };
    });

})();