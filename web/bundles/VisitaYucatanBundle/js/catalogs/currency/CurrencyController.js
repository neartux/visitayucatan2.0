/**
 * Created by ricardo on 25/12/15.
 */
(function (){
    var app = angular.module('Currency', ['CurrencyProvider']).config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('CurrencyController', function ($scope, $http, CurrencyService){
        var ctrlCurrency  = this;
        ctrlCurrency.currency = undefined;
        ctrlCurrency.listCurrency = CurrencyService.listCurrency;
        ctrlCurrency.titleCreate = '';
        ctrlCurrency.titleEdit = '';
        ctrlCurrency.msjLoading = '';
        ctrlCurrency.titleModal = '';
        ctrlCurrency.isNewCurrency = true;

        ctrlCurrency.init = function (titleCreate, titleEdit, msjLoading, confirmDelete) {
            ctrlCurrency.titleCreate = titleCreate;
            ctrlCurrency.titleEdit = titleEdit;
            ctrlCurrency.msjLoading = msjLoading;
            ctrlCurrency.titleModal = titleCreate;
            ctrlCurrency.confirmDelete = confirmDelete;
            ctrlCurrency.findAllCurrency();
        };

        ctrlCurrency.findAllCurrency = function(){
            return CurrencyService.findCurrencyActives();
        };

        ctrlCurrency.displayNewCurrency = function(){
            ctrlCurrency.cleanForm();
            ctrlCurrency.titleModal = ctrlCurrency.titleCreate;
            ctrlCurrency.isNewCurrency = true;
            $("#modalCurrency").modal();
            setTimeout(function(){
                $("#description").trigger('focus');
            }, 1000);
        };

        ctrlCurrency.displayEditCurrency = function(currency){
            ctrlCurrency.titleModal = ctrlCurrency.titleEdit;
            ctrlCurrency.currency = JSON.parse(JSON.stringify(currency));
            ctrlCurrency.isNewCurrency = false;
            $("#modalCurrency").modal();
            setTimeout(function(){
                $("#description").trigger('focus');
            }, 1000);
        };

        ctrlCurrency.saveFormCurrency = function(isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlCurrency.currency != undefined) {
                startLoading(ctrlCurrency.msjLoading);
                return CurrencyService.createCurrency(ctrlCurrency.currency).then(function(data){
                    stopLoading();
                    if(data.data.status){
                        ctrlCurrency.findAllCurrency();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalCurrency").modal("hide");
                });
            }

        };

        ctrlCurrency.updateCurrency = function(isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlCurrency.currency != undefined) {
                startLoading(ctrlCurrency.msjLoading);
                return CurrencyService.updateCurrency(ctrlCurrency.currency).then(function(data){
                    stopLoading();
                    if(data.data.status){
                        ctrlCurrency.findAllCurrency();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalCurrency").modal("hide");
                });
            }

        };

        ctrlCurrency.deleteCurrency = function(idCurrency){
            if(confirm(ctrlCurrency.confirmDelete)){
                return CurrencyService.deleteCurrencyById(idCurrency).then(function(data){
                    if(data.data.status){
                        ctrlCurrency.findAllCurrency();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        ctrlCurrency.cleanForm = function(){
            $("#description").val("");
            $("#symbolo").val("");
            $("#tipoCambio").val("");
        }

    });

})();