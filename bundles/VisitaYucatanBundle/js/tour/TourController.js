/**
 * Created by ricardo on 8/01/16.
 */
var IDIOMA_DEFAULT = 1;
(function () {
    var app = angular.module('Tour', ['TourProvider']).config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('TourController', function ($scope, $http, TourService) {
        var ctrlTour = this;
        ctrlTour.tour = undefined;
        ctrlTour.listTour = TourService.listTour;
        ctrlTour.listLanguage = TourService.listLanguage;
        ctrlTour.tourIdiomaTo = TourService.tourIdiomaTO;
        ctrlTour.imagesTour = TourService.imagesTourList;
        ctrlTour.listaFechas = TourService.listaFechas;
        ctrlTour.titleCreate = '';
        ctrlTour.titleEdit = '';
        ctrlTour.msjLoading = '';
        ctrlTour.msjDeleteImage = '';
        ctrlTour.titleModal = '';
        ctrlTour.isNewTour = true;
        ctrlTour.configTour = false;
        ctrlTour.idTourGlobal = 0;
        ctrlTour.nameTourTitle = '';

        ctrlTour.init = function (titleCreate, titleEdit, confirmDelete, msjLoading, msjDeleteImg) {
            ctrlTour.titleCreate = titleCreate;
            ctrlTour.titleEdit = titleEdit;
            ctrlTour.msjLoading = msjLoading;
            ctrlTour.titleModal = titleCreate;
            ctrlTour.confirmDelete = confirmDelete;
            ctrlTour.msjDeleteImage = msjDeleteImg;
            ctrlTour.findAllTours();
            ctrlTour.findAllLanguages();
        };

        ctrlTour.findAllTours = function () {
            return TourService.findToursActives();
        };

        ctrlTour.findAllLanguages = function () {
            return TourService.findLanguagesActives();
        };

        ctrlTour.findTourByIdAndLanguage = function () {
            if(ctrlTour.tourIdiomaTo.data != undefined){
                var idiomaTmp = ctrlTour.tourIdiomaTo.data.idIdioma;
                return TourService.findTourByIdAndLanguaje(ctrlTour.idTourGlobal, ctrlTour.tourIdiomaTo.data.idIdioma).then(function(){
                    console.info("tourIdiomaTo",ctrlTour.tourIdiomaTo.data);
                    ctrlTour.tourIdiomaTo.data.idIdioma = idiomaTmp;

                    if(! ctrlTour.tourIdiomaTo.data.status){
                        pNotifyView(ctrlTour.tourIdiomaTo.data.message, ctrlTour.tourIdiomaTo.data.typeStatus);
                    }
                    // El siguiente codigo para colocar el texto en el summernote, no se coloca de manera normal con el ng-model
                    $(".summernote").code(ctrlTour.tourIdiomaTo.data.descripcion);
                });
            }
        };

        ctrlTour.findImagesByTour = function () {
            startLoading(ctrlTour.msjLoading);
            setTimeout(function(){
                return TourService.findImagesTourByIdTour(ctrlTour.idTourGlobal).then(function () {
                    stopLoading();
                });
            }, 1000);
        };

        ctrlTour.setPrincipalImageTour = function(idTour, idImageTour){
            return TourService.setPrincipalImage(idTour, idImageTour).then(function(data){
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        ctrlTour.deleteImageTour = function(idImageTour){
            if(confirm(ctrlTour.msjDeleteImage)){
                return TourService.deleteImageTour(idImageTour).then(function(data){
                    pNotifyView(data.data.message, data.data.typeStatus);
                    if(data.data.status){
                        ctrlTour.findImagesByTour();
                    }
                });
            }
        };

        ctrlTour.saveTourLanguage = function(isValid){
            if(isValid){
                startLoading(ctrlTour.msjLoading);
                // Asignasiones
                ctrlTour.tourIdiomaTo.data.descripcion = $(".summernote").code();
                ctrlTour.tourIdiomaTo.data.idTour = ctrlTour.idTourGlobal;
                return TourService.saveTourLanguage(ctrlTour.tourIdiomaTo.data).then(function (data) {
                    stopLoading();
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        ctrlTour.configurateTour = function (tour) {
            ctrlTour.nameTourTitle = tour.descripcion;
            ctrlTour.idTourGlobal = tour.id;
            ctrlTour.configTour = true;
            ctrlTour.tourIdiomaTo.data = {
                idIdioma: IDIOMA_DEFAULT.toString()
            };
            $(".summernote").code('');
            ctrlTour.findImagesByTour();
            ctrlTour.findTourByIdAndLanguage();

            ctrlTour.findFechasCierreByTour();
        };

        ctrlTour.returnListTour = function(){
            ctrlTour.configTour = false;
        };

        ctrlTour.displayNewTour = function () {
            ctrlTour.cleanForm();
            ctrlTour.titleModal = ctrlTour.titleCreate;
            ctrlTour.isNewTour = true;
            ctrlTour.tour = {
                minimopersonas: 1
            };
            $("#modalTour").modal();
            setTimeout(function () {
                $("#description").trigger('focus');
            }, 1000);
        };

        ctrlTour.displayEditTour = function (tour) {
            ctrlTour.titleModal = ctrlTour.titleEdit;
            ctrlTour.tour = JSON.parse(JSON.stringify(tour));
            ctrlTour.isNewTour = false;
            $("#modalTour").modal();
            setTimeout(function () {
                $("#description").trigger('focus');
            }, 1000);
        };

        ctrlTour.saveFormTour = function (isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlTour.tour != undefined) {
                startLoading(ctrlTour.msjLoading);
                return TourService.createTour(ctrlTour.tour).then(function (data) {
                    stopLoading();
                    if (data.data.status) {
                        ctrlTour.findAllTours();
                        updateDataTable();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalTour").modal("hide");
                });
            }

        };

        ctrlTour.updateTour = function (isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlTour.tour != undefined) {
                startLoading(ctrlTour.msjLoading);
                return TourService.updateTour(ctrlTour.tour).then(function (data) {
                    stopLoading();
                    if (data.data.status) {
                        ctrlTour.findAllTours();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalTour").modal("hide");
                });
            }

        };

        ctrlTour.deleteTour = function (idTour) {
            if (confirm(ctrlTour.confirmDelete)) {
                return TourService.deleteTourById(idTour).then(function (data) {
                    if (data.data.status) {
                        ctrlTour.findAllTours();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        ctrlTour.promovedTour = function (tour) {
            if(tour.promovido == 1){
                return TourService.removePromovedTour(tour.id).then(function (data) {
                    tour.promovido = "0";
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }else {
                return TourService.promovedTour(tour.id).then(function (data) {
                    tour.promovido = "1";
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        ctrlTour.cleanForm = function () {
            $scope.formTour.$setPristine();
            $("#description").val("");
            $("#symbolo").val("");
            $("#tipoCambio").val("");
        };

        ctrlTour.findFechasCierreByTour = function () {
            return TourService.findFechasByTour(ctrlTour.idTourGlobal);
        };

        ctrlTour.createFechaCierre = function(){
            if(confirm('¿Desea guardar fecha de cierre?')){
                var idFecha = $("#idFechaHotel");
                var fecha = $("#daterangepicker").val();


                if(fecha.length == 0){
                    pNotifyView('Captura la fecha', 'info');
                    $("#daterangepicker").trigger('focus');
                }else{
                    var fechaArray = fecha.split('-');
                    return TourService.createOrUpdateFechaCierre(idFecha.val(), ctrlTour.idTourGlobal, $.trim(fechaArray[0]), $.trim(fechaArray[1])).then(function (data) {
                        ctrlTour.findFechasCierreByTour();
                        pNotifyView(data.data.message, data.data.typeStatus);
                        idFecha.val(0);
                    });
                }
            }
        };

        ctrlTour.setFechaEdit = function(fecha) {
            TourService.listaResetTour();
            if (fecha.classDanger == " ") {
                fecha.classDanger='danger';
            }

            var fechas = ctrlTour.getDate(fecha.fechaInicio, fecha.fechaFin);
            $('#daterangepicker').data('daterangepicker').setStartDate(fechas[0]);
            $('#daterangepicker').data('daterangepicker').setEndDate(fechas[1]);
            $("#idFechaHotel").val(fecha.id);

        };

        ctrlTour.getDate = function(fechaInicio, fechaFin){
            var fechaInicioParts = fechaInicio.split('-');
            var fechaFinParts = fechaFin.split('-');
            var fechas = [];
            fechas[0] = $.trim(fechaInicioParts[2])+'/'+ $.trim(fechaInicioParts[1])+'/'+ $.trim(fechaInicioParts[0]);
            fechas[1] = $.trim(fechaFinParts[2])+'/'+ $.trim(fechaFinParts[1])+'/'+ $.trim(fechaFinParts[0]);

            return fechas;
        };

        ctrlTour.deleteTourFechaCierre = function(idFechaCierre){
            if(confirm('¿Estas seguro de eliminar la fecha?')){
                return TourService.deleteFechaCierreTour(idFechaCierre).then(function (data) {
                    ctrlTour.findFechasCierreByTour();
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

    });

})();