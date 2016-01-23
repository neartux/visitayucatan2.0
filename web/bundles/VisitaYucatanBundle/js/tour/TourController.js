/**
 * Created by ricardo on 8/01/16.
 */
(function () {
    var app = angular.module('Tour', ['TourProvider']).config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('TourController', function($scope, $http, TourService) {
        var ctrlTour = this;
        ctrlTour.tour = undefined;
        ctrlTour.listTour = TourService.listTour;
        ctrlTour.listLanguage = TourService.listLanguage;
        ctrlTour.titleCreate = '';
        ctrlTour.titleEdit = '';
        ctrlTour.msjLoading = '';
        ctrlTour.titleModal = '';
        ctrlTour.isNewTour = true;
        ctrlTour.configTour = false;
        ctrlTour.idTourGlobal = 0;
        ctrlTour.idIdiomaGlobal = 1; //Todo cambiar si cambia en la base de datos, id

        ctrlTour.init = function (titleCreate, titleEdit, confirmDelete, msjLoading) {
            ctrlTour.titleCreate = titleCreate;
            ctrlTour.titleEdit = titleEdit;
            ctrlTour.msjLoading = msjLoading;
            ctrlTour.titleModal = titleCreate;
            ctrlTour.confirmDelete = confirmDelete;
            ctrlTour.findAllTours();
        };

        ctrlTour.findAllTours = function () {
            return TourService.findToursActives();
        };

        ctrlTour.findAllLanguages = function () {
            console.log("en el metodo para buscar los lenguajes");
            return TourService.findLanguagesActives();
        };

        ctrlTour.findTourByIdAndLanguage = function(){
            console.log("si funciona el select con onchange");
            return TourService.findTourByIdAndLanguaje(ctrlTour.idTourGlobal, ctrlTour.idIdiomaGlobal);
        };

        ctrlTour.configurateTour = function(tour){
            ctrlTour.findAllLanguages().then(function(){
                ctrlTour.findTourByIdAndLanguage();
            });
            ctrlTour.idTourGlobal = tour.id;
            ctrlTour.configTour = true;
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