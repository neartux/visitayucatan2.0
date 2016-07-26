/**
 * Created by ricardo on 15/02/16.
 */
(function () {
    var app = angular.module('Paquete', ['PaqueteProvider']).config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('PaqueteController', function ($scope, $http, PaqueteService) {
        var paquetesVM = this;
        paquetesVM.paquete = undefined;
        /*paquetesVM.listPaquetes = PaqueteService.listTour;
        paquetesVM.listLanguage = PaqueteService.listLanguage;
        paquetesVM.paqueteIdiomaTo = PaqueteService.tourIdiomaTO;
        paquetesVM.imagesPaquetes = PaqueteService.imagesTourList;*/
        paquetesVM.paqueteIdiomaTo = {};
        paquetesVM.titleCreate = '';
        paquetesVM.titleEdit = '';
        paquetesVM.msjLoading = '';
        paquetesVM.msjDeleteImage = '';
        paquetesVM.titleModal = '';
        paquetesVM.isNewPaquete = true;
        paquetesVM.configPaquete = false;
        paquetesVM.idPaqueteGlobal = 0;
        paquetesVM.nameTourTitl;

        paquetesVM.init = function (titleCreate, titleEdit, confirmDelete, msjLoading, msjDeleteImg) {
            paquetesVM.titleCreate = titleCreate;
            paquetesVM.titleEdit = titleEdit;
            paquetesVM.msjLoading = msjLoading;
            paquetesVM.titleModal = titleCreate;
            paquetesVM.confirmDelete = confirmDelete;
            paquetesVM.msjDeleteImage = msjDeleteImg;
            paquetesVM.initPaths();
            paquetesVM.findAllPaquetes();
            paquetesVM.findAllLanguages();
            //console.info("paquetes",paquetesVM);
            
        };

        paquetesVM.findAllPaquetes = function () {
            PaqueteService.findPaquetesList(paquetesVM.paths.findList).then(function(data){
                paquetesVM.listPaquetes=data;
            });
        };
        paquetesVM.initPaths = function(){
            paquetesVM.paths = {
                findList: angular.element(document.querySelector('#pathListPaquete')).context.value,
                create: angular.element(document.querySelector('#pathCreatePaquete')).context.value,
                deletePaquete:angular.element(document.querySelector('#pathDeletePaquete')).context.value,
                updatePaquete:angular.element(document.querySelector('#pathUpdatePaquete')).context.value,
                promovedPaquete:angular.element(document.querySelector('#pathPromovePaquete')).context.value,
                removePromovedPaquete:angular.element(document.querySelector('#pathRemovePromovedPaquete')).context.value,
                findListLanguage:angular.element(document.querySelector('#pathAllLenguages')).context.value,
                paqueteByIdLanguage:angular.element(document.querySelector('#pathPaqueteByIdioma')).context.value,
                savePaquteLanguage:angular.element(document.querySelector('#pathSavePaqueteLanguage')).context.value,
                paqueteAllImages:angular.element(document.querySelector('#pathPaqueteAllImages')).context.value,
                paqueteDeleteImage:angular.element(document.querySelector('#pathDeleteImagePaquete')).context.value,
                paquetePrincipalImage:angular.element(document.querySelector('#pathPaquetePrincipalImagen')).context.value,
                findAllHoteles:angular.element(document.querySelector("#pathFindAllHoteles")).context.value,
                findPaqueteByIdCombiHotel:angular.element(document.querySelector("#pathFindPaqueteByIdCombiHotel")).context.value,
                createPaqueteCombinacion:angular.element(document.querySelector('#pathCreatePaqueteCombinacion')).context.value,
                findAllPaquetesCombinacion:angular.element(document.querySelector('#pathListPaqueteCombinacion')).context.value,
                updatePaqueteCombinacion:angular.element(document.querySelector('#pathUpdatePaqueteCombinacion')).context.value,
                DeletePaqueteCombinacion:angular.element(document.querySelector('#pathDeletePaqueteCombinacion')).context.value
            };
        }
        paquetesVM.displayNewPaquete = function () {
            paquetesVM.cleanForm();
            paquetesVM.titleModal = paquetesVM.titleCreate;
            paquetesVM.isNewPaquete = true;
            //paquetesVM.newPaquete
            $("#modalPaquete").modal();
            setTimeout(function () {
                $("#description").trigger('focus');
            }, 1000);
        };
        paquetesVM.saveFormPaquete = function (isValid) {
            // check to make sure the form is completely valid

            if (isValid && paquetesVM.newPaquete != undefined) {
                startLoading(paquetesVM.msjLoading);
                return PaqueteService.createPaquete(paquetesVM.newPaquete,paquetesVM.paths.create).then(function (r) {
                    stopLoading();
                    if (r.data.status) {
                        paquetesVM.findAllPaquetes();
                        //updateDataTable();
                    }
                    pNotifyView(r.data.message, r.data.typeStatus);
                    $("#modalPaquete").modal("hide");
                });
            }

        };
        paquetesVM.deletePaquete = function (idPaquete) {
            if (confirm(paquetesVM.confirmDelete)) {
                return PaqueteService.deletePaqueteById(paquetesVM.paths.deletePaquete,idPaquete).then(function (data) {
                    if (data.data.status) {
                        paquetesVM.findAllPaquetes();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };
        paquetesVM.displayEditPaquete = function (paquete) {
            paquetesVM.titleModal = paquetesVM.titleEdit;
            paquetesVM.newPaquete = {
                id:paquete.id,descripcion:paquete.nombrepaquete,circuito:paquete.circuito,promovido:paquete.promovido
            };

            paquetesVM.isNewPaquete = false;
            $("#modalPaquete").modal();
            setTimeout(function () {
                $("#description").trigger('focus');
            }, 1000);
        };
        paquetesVM.updatePaquete = function (isValid) {
            // check to make sure the form is completely valid
            if (isValid && paquetesVM.newPaquete != undefined) {
                startLoading(paquetesVM.msjLoading);
                return PaqueteService.updatePaquete(paquetesVM.paths.updatePaquete,paquetesVM.newPaquete).then(function (data) {
                    stopLoading();
                    if (data.data.status) {
                        paquetesVM.findAllPaquetes();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalPaquete").modal("hide");
                });
            }

        };
        paquetesVM.cleanForm = function(){
            paquetesVM.newPaquete = {
                descripcion:'',
                circuito:''
            }
            $scope.formPaquete.$setPristine();
        };
        paquetesVM.configuratePaquete = function (paquete) {
            paquetesVM.namePaqueteTitle = paquete.nombrepaquete;
            paquetesVM.idPaqueteGlobal = paquete.id;
            paquetesVM.configPaquete =  true;
            paquetesVM.paqueteIdiomaTo.data = undefined;
            $("#descripcionLargaPaquete").code('');
            $("#itinerario").code('');
            $("#incluye").code('');
            paquetesVM.findImagesByPaquete();
            paquetesVM.findAllHoteles();
            paquetesVM.getPaqueteCombinacion();
            /*ctrlPaquete.nameTourTitle = tour.descripcion;
            ctrlPaquete.idTourGlobal = tour.id;
            ctrlPaquete.configTour = true;
            ctrlPaquete.tourIdiomaTo.data = undefined;
            $(".summernote").code('');
            ctrlPaquete.findImagesByTour();*/
        };
        paquetesVM.promovedPaquete = function (idPaquete) {
            return PaqueteService.promovedPaquete(paquetesVM.paths.promovedPaquete,idPaquete).then(function (data) {
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };
        paquetesVM.removePromovedPaquete = function (idPaquete) {
            return PaqueteService.removePromovedPaquete(paquetesVM.paths.removePromovedPaquete,idPaquete).then(function (data) {
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };
        paquetesVM.findAllLanguages = function () {
            PaqueteService.findAllLanguages(paquetesVM.paths.findListLanguage).then(function(data){
                paquetesVM.listLanguage = data;
            });
        };
        paquetesVM.returnListPaquete = function(){
            paquetesVM.configPaquete = false;
        };
        paquetesVM.findPaqueteByIdAndLanguage = function () {
            //console.info('paqueteIdiomaTo',paquetesVM.paqueteIdiomaTo.data);
            if(paquetesVM.paqueteIdiomaTo.data !== undefined){
                var idiomaTmp = paquetesVM.paqueteIdiomaTo.data.idIdioma;
                PaqueteService.findPaqueteByIdAndLanguaje(paquetesVM.paths.paqueteByIdLanguage,paquetesVM.idPaqueteGlobal, paquetesVM.paqueteIdiomaTo.data.idIdioma).then(function(data){
                    
                    console.info("return find paquete by idioma",data);
                    if(typeof(data.id)!=='null'){
                        paquetesVM.paqueteIdiomaTo.data=data;
                        paquetesVM.paqueteIdiomaTo.data.idIdioma = idiomaTmp;
                    }else{                        
                        paquetesVM.paqueteIdiomaTo.data=data;
                        paquetesVM.paqueteIdiomaTo.data.idIdioma = data.idIdioma.toString();
                    }
                    
                    //console.info("return find paquete by idioma",data);
                    
                    if(! paquetesVM.paqueteIdiomaTo.data.status){
                        pNotifyView(paquetesVM.paqueteIdiomaTo.data.message, paquetesVM.paqueteIdiomaTo.data.typeStatus);
                    }
                    // El siguiente codigo para colocar el texto en el summernote, no se coloca de manera normal con el ng-model
                    $("#descripcionLargaPaquete").code(paquetesVM.paqueteIdiomaTo.data.descripcionLarga);
                    $("#itinerario").code(paquetesVM.paqueteIdiomaTo.data.itinerario);
                    $("#incluye").code(paquetesVM.paqueteIdiomaTo.data.incluye);

                });
            }
        };

        paquetesVM.savePaqueteLanguage = function(isValid){
            if(isValid){
                startLoading(paquetesVM.msjLoading);
                // Asignasiones
                paquetesVM.paqueteIdiomaTo.data.descripcionCorta ='';
                paquetesVM.paqueteIdiomaTo.data.descripcionLarga = $("#descripcionLargaPaquete").code();
                paquetesVM.paqueteIdiomaTo.data.itinerario = $("#itinerario").code();
                paquetesVM.paqueteIdiomaTo.data.incluye = $("#incluye").code();
                paquetesVM.paqueteIdiomaTo.data.idPaquete = paquetesVM.idPaqueteGlobal;
                console.info('paquetesVM.paqueteIdiomaTo.data',paquetesVM.paqueteIdiomaTo.data)
                return PaqueteService.savePaqueteLanguage(paquetesVM.paths.savePaquteLanguage,paquetesVM.paqueteIdiomaTo.data).then(function (data) {
                    stopLoading();
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        paquetesVM.findImagesByPaquete = function () {
            setTimeout(function(){
                PaqueteService.findImagesPaqueteByIdPaquete(paquetesVM.paths.paqueteAllImages,paquetesVM.idPaqueteGlobal).then(function(data){
                    paquetesVM.imagesPaquetes = data;
                });
            },1000);
        };

        paquetesVM.setPrincipalImagePaquete = function(idPaquete, idImagePaquete){
            return PaqueteService.setPrincipalImage(paquetesVM.paths.paquetePrincipalImage,idPaquete, idImagePaquete).then(function(data){
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        paquetesVM.deleteImagePaquete = function(idImagePaquete){
            if(confirm(paquetesVM.msjDeleteImage)){
                return PaqueteService.deleteImagePaquete(paquetesVM.paths.paqueteDeleteImage,idImagePaquete).then(function(data){
                    pNotifyView(data.data.message, data.data.typeStatus);
                    if(data.data.status){
                        paquetes.findImagesByPaquete();
                    }
                });
            }
        };

        paquetesVM.findAllHoteles = function(){
            PaqueteService.findAllHoteles(paquetesVM.paths.findAllHoteles).then(function (data){
                paquetesVM.hoteles = data;
            })
        };

        paquetesVM.findPaqueteByIdCombiHotel = function(idPaquete,idHotel){
            var $json = {idPaquete:idPaquete,idHotel:idHotel};
            PaqueteService.findByIdCombiHotel(paquetesVM.paths.findPaqueteByIdCombiHotel,$json).then(function (data){
                console.info("combinacion tarifa",data);
            })
        };
        paquetesVM.displayNewPaqueteCombinacion = function () {
            paquetesVM.titleModal = 'Nuevo Paquete Combinación';
            paquetesVM.isNewPaqueteCombinacion = true;
            paquetesVM.cleanFormPaqueteCombinacion();
            //paquetesVM.newPaquete
            $("#modalPaqueteCombinacion").modal();
            setTimeout(function () {
                $("#hotel").trigger('focus');
            }, 1000);
        };
        paquetesVM.savePaqueteCombinacion = function(isValid,combinacion){
            
            //paquetesVM.newPaquete
            if (isValid && combinacion != undefined) {
                startLoading(paquetesVM.msjLoading);
                combinacion.idPaquete = paquetesVM.idPaqueteGlobal;
                PaqueteService.savePaqueteCombinacion(paquetesVM.paths.createPaqueteCombinacion,combinacion).then(function(data){
                    stopLoading();
                    pNotifyView(data.message, data.typeStatus);
                    $("#modalPaqueteCombinacion").modal("hide");
                });
            } 
        };
        paquetesVM.getPaqueteCombinacion = function(){
            PaqueteService.listPaqueteCombinacion(paquetesVM.paths.findAllPaquetesCombinacion,paquetesVM.idPaqueteGlobal).then(function(data){
                paquetesVM.listPaquetesCombinacion = data;
                console.info("listPaquetesCombinacion",data);
            });
        };
        paquetesVM.displayEditPaqueteCombinacion = function (paqueteCombinacion) {
            paquetesVM.titleModal = 'Editar Paquete Combinación';
            //console.info("displayEditPaquete",paqueteCombinacion);
            /*paquetesVM.newPaquete = {
                id:paquete.id,descripcion:paquete.nombrepaquete,circuito:paquete.circuito,promovido:paquete.promovido
            };*/
            paquetesVM.paqComHotel = paqueteCombinacion;
            paquetesVM.isNewPaqueteCombinacion = false;
            $("#modalPaqueteCombinacion").modal();
            setTimeout(function () {
                $("#hotel").trigger('focus');
            }, 1000);
        };
        paquetesVM.updatePaqueteCombinacion = function(isValid,paqueteCombinacion){
            if (isValid && paqueteCombinacion != undefined) {
                startLoading(paquetesVM.msjLoading);
                return PaqueteService.updatePaqueteCombinacion(paquetesVM.paths.updatePaqueteCombinacion,paqueteCombinacion).then(function (data) {
                    stopLoading();
                    if (data.data.status) {
                        paquetesVM.findAllPaquetes();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalPaqueteCombinacion").modal("hide");
                });
            }
        }
        paquetesVM.deletePaqueteCombinacion = function (idPaqueteCombinacion) {
            if (confirm('¿Seguro que desea eliminar el paquete combinación?')) {
                return PaqueteService.deletePaqueteCombinacionById(paquetesVM.paths.DeletePaqueteCombinacion,idPaqueteCombinacion).then(function (data) {
                    if (data.data.status) {
                        paquetesVM.getPaqueteCombinacion();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        paquetesVM.cleanFormPaqueteCombinacion = function(){
            paquetesVM.paqComHotel = undefined;
            $scope.formPaqueteCombinacion.$setPristine();
        };
        /*ctrlPaquete.saveTourLanguage = function(isValid){
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