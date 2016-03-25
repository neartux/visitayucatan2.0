/**
 * Created by ricardo on 15/02/16.
 */
(function () {
    var app = angular.module('Paquete', ['PaqueteProvider']).config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('PaqueteController', function ($scope, $http, PaqueteService) {
        var paquetes = this;
        paquetes.paquete = undefined;
        /*paquetes.listPaquetes = PaqueteService.listTour;
        paquetes.listLanguage = PaqueteService.listLanguage;
        paquetes.paqueteIdiomaTo = PaqueteService.tourIdiomaTO;
        paquetes.imagesPaquetes = PaqueteService.imagesTourList;*/
        paquetes.titleCreate = '';
        paquetes.titleEdit = '';
        paquetes.msjLoading = '';
        paquetes.msjDeleteImage = '';
        paquetes.titleModal = '';
        paquetes.isNewTour = true;
        paquetes.configTour = false;
        paquetes.idTourGlobal = 0;
        paquetes.nameTourTitl;

        paquetes.init = function (titleCreate, titleEdit, confirmDelete, msjLoading, msjDeleteImg) {
            paquetes.titleCreate = titleCreate;
            paquetes.titleEdit = titleEdit;
            paquetes.msjLoading = msjLoading;
            paquetes.titleModal = titleCreate;
            paquetes.confirmDelete = confirmDelete;
            paquetes.msjDeleteImage = msjDeleteImg;
            paquetes.initPaths();
            paquetes.findAllPaquetes();
            /*paquetes.findAllLanguages();*/
            console.info("paquetes",paquetes);
            
        };

        paquetes.findAllPaquetes = function () {
            PaqueteService.findPaquetesList(paquetes.paths.findList).then(function(data){
                paquetes.listPaquetes=data;
                console.info("paquete list", paquetes.listPaquetes);
            });
            console.info("paquetes paths in findAllPaquetes",paquetes);
        };
        paquetes.initPaths = function(){
            paquetes.paths = {
                findList: angular.element(document.querySelector('#pathListPaquete')).context.value
            };
            console.info("paths",paquetes.paths);
        }
        /*ctrlPaquete.findAllLanguages = function () {
            return PaqueteService.findLanguagesActives();
        };

        ctrlPaquete.findTourByIdAndLanguage = function () {
            if(ctrlPaquete.tourIdiomaTo.data != undefined){
                var idiomaTmp = ctrlPaquete.tourIdiomaTo.data.idIdioma;
                return PaqueteService.findTourByIdAndLanguaje(ctrlPaquete.idTourGlobal, ctrlPaquete.tourIdiomaTo.data.idIdioma).then(function(){
                    ctrlPaquete.tourIdiomaTo.data.idIdioma = idiomaTmp;
                    if(! ctrlPaquete.tourIdiomaTo.data.status){
                        pNotifyView(ctrlPaquete.tourIdiomaTo.data.message, ctrlPaquete.tourIdiomaTo.data.typeStatus);
                    }
                    // El siguiente codigo para colocar el texto en el summernote, no se coloca de manera normal con el ng-model
                    $(".summernote").code(ctrlPaquete.tourIdiomaTo.data.descripcion);
                });
            }
        };

        ctrlPaquete.findImagesByTour = function () {
            setTimeout(function(){
                return PaqueteService.findImagesTourByIdTour(ctrlPaquete.idTourGlobal);
            }, 1000);
        };

        ctrlPaquete.setPrincipalImageTour = function(idTour, idImageTour){
            return PaqueteService.setPrincipalImage(idTour, idImageTour).then(function(data){
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        ctrlPaquete.deleteImageTour = function(idImageTour){
            if(confirm(ctrlPaquete.msjDeleteImage)){
                return PaqueteService.deleteImageTour(idImageTour).then(function(data){
                    pNotifyView(data.data.message, data.data.typeStatus);
                    if(data.data.status){
                        ctrlPaquete.findImagesByTour();
                    }
                });
            }
        };

        ctrlPaquete.saveTourLanguage = function(isValid){
            if(isValid){
                startLoading(ctrlPaquete.msjLoading);
                // Asignasiones
                ctrlPaquete.tourIdiomaTo.data.descripcion = $(".summernote").code();
                ctrlPaquete.tourIdiomaTo.data.idTour = ctrlPaquete.idTourGlobal;
                return PaqueteService.saveTourLanguage(ctrlPaquete.tourIdiomaTo.data).then(function (data) {
                    stopLoading();
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        ctrlPaquete.configurateTour = function (tour) {
            ctrlPaquete.nameTourTitle = tour.descripcion;
            ctrlPaquete.idTourGlobal = tour.id;
            ctrlPaquete.configTour = true;
            ctrlPaquete.tourIdiomaTo.data = undefined;
            $(".summernote").code('');
            ctrlPaquete.findImagesByTour();
        };

        ctrlPaquete.returnListTour = function(){
            ctrlPaquete.configTour = false;
        };

        ctrlPaquete.displayNewTour = function () {
            ctrlPaquete.cleanForm();
            ctrlPaquete.titleModal = ctrlPaquete.titleCreate;
            ctrlPaquete.isNewTour = true;
            ctrlPaquete.tour = {
                minimopersonas: 1
            };
            $("#modalTour").modal();
            setTimeout(function () {
                $("#description").trigger('focus');
            }, 1000);
        };

        ctrlPaquete.displayEditTour = function (tour) {
            ctrlPaquete.titleModal = ctrlPaquete.titleEdit;
            ctrlPaquete.tour = JSON.parse(JSON.stringify(tour));
            ctrlPaquete.isNewTour = false;
            $("#modalTour").modal();
            setTimeout(function () {
                $("#description").trigger('focus');
            }, 1000);
        };

        ctrlPaquete.saveFormTour = function (isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlPaquete.tour != undefined) {
                startLoading(ctrlPaquete.msjLoading);
                return PaqueteService.createTour(ctrlPaquete.tour).then(function (data) {
                    stopLoading();
                    if (data.data.status) {
                        ctrlPaquete.findAllTours();
                        updateDataTable();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalTour").modal("hide");
                });
            }

        };

        ctrlPaquete.updateTour = function (isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlPaquete.tour != undefined) {
                startLoading(ctrlPaquete.msjLoading);
                return PaqueteService.updateTour(ctrlPaquete.tour).then(function (data) {
                    stopLoading();
                    if (data.data.status) {
                        ctrlPaquete.findAllTours();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalTour").modal("hide");
                });
            }

        };

        ctrlPaquete.deleteTour = function (idTour) {
            if (confirm(ctrlPaquete.confirmDelete)) {
                return PaqueteService.deleteTourById(idTour).then(function (data) {
                    if (data.data.status) {
                        ctrlPaquete.findAllTours();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        ctrlPaquete.promovedTour = function (idTour) {
            return PaqueteService.promovedTour(idTour).then(function (data) {
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        ctrlPaquete.removePromovedTour = function (idTour) {
            return PaqueteService.removePromovedTour(idTour).then(function (data) {
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        ctrlPaquete.cleanForm = function () {
            $("#description").val("");
            $("#symbolo").val("");
            $("#tipoCambio").val("");
        };*/

    });

})();