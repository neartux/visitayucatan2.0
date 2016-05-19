/**
 * Created by ricardo on 15/05/16.
 */
(function (){
    var app = angular.module('Page', ['ArticleProvider']).config(['$interpolateProvider',function($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('PageController', function($scope, $http, ArticleService){
        var ctrl = this;
        ctrl.msjLoading = 'Cargando';
        ctrl.TIPO_ARTICULO_PAGINA_TOUR = 'tour';
        ctrl.TIPO_ARTICULO_PAGINA_PAQUETE = 'paquete';
        ctrl.TIPO_ARTICULO_PAGINA_HOTEL = 'hotel';
        ctrl.seccionActive = '';
        
        ctrl.initPage = function () {
            ctrl.seccionActive = ctrl.TIPO_ARTICULO_PAGINA_PAQUETE;
            return ArticleService.findPageBySeccionAndIdioma(ctrl.TIPO_ARTICULO_PAGINA_PAQUETE, 1).then(function (response) {
                console.info(response);
                $(".summernote").code(response.data);
            });
        };

        ctrl.findPageBySeccionAndIdioma = function () {
            return ArticleService.findPageBySeccionAndIdioma(ctrl.seccionActive, ctrl.idIdioma);
        };


    });

})();