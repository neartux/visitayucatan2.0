/**
 * Created by ricardo on 13/08/16.
 */
(function () {
    var app = angular.module('ReservaProvider', []);
    app.factory('ReservaService', function($http, $q){

        var service = {};

        service.VentaCompletaTO = {
            data: undefined
        };
        service.contextPath = '';

        service.findVentaById= function(idVenta, tipoProducto){
            return $http.get(service.contextPath+'/venta/findVentaById/'+idVenta).then(function(data){
                service.VentaCompletaTO.data = data.data;
                service.VentaCompletaTO.data.tipoProducto = tipoProducto;
            });
        };

        service.reenvioReserva= function(idVenta, filePath){
            return $http.post(service.contextPath+'/venta/reenvio/reservacion', $.param({idVenta: idVenta, path: filePath}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        return service;
    });
})();