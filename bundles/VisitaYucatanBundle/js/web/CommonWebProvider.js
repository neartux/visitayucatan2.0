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
        service.listImagesHotel = {
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
                service.listItemsSimilar.data = response.data;
            });
        };
        
        service.findRateRoomByHotel = function (formRate) {
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

        service.createReservationTour = function(ventaCompletaTO){
            return $http.post(service.contextPath+'/tour/createReservationTour', $.param({ventaCompletaTO : JSON.stringify(ventaCompletaTO)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };
        
        service.redirectToSuccessSale = function () {
            window.location.href = service.contextPath+'/venta/send/voucher/tour';  
        };
        
        service.sendMailReservaTour = function (idVenta) {
            return $http.post(service.contextPath+'/venta/send/voucher/tour', $.param({idVenta : idVenta}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.createReservationHotel = function(ventaCompletaTO){
            return $http.post(service.contextPath+'/hotel/createReservationHotel', $.param({ventaCompletaTO : JSON.stringify(ventaCompletaTO)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.redirectToSuccessSaleHotel = function () {
            window.location.href = service.contextPath+'/venta/send/voucher/hotel';
        };

        service.createReservationPackage = function(ventaCompletaTO){
            return $http.post(service.contextPath+'/paquete/createReservationPackage', $.param({ventaCompletaTO : JSON.stringify(ventaCompletaTO)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.redirectToSuccessSalePackage = function () {
            window.location.href = service.contextPath+'/venta/send/voucher/paquete';
        };

        service.findImagesHotel = function(idHotel){
            var path = $("#pathImagesHotel").val();
            return $http.post(path, $.param({idHotel : idHotel}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                service.listImagesHotel.data = response.data;
            });
        };
        
        service.payProduct = function (idVenta, numberCard, month, year, code, amount) {
            console.info(idVenta, numberCard, month, year, code, amount);
            var data = "version=34&order.id=VIYUC"+idVenta+"&transaction.id="+idVenta+"&apiOperation=PAY&sourceOfFunds.type=CARD&" +
                "sourceOfFunds.provided.card.number="+numberCard+"&sourceOfFunds.provided.card.expiry.month="+month+"&sourceOfFunds.provided.card.expiry.year="+year+"&" +
                "sourceOfFunds.provided.card.securityCode="+code+"&order.amount="+amount+"&order.currency=MXN";

            console.info("DAtos a enviar pago = ", data);

            return $http.post(service.contextPath+'/venta/process', data, {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
            
        };

        service.updateDatosPago = function(idVenta, pagado, numeroAutorizacion, numeroOperacion, tipoTarjeta){
            return $http.post(service.contextPath+'/venta/upadteDatosPago', $.param({idVenta: idVenta, pagado: pagado, numeroOperacion: numeroOperacion, numeroAutorizacion: numeroAutorizacion, tipoTarjeta: tipoTarjeta}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };
        
        service.isPaySuccess = function (result) {
            console.info("RESULT  = ", result);
            return result == "SUCCESS";
        };

        return service;
    });
})();