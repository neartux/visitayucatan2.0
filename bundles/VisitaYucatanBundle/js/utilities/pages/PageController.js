/**
 * Created by ricardo on 15/05/16.
 */
(function (){
    var app = angular.module('Peninsula', ['ngSanitize', 'PeninsulaProvider']).config(['$interpolateProvider',function($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('PeninsulaController', function($scope, $http, PeninsulaService){
        var ctrlPeninsula = this;
        ctrlPeninsula.listLanguage = PeninsulaService.listLanguage;

        ctrlPeninsula.init = function () {

            ctrlPeninsula.titleCreate = 'Nueva Península';
            ctrlPeninsula.titleEdit = 'Editar Península';
            ctrlPeninsula.msjLoading = 'Cargando';
            ctrlPeninsula.titleModal = 'Crear';
            ctrlPeninsula.confirmDelete = 'Se ha elimino con éxito';


        };


    });

})();