
(function (){
    var app = angular.module('Language', ['LanguageProvider']).config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('LanguageController', function ($scope, $http, LanguageService){
        var ctrlLanguage  = this;
        ctrlLanguage.language = undefined;
        ctrlLanguage.listLanguage = LanguageService.listLanguage;
        ctrlLanguage.titleCreate = '';
        ctrlLanguage.titleEdit = '';
        ctrlLanguage.msjLoading = '';
        ctrlLanguage.titleModal = '';
        ctrlLanguage.isNewLanguage = true;
        ctrlLanguage.language = {};
// Borre los parametros de init
        ctrlLanguage.init = function () {
            ctrlLanguage.titleCreate = 'Nuevo Idioma';
           ctrlLanguage.titleEdit = 'Actualizar Moneda';
            ctrlLanguage.msjLoading = 'Cargando';
            ctrlLanguage.titleModal = 'Crear Idioma';
            ctrlLanguage.confirmDelete = '¿Esta seguro de eliminar este idioma?';
            ctrlLanguage.findAllLanguage();
        };

        ctrlLanguage.findAllLanguage = function(){
            return LanguageService.findLanguageActives();
        };

        ctrlLanguage.displayNewLanguage = function(){
            ctrlLanguage.cleanForm();
            ctrlLanguage.titleModal = ctrlLanguage.titleCreate;
            ctrlLanguage.isNewLanguage = true;
            $("#modalLanguage").modal();
            setTimeout(function(){
                $("#description").trigger('focus');
            }, 1000);
        };

        ctrlLanguage.displayEditLanguage = function(language){
            ctrlLanguage.titleModal = ctrlLanguage.titleEdit;
            ctrlLanguage.language = JSON.parse(JSON.stringify(language));
            ctrlLanguage.isNewLanguage = false;
            $("#modalLanguage").modal();
            setTimeout(function(){
                $("#description").trigger('focus');
            }, 1000);
        };

        ctrlLanguage.saveFormLanguage = function(isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlLanguage.language != undefined) {
                startLoading(ctrlLanguage.msjLoading);
                console.info(JSON.stringify(ctrlLanguage.language));
                return LanguageService.createLanguage(ctrlLanguage.language).then(function(data){
                    $("#modalLanguage").modal("hide");
                    stopLoading();
                    if(data.data.status){
                        ctrlLanguage.language.id = data.data.id;
                        //ctrlLanguage.findAllLanguage();
                        LanguageService.addLanguage(ctrlLanguage.language);
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }

        };

        ctrlLanguage.updateLanguage = function(isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlLanguage.language != undefined) {
                startLoading(ctrlLanguage.msjLoading);
                return LanguageService.updateLanguage(ctrlLanguage.language).then(function(data){
                    $("#modalLanguage").modal("hide");
                    stopLoading();
                    if(data.data.status){
                        LanguageService.updateLanguageOfTheList(ctrlLanguage.language);
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }

        };

        ctrlLanguage.deleteLanguage = function(idLanguage){
            if(confirm(ctrlLanguage.confirmDelete)){
                return LanguageService.deleteLanguageById(idLanguage).then(function(data){
                    if(data.data.status){
                        LanguageService.deleteLanguage(idLanguage);
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

     

        ctrlLanguage.cleanForm = function(){
            $("#description").val("");
            $("#symbolo").val("");
            $("#tipoCambio").val("");
        }

    });

})();