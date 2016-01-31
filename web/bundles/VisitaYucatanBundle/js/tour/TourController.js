/**
 * Created by ricardo on 8/01/16.
 */
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
            setTimeout(function(){
                return TourService.findImagesTourByIdTour(ctrlTour.idTourGlobal);
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
            ctrlTour.tourIdiomaTo.data = undefined;
            $(".summernote").code('');
            ctrlTour.findImagesByTour();
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

        ctrlTour.promovedTour = function (idTour) {
            return TourService.promovedTour(idTour).then(function (data) {
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        ctrlTour.removePromovedTour = function (idTour) {
            return TourService.removePromovedTour(idTour).then(function (data) {
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        ctrlTour.cleanForm = function () {
            $("#description").val("");
            $("#symbolo").val("");
            $("#tipoCambio").val("");
        };

    });

})();