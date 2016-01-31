/**
 * Created by ricardo on 25/12/15.
 */
(function () {
    var app = angular.module('CurrencyProvider', []);
    app.factory('CurrencyService', function($http, $q){

        var service = {};

        service.listCurrency = {
            data:undefined
        };

        service.findCurrencyActives= function(){
            var path = $("#pathListCurrency").val();
            service.listCurrency.data = [];
            return $http.get(path).then(function(data){
                service.listCurrency.data = data.data;
            });
        };

        service.createCurrency = function(currency){
            var path = $("#pathCreateCurrency").val();
            return $http.post(path, $.param({currency : JSON.stringify(currency)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.updateCurrency = function(currency){
            var path = $("#pathUpdateCurrency").val();
            return $http.post(path, $.param({currency : JSON.stringify(currency)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.deleteCurrencyById = function(idCurrency){
            var path = $("#pathDeleteCurrency").val();
            return $http.post(path, $.param({idCurrency : idCurrency}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        return service;
    });
})();