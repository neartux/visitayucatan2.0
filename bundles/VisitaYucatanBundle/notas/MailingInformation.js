/**
 * Created by steysi on 7/12/16.
 */
(function () {
    var app = angular.module('Join', ['CommonModule']);

    app.controller('MailingInformationController', ['$scope', '$http', 'CommonProvider', function ($scope, $http, commonProvider) {

        var ctrlMi = this;
        ctrlMi.countryList = commonProvider.countryList;
        ctrlMi.stateList = commonProvider.stateList;
        ctrlMi.cityList = commonProvider.cityList;
        ctrlMi.paisSelect = "";
        ctrlMi.estadoSelect = "";
        ctrlMi.clean = false;

        ctrlMi.initMi = function () {
            commonProvider.configureDatepicker("datepickerFechaNacimiento", $("#datePattern").val(),2,"0d",undefined);
            setTimeout(function(){
                if($("#idPaisSelect").val() != "" || $("#idPaisSelect").val() != undefined){
                    ctrlMi.setEstados($("#idPaisSelect").val(), $("#idEstadoSelect").val(), $("#idCiudadSelect").val());
                    ctrlMi.verificaPaisComunidad();
                    $("#nombreDistribuidor").text($("#patrocinadorFind").val());
                }
            }, 10);
        };

        ctrlMi.findPaises = function () {
            return commonProvider.findCountry();
        };

        ctrlMi.findEstadosByPais = function (callback, idPaisSelect) {
            if(idPaisSelect != undefined){
                ctrlMi.paisSelect = idPaisSelect;
            }
            if(ctrlMi.paisSelect != ""){
                commonProvider.findStateByCountry(ctrlMi.paisSelect, function () {
                    commonProvider.configureSelect2("estado", "");
                    commonProvider.configureSelect2("ciudad", "");
                    if(callback != undefined) {
                        callback();
                    }
                });
            }
        };

        ctrlMi.findCiudadesByEstadoInit = function (idEstadoSelect, callback) {
            if(idEstadoSelect != undefined){
                ctrlMi.estadoSelect = idEstadoSelect;
            }
            if(ctrlMi.estadoSelect != ""){
                commonProvider.findCityByState(ctrlMi.estadoSelect, function () {
                if(callback != undefined) {
                    callback();
                }
                });
            }
        };

        ctrlMi.findCiudadesByEstado = function (idEstadoSelect, callback) {
            if(idEstadoSelect != undefined){
                ctrlMi.estadoSelect = idEstadoSelect;
            }
            if(ctrlMi.estadoSelect != ""){
                if($("#idCiudadSelect").val() == "" || $("#idCiudadSelect").val() == undefined){
                    $("#idCiudadSelect").val("");
                    ctrlMi.ciudadSelect = "";
                    commonProvider.findCityByState(ctrlMi.estadoSelect, function () {
                        if(callback != undefined) {
                            callback();
                        }
                    });

                }
            }
        };
        
        ctrlMi.cleanCity = function () {
            if(ctrlMi.clean){
                $("#idCiudadSelect").val("");
            }
            ctrlMi.clean = true;
        };
        
        ctrlMi.setEstados = function (idPaisSelect, idEstadoSelect, idCiudadSelect) {
            ctrlMi.findEstadosByPais(function () {
                if(idEstadoSelect != "" || idEstadoSelect != undefined){
                    ctrlMi.setCiudades(idEstadoSelect, idCiudadSelect);
                    commonProvider.configureSelect2("estado", idEstadoSelect);
                }
            }, idPaisSelect)
        };

        ctrlMi.setCiudades = function (idEstadoSelect, idCiudadSelect) {
            ctrlMi.findCiudadesByEstadoInit(idEstadoSelect, function () {
                if(idCiudadSelect != "" || idCiudadSelect != undefined){
                    commonProvider.configureSelect2("ciudad", idCiudadSelect);
                    setTimeout(function(){
                        $scope.$apply();
                    }, 100);
                }
            })
        };

        ctrlMi.verificaPaisComunidad = function () {
            $(".panelRoi").hide();
            $(".perteneceARoySpace").hide();
            $(".claveRoiSpace").hide();
            var idPais = ctrlMi.paisSelect;
            if(idPais != "") {
                ctrlMi.existePais(idPais);
            }
        };

        ctrlMi.iniciaSelects = function () {
            $('#estado').select2('val', '');
            $('#ciudad').select2('val', '');
        };

        ctrlMi.verificaClaveRoi = function (show) {
            if(show) {
                $(".claveRoiSpace").show();
            } else {
                $(".claveRoiSpace").hide();
                $("#claveRoi").val('');
            }
        };

        ctrlMi.existePais = function (idPais) {
            var $q = commonProvider.existCountry(idPais);
            $q.then(function (data) {
                if(data.data == true){
                    $(".panelRoi").show();
                    $(".perteneceARoySpace").show();
                    if($("#siRoy").is(":checked")) {
                        ctrlMi.verificaClaveRoi(true);
                    }
                }else{
                    $(".panelRoi").hide();
                    $(".perteneceARoySpace").hide();
                    ctrlMi.verificaClaveRoi(false);
                }
            });
            $q.error(function (data, status, er) {
                commonProvider.notificationType(commonProvider.typeNotification.ERROR, er);
            })
        };

        ctrlMi.getNameDistribuidor = function (){
            if(ctrlMi.patrocinadorWrite != null && ctrlMi.patrocinadorWrite != undefined && ctrlMi.patrocinadorWrite != ""){
                var $q = commonProvider.findSponsor(ctrlMi.patrocinadorWrite);
                $q.then(function (data) {
                    $("#nombreDistribuidor").text(data.data);
                    $("#patrocinadorFind").val(data.data);
                });
                $q.error(function (data, status, er) {
                    commonProvider.notificationType(commonProvider.typeNotification.ERROR, er);
                })
            }
        };


    }]);
})();
