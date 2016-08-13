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

        ctrlReserva.init = function (contextPath) {
            ctrlReserva.contextPath = contextPath;
            ReservaService.contextPath = contextPath;
        };
        
        ctrlReserva.displayReservaPDF = function (idVenta, path) {
            $("#pdfTagReserva").attr("data", ctrlReserva.contextPath+path+ctrlReserva.file+'-'+idVenta+'.pdf');
            $("#pdfReserva").modal();  
        };
        
        ctrlReserva.findDetalleReserva = function (idVenta) {
            console.info("idventa = ", idVenta);
            ReservaService.findVentaById(idVenta).then(function (data) {
                $("#modalDetalleReserva").modal();
            });
        };

    });

})();