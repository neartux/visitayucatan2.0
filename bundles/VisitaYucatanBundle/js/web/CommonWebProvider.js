/**
 * Created by ricardo on 26/03/16.
 */
(function () {
    var app = angular.module('WebProvider', []);
    app.factory('WebService', function($http, $q){

        var service = {};

        service.changeCurrencyOrLanguageSession = function(language, currency){
            var path = angular.element(document.querySelector('#pathCatalogsReload')).context.value;
            return $http.post(path, $.param({language : language, currency : currency}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        return service;
    });
})();