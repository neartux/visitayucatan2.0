/**
 * Created by rafael on 20/03/16.
 */
(function (){
 	var app = angular.module('Peninsula', ['ngSanitize', 'ArticleProvider']).config(['$interpolateProvider',function($interpolateProvider) {
         $interpolateProvider.startSymbol('[[');
         $interpolateProvider.endSymbol(']]'); 		
 	}]);

    app.controller('PeninsulaController', function($scope, $http, ArticleService){
    	var ctrlPeninsula = this;
    	ctrlPeninsula.peninsula = undefined;
    	ctrlPeninsula.listPeninsula = ArticleService.listPeninsula;
    	ctrlPeninsula.configPeninsula = false;
        ctrlPeninsula.isNewPeninsula = true;
        ctrlPeninsula.listLanguage = ArticleService.listLanguage;
        ctrlPeninsula.peninsula = {};
        ctrlPeninsula.peninsulaIdiomaTo = ArticleService.peninsulaIdiomaTO;
        ctrlPeninsula.namePeninsulaTitle = 'Confif';
        ctrlPeninsula.confirmDeletePeninsula = '¿Esta seguro de eliminar esta Península?';
        ctrlPeninsula.idPeninsulaGlobal = 0;

    	ctrlPeninsula.init = function () {
    
            ctrlPeninsula.titleCreate = 'Nueva Península';
            ctrlPeninsula.titleEdit = 'Editar Península';
            ctrlPeninsula.msjLoading = 'Cargando';
            ctrlPeninsula.titleModal = 'Crear';
            ctrlPeninsula.confirmDelete = 'Se ha elimino con éxito';
            
            ctrlPeninsula.findAllPeninsulas();
            
            ctrlPeninsula.findAllLanguages();
            
        };

         ctrlPeninsula.findAllPeninsulas = function () {
            return ArticleService.findPeninsulasActives();
        };

        ctrlPeninsula.findAllLanguages = function () {
            return ArticleService.findLanguagesActives();
        };

        ctrlPeninsula.displayNewPeninsula = function(){
            ctrlPeninsula.peninsula = undefined;
        	ctrlPeninsula.cleanForm();
        	ctrlPeninsula.titleModal=ctrlPeninsula.titleCreate;
        	ctrlPeninsula.isNewPeninsula = true;
        	$("#modalPeninsula").modal();        	 
        	setTimeout(function(){
        	$("#description").trigger('focus');
        	}, 100);
           
        };

        ctrlPeninsula.saveFormPeninsula = function(isValid){
            if (isValid && ctrlPeninsula.peninsula != undefined) {
                startLoading(ctrlPeninsula.msjLoading);
              
                return ArticleService.createArticle(ctrlPeninsula.peninsula.descripcion).then(function(data){
                    $("#modalPeninsula").modal("hide");
                    stopLoading();

                    if (data.data.status) {
                        
                        ctrlPeninsula.peninsula.id = data.data.id;
                        ArticleService.addPeninsula(ctrlPeninsula.peninsula);

                    }
                    
                    pNotifyView(data.data.message, data.data.typeStatus);
                    
                });
            }
        };

        ctrlPeninsula.displayEditPeninsula = function(peninsula){
            ctrlPeninsula.titleModal = ctrlPeninsula.titleEdit;
            ctrlPeninsula.peninsula = JSON.parse(JSON.stringify(peninsula));
            ctrlPeninsula.isNewPeninsula = false;
            $("#modalPeninsula").modal();
            setTimeout(function(){
                $("#description").trigger('focus');
            }, 1000);
        };

        ctrlPeninsula.updatePeninsula = function(isValid){
            
            if (isValid && ctrlPeninsula.peninsula != undefined) {
               
                startLoading(ctrlPeninsula.msjLoading);
                
                return ArticleService.updatePeninsula(ctrlPeninsula.peninsula.id, ctrlPeninsula.peninsula.descripcion).then(
                   
                    function(data){
                       
                    $("#modalPeninsula").modal("hide");
                    stopLoading();
                    if (data.data.status) {
                        ArticleService.updatePeninsulaOfTheList(ctrlPeninsula.peninsula);
                        //para crear un nuevo registro
                       ctrlPeninsula.peninsula = undefined;
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        ctrlPeninsula.deletePeninsula = function(idPeninsula){
            if(confirm(ctrlPeninsula.confirmDeletePeninsula)){

                return ArticleService.deletePeninsulaById(idPeninsula).then(function(data){
                    if(data.data.status){
                        ArticleService.deletePeninsula(idPeninsula);
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };


        ctrlPeninsula.configuratePeninsula = function (peninsula) {
            ctrlPeninsula.peninsulaIdiomaTo.data = undefined;
            ctrlPeninsula.namePeninsulaTitle = peninsula.descripcion;
            ctrlPeninsula.idPeninsulaGlobal = peninsula.id;
            ctrlPeninsula.configPeninsula = true;
            
            $(".summernote").code('');
           
        };

        ctrlPeninsula.returnListPeninsula = function (){
            ctrlPeninsula.configPeninsula = false;
        };

        ctrlPeninsula.findPeninsulaByIdAndLanguage = function () {
            if(ctrlPeninsula.peninsulaIdiomaTo.data != undefined){
                var idiomaTmp = ctrlPeninsula.peninsulaIdiomaTo.data.idIdioma;
                console.info("llego al if");
                return ArticleService.findPeninsulaByIdAndLanguaje(ctrlPeninsula.idPeninsulaGlobal, ctrlPeninsula.peninsulaIdiomaTo.data.idIdioma).then(function(){
                    console.info("esta en return")
                    ctrlPeninsula.peninsulaIdiomaTo.data.idIdioma = idiomaTmp;
                    if(! ctrlPeninsula.peninsulaIdiomaTo.data.status){
                        pNotifyView(ctrlPeninsula.peninsulaIdiomaTo.data.message, ctrlPeninsula.peninsulaIdiomaTo.data.typeStatus);
                    }
                   
                    $(".summernote").code(ctrlPeninsula.peninsulaIdiomaTo.data.descripcion);
                });
            }
        };

        ctrlPeninsula.savePeninsulaLanguage = function (isValid){
          if (isValid) {
            startLoading(ctrlPeninsula.msjLoading);
            ctrlPeninsula.peninsulaIdiomaTo.data.descripcion = $(".summernote").code();
            ctrlPeninsula.peninsulaIdiomaTo.data.idPeninsula = ctrlPeninsula.idPeninsulaGlobal;
            if (ctrlPeninsula.peninsulaIdiomaTo.data.idarticuloidioma) {
                return ArticleService.updatePeninsulaLanguage(ctrlPeninsula.peninsulaIdiomaTo.data.idarticuloidioma, ctrlPeninsula.peninsulaIdiomaTo.data.nombre, ctrlPeninsula.peninsulaIdiomaTo.data.descripcion).then(function(data){
                    stopLoading();
                    pNotifyView(data.data.message, data.data.typeStatus);
                    ctrlPeninsula.peninsulaIdiomaTo.data = {
                        idIdioma: ""
                    };
                    $(".summernote").code('');
                });
            }else{
                return ArticleService.savePeninsulaLanguage(ctrlPeninsula.peninsulaIdiomaTo.data.descripcion,
                    //
                 ctrlPeninsula.peninsulaIdiomaTo.data.nombre, ctrlPeninsula.idPeninsulaGlobal, ctrlPeninsula.peninsulaIdiomaTo.data.idIdioma).then(function(data){
                    stopLoading();
                    pNotifyView(data.data.message, data.data.typeStatus);
                    ctrlPeninsula.peninsulaIdiomaTo.data = undefined;
                    $(".summernote").code('');
                });
            }

          }

        };

         ctrlPeninsula.cleanForm = function () {
            $("#description").val("");
            
        };
    });

 })();