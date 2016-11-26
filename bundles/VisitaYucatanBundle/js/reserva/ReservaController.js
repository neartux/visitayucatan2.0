/**
 * Created by ricardo on 13/08/16.
 */
(function () {
    var app = angular.module('Reserva', ['ReservaProvider']).config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('ReservaController', function ($scope, $http, ReservaService) {
        var ctrlReserva = this;
        ctrlReserva.VentaCompletaTO = ReservaService.VentaCompletaTO;
        ctrlReserva.contextPath = '';
        ctrlReserva.file = 'VIYUC';
        ctrlReserva.idVentaActual = undefined;
        ctrlReserva.pathActual = undefined;
        ctrlReserva.datoVuelo = {};

        ctrlReserva.init = function (contextPath) {
            ctrlReserva.contextPath = contextPath;
            ReservaService.contextPath = contextPath;
        };
        
        ctrlReserva.displayReservaPDF = function (idVenta, path) {
            ctrlReserva.idVentaActual = idVenta;
            ctrlReserva.pathActual = ctrlReserva.contextPath+path+ctrlReserva.file+'-'+idVenta+'.pdf';
            $("#pdfTagReserva").attr("data", ctrlReserva.pathActual);
            $("#pdfReserva").modal();  
        };
        
        ctrlReserva.findDetalleReserva = function (idVenta, tipoProducto) {
            ReservaService.findVentaById(idVenta, tipoProducto).then(function (data) {
                $("#modalDetalleReserva").modal();
            });
        };
        
        ctrlReserva.reenvioReserva = function () {
            if(confirm("¿Seguro desea reenviar el archivo de reserva?")){
                if (ctrlReserva.idVentaActual != undefined && ctrlReserva.pathActual != undefined){
                    console.info(ctrlReserva.idVentaActual, ctrlReserva.pathActual);
                    ReservaService.reenvioReserva(ctrlReserva.idVentaActual, ctrlReserva.pathActual).then(function (data) {
                        console.info("data = ", data.data);
                    });
                }
            }
        };

        ctrlReserva.viewDatosVuelo = function (idVenta, aerolinea, numeroVuelo, fechaLLegada, horaLlegada, hotelPickup) {
            ctrlReserva.idVentaActual = idVenta;
            ctrlReserva.datoVuelo = {
                aErolinea: aerolinea,
                numeroVuelo: numeroVuelo,
                fechaLlegada: fechaLLegada,
                horaLlegada: horaLlegada,
                hotelPickup:hotelPickup
            };
            $("#datosVueloModal").modal();
        };

    });

})();