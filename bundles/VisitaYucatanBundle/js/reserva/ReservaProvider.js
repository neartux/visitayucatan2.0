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

        service.findVentaById= function(idVenta){
            return $http.get(service.contextPath+'/venta/findVentaById', $.param({idVenta: JSON.stringify(idVenta)})).then(function(data){
                console.info("data = ", data.data);
                service.VentaCompletaTO.data = data.data;
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