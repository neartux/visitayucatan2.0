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
        ctrlWeb.ventaCompletaTO = {};
        ctrlWeb.soloAdultos= undefined;


        ctrlWeb.initTour = function (rateChild, rateAdult, exchangeRate, idTour) {
            ctrlWeb.configureParametersInit(rateChild, rateAdult, exchangeRate);
            ctrlWeb.idTour = idTour;
            ctrlWeb.findItemsSimilar();
        };

        ctrlWeb.findItemsSimilar = function () {
            var path = angular.element(document.querySelector('#toursSimilars')).context.value;
            WebService.findItemsSimilar(path, ctrlWeb.idTour);
        };

        ctrlWeb.initReservaTour = function (fechaReserva, totalAdultos, totalMenores, rateChild, rateAdult, exchangeRate, minimoPerson, contextPath,
                                            idIdioma, idMoneda, idTour, soloadultos){
            console.info("soloadultos = ", soloadultos);
            ctrlWeb.soloAdultos = soloadultos;
            ctrlWeb.totalPersons = {
                numeroMenores : totalMenores,
                numeroAdultos : totalAdultos
            };
            //$('.datepicker').val(fechaReserva);
            ctrlWeb.configureParametersInit(rateChild, rateAdult, exchangeRate, minimoPerson);
            WebService.setContextPath(contextPath);
            ctrlWeb.findItemsSimilar();

            ctrlWeb.ventaCompletaTO = {
                costoAdulto: rateAdult,
                costoMenor: rateChild,
                idIdioma: idIdioma,
                idMoneda: idMoneda,
                tipoCambio: exchangeRate,
                checkIn: fechaReserva,
                numeroMenores: ctrlWeb.totalPersons.numeroMenores,
                numeroAdultos: ctrlWeb.totalPersons.numeroAdultos,
                idTour: idTour
            }
            
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

        };
        
        ctrlWeb.calculateCost = function () {
            var totalAdults = parseInt(ctrlWeb.totalPersons.numeroAdultos);
            var totalChildren = parseInt(ctrlWeb.totalPersons.numeroMenores);

            var costTotalAdults = totalAdults * ctrlWeb.rateAdult;
            var costTotalChildren = totalChildren * ctrlWeb.rateChild;
            
            return costTotalAdults + costTotalChildren;
        };

        ctrlWeb.reservarTour = function (isFormValid) {
            if(isFormValid) {
                ctrlWeb.ventaCompletaTO.costoTotal = ctrlWeb.calculateCost();
                if(parseInt(ctrlWeb.totalPersons.numeroMenores) > 0){
                    if(ctrlWeb.soloAdultos != undefined && ctrlWeb.soloAdultos){
                        alert("este tour es solo para adultos");
                        return;
                    }
                }
                if(parseInt(ctrlWeb.minimoPersonas) > (parseInt(ctrlWeb.totalPersons.numeroAdultos)+parseInt(ctrlWeb.totalPersons.numeroMenores))){
                    alert("El minimo de personas para este paquete es "+ctrlWeb.minimoPersonas);
                    return
                }
                WebService.createReservationTour(ctrlWeb.ventaCompletaTO).then(function (response) {
                    console.info("response = ", response);
                    WebService.redirectToSuccessSale();
                });
            }
        };

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
            ctrlHotel.getRangeStars(estrellas);
            ctrlHotel.findItemsSimilar();
        };

        ctrlHotel.findItemsSimilar = function () {
            var path = angular.element(document.querySelector('#pathSimilars')).context.value;
            WebService.findItemsSimilar(path, 0);
        };

        ctrlHotel.getRangeStars = function (estrellas) {
            var array = [];
            for(var i = 1; i <= estrellas; i++){
                array.push(i);
            }
            ctrlHotel.arrayEstrellas = array;
        };
        
        ctrlHotel.initReserva = function (tarifaAdulto, tarifaMenor, idIdioma, idMoneda, tipoCambio, costoTotal, checkIn, checkOut, adultos, menores, contextPath, idHotel, idHabitacion) {
            WebService.setContextPath(contextPath);
            ctrlHotel.ventaCompletaTO = {
                tarifaAdulto: tarifaAdulto,
                costoAdulto: tarifaAdulto,
                costoMenor: tarifaMenor,
                tarifaMenor: tarifaMenor,
                idIdioma: idIdioma,
                idMoneda: idMoneda,
                tipoCambio: tipoCambio,
                costoTotal: costoTotal,
                checkIn: checkIn,
                checkOut: checkOut,
                numeroMenores: menores,
                numeroAdultos: adultos,
                idHotel: idHotel,
                idHabitacion: idHabitacion
            }

        };

        ctrlHotel.createRerservaHotel = function () {
            WebService.createReservationHotel(ctrlHotel.ventaCompletaTO).then(function (response) {
                console.info("resultado reserva hotel = ", response);
                WebService.redirectToSuccessSaleHotel();
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

        ctrlHotel.confirmReservaHotel = function (habitacion, idHabitacion) {
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

    app.controller('WebPaqueteController',function($scope,WebService) {
        var paqWebVM = this;

        paqWebVM.habCombinaciones = undefined;
        paqWebVM.listItemsSimilar = WebService.listItemsSimilar;
        paqWebVM.listImagesHotel = WebService.listImagesHotel;
        paqWebVM.reservar = {};
        paqWebVM.ventaCompletaTO = {};
        paqWebVM.menores = [
            {id: 0, value: 0, label: "0"},
            {id: 1, value: 1, label: "1"},
            {id: 2, value: 2, label: "2"}
        ];
        paqWebVM.idPaquete = 0;
        paqWebVM.mensageDetallePaquete = '';
        paqWebVM.initPaquete = function (combinacionespaquete, idPackage) {
            paqWebVM.idPaquete = idPackage;
            paqWebVM.habitacion = 'doble';
            paqWebVM.combinacionesPaquete = JSON.parse(combinacionespaquete);
            paqWebVM.findItemsSimilar();

            paqWebVM.messages = {
                sencillo: $("#messagePckSimple").val(),
                doble: $("#messagePckDouble").val(),
                triple: $("#messagePckTriple").val(),
                cuadruple: $("#messagePckQuadruple").val()
            };

            paqWebVM.changeHabitacion('doble');

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
                    paqWebVM.mensageDetallePaquete = paqWebVM.messages.sencillo;
                    break;
                case 'doble':
                        paqWebVM.habCombinaciones = paqWebVM.armarCostos(paqWebVM.combinacionesPaquete,'costodoble');
                    paqWebVM.mensageDetallePaquete = paqWebVM.messages.doble;
                    break;
                case 'triple':
                        paqWebVM.habCombinaciones = paqWebVM.armarCostos(paqWebVM.combinacionesPaquete,'costotriple');
                    paqWebVM.mensageDetallePaquete = paqWebVM.messages.triple;
                    break;
                case 'cuadruple':
                        paqWebVM.habCombinaciones = paqWebVM.armarCostos(paqWebVM.combinacionesPaquete,'costocuadruple');
                    paqWebVM.mensageDetallePaquete = paqWebVM.messages.cuadruple;
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
        paqWebVM.initReservaPaquete= function(detailReserva,paqueteCombinacion,importe, contextPath, idPaquete, idIdioma, idMoneda){
            paqWebVM.detailReserva = JSON.parse(detailReserva);
            paqWebVM.importe = importe;
            var combinacion = JSON.parse(paqueteCombinacion);
            console.info("combinacin = ", combinacion);
            paqWebVM.paqueteCombinacion= combinacion[0];
            paqWebVM.reservar = {
                adultos:paqWebVM.detailReserva.adultos.toString(),
                menores:paqWebVM.menores[paqWebVM.detailReserva.menores]
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
            WebService.contextPath = contextPath;

            paqWebVM.initVentaCompletaTO(idPaquete, idIdioma, idMoneda, combinacion);
        };

        paqWebVM.initVentaCompletaTO = function (idPaquete, idIdioma, idMoneda, combinacion) {
            console.info("combinacion = ", combinacion);
            paqWebVM.ventaCompletaTO = {
                idPaquete: idPaquete,
                numeroAdultos: paqWebVM.reservar.adultos,
                numeroMenores: paqWebVM.reservar.menores.value,
                costoTotal: paqWebVM.importeTotal,
                idIdioma: idIdioma,
                idMoneda: idMoneda,
                idCombinacion: combinacion[0].id,
                idHotel: combinacion[0].id_hotel,
                costoMenor: combinacion[0].costomenor,
                costoAdulto: combinacion[0].costomenor,
                tipoCambio: combinacion[0].tipocambio
            };
            console.info("la venta final = ", paqWebVM.ventaCompletaTO);
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
        };
        
        paqWebVM.reservarPackage = function(isFormValid){

            paqWebVM.ventaCompletaTO.checkIn = $("#fechaPaquete").val();
            paqWebVM.ventaCompletaTO.checkOut = $("#fechaSalida").val();
            
            console.info("isFormValid = ", isFormValid, " paqWebVM.reservar.menores = ", paqWebVM.reservar.menores, " paqWebVM.reservar.adultos = ", paqWebVM.reservar.adultos);
            paqWebVM.ventaCompletaTO.fechaLlegada = $("#fechaLlegada").val();
            paqWebVM.ventaCompletaTO.horaLlegada = $("#horaLlegada").val();
            console.info("fechallegada = ", paqWebVM.ventaCompletaTO.fechaLlegada);
            console.info("horallegada = ", paqWebVM.ventaCompletaTO);

            console.info("paqWebVM.ventaCompletaTO final = ", paqWebVM.ventaCompletaTO);
            WebService.createReservationPackage(paqWebVM.ventaCompletaTO).then(function (response) {
                console.info("respuesta = ", response);
                WebService.redirectToSuccessSalePackage();
            });
        };
        paqWebVM.changeDatePackage = function () {
            console.info("paqWebVM.ventaCompletaTO.fechaPaquete = ", paqWebVM.ventaCompletaTO.fechaPaquete);
            console.info("paqWebVM.ventaCompletaTO.fechaSalida = ", paqWebVM.ventaCompletaTO.fechaSalida);
        };
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
        
        paqWebVM.enviarReserva = function (id, h) {
            $("#idPckg").val(h.id);
            $("#costoPckg").val(h.costo);
            $("#typeocupacionPckg").val(h.ocupacion);
            $("#idPackagePckg").val(paqWebVM.idPaquete);
            $('#frm-rsv-pckg').submit();
        };

        paqWebVM.findImagesHotel = function (idHotel) {
            WebService.findImagesHotel(idHotel).then(function () {
                var newList = [];
                angular.forEach(paqWebVM.listImagesHotel.data, function (value, key) {
                    newList.push({"src": value.src});
                });
                $.magnificPopup.open({
                    items: newList,
                    preloader: false,
                    gallery: {
                        enabled: true
                    }
                });
            });
        };
    });

})();