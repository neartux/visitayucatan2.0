/**
 * Created by steysi on 7/12/16.
 */
(function () {
    var app = angular.module('CommonModule', ['shotsware-directives']);

    app.filter('groupBy', ['$parse', function ($parse) {
        return function (list, group_by, group_changed_attr) {

            var filtered = [];
            var prev_item = null;
            var group_changed = false;
            // this is a new field which is added to each item where we append "_CHANGED"
            // to indicate a field change in the list
            //var new_field = group_by + '_CHANGED'; //- JB 12/17/2013
            var new_field = 'group_by_CHANGED';
            if(group_changed_attr != undefined) new_field = group_changed_attr;  // we need this of we want to group different filtered versions of the same set of objects !

            // loop through each item in the list
            angular.forEach(list, function (item) {

                group_changed = false;

                // if not the first item
                if (prev_item !== null) {

                    // check if any of the group by field changed

                    //force group_by into Array
                    group_by = angular.isArray(group_by) ? group_by : [group_by];

                    //check each group by parameter
                    for (var i = 0, len = group_by.length; i < len; i++) {
                        if ($parse(group_by[i])(prev_item) !== $parse(group_by[i])(item)) {
                            group_changed = true;
                        }
                    }


                }// otherwise we have the first item in the list which is new
                else {
                    group_changed = true;
                }

                // if the group changed, then add a new field to the item
                // to indicate this
                if (group_changed) {
                    item[new_field] = true;
                } else {
                    item[new_field] = false;
                }

                filtered.push(item);
                prev_item = item;

            });

            return filtered;
        };
    }]);

    app.factory('CommonProvider', function ($http) {
        
        var service = {
            typeNotification : {
                ERROR: "error",
                WARNING: "notice",
                SUCCESS: "success",
                INFO: "info",
                DEFAULT: "info"
            }
        };
        service.countryList = {
            data: undefined     
        };
        service.stateList = {
            data: undefined
        };
        service.cityList = {
            data: undefined
        };
        service.contextPath = '';
        
        service.notification = function (title, text, type, icon) {
            PNotify.removeAll();
            new PNotify({
                title: title,
                text: text,
                type: type, //success, info, error, default
                icon: icon, //ti ti-check, ti ti-alert, ti ti-close, ti ti-info
                styling: 'fontawesome'
            });
        };
        
        service.notificationType = function(type, text){
            switch (type){
                case service.typeNotification.DEFAULT :
                    service.notification("Notice", text, service.typeNotification.DEFAULT, "ti ti-comment");
                    break;
                case service.typeNotification.ERROR :
                    service.notification("Error", text, service.typeNotification.ERROR, "ti ti-close");
                    break;
                case service.typeNotification.INFO :
                    service.notification("Info", text, service.typeNotification.INFO, "ti ti-info");
                    break;
                case service.typeNotification.SUCCESS :
                    service.notification("Success", text, service.typeNotification.SUCCESS, "ti ti-check");
                    break;
                case service.typeNotification.WARNING :
                    service.notification("Warning", text, service.typeNotification.WARNING, "ti ti-alert")
            }   
        };
        
        service.startLoading = function (msjLoading) {
            var msj = msjLoading;
            if(msjLoading == undefined || msjLoading == 'undefined'){
                msj = 'Loading';
            }
            HoldOn.open({
                theme: 'sk-rect',
                message: '<h4>' + msj + '</h4>'
            });
        };
        
        service.stopLoading = function () {
            HoldOn.close();    
        };
        
        service.loading = function (type) {
            if(type == "active"){
                service.startLoading();
            } else if(type == "close"){
                service.stopLoading();
            }
        };

        service.zoom = function () {
            $('.gal_lightbox').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true,
                    arrowMarkup: '<i title="%title%" class="ti ti-angle-%dir% mfp-nav"></i>'
                },
                image: {
                    cursor: null
                },
                callbacks: {
                    beforeOpen: function () {
                        $('body').addClass('modal-open');
                    },
                    beforeClose: function () {
                        $('body').removeClass('modal-open');
                    }
                },
                retina: {
                    ratio: 2 // can also be function that should retun this number
                }
            });
        };

        service.confirmSaveBootbox = function (msj, msjLoading, idButtonHidden) {
            bootbox.confirm('<h4>'+msj+'</h4>', function(result) {
                if(result){
                    service.loading("active");
                    $("#"+idButtonHidden).click();
                }
            });
        };
        
        service.removeClassInvidualForm = function (idForm) {
            $("#"+idForm).removeClass('has-error');
            $("."+idForm).hide();
        };

        service.configuraDatatable = function () {
            $('.data-table').dataTable({
                "language": {
                    "lengthMenu": "_MENU_"
                },
                "bSort": false,
                "order": []
            });
            $('.dataTables_filter input').attr('placeholder', 'Search...');


            //DOM Manipulation to move datatable elements integrate to panel
            $('#ctrlsDatatable').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
            $('#ctrlsDatatable').append("<i class='separator'></i>");
            $('#ctrlsDatatable').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");

            $('#footerDatatable').append($(".dataTable+.row"));
            $('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");
        };

        service.configureDatepicker = function (idDatePicker, formato, formaVisualizacion, fechasDisablesPosteriores, fechasDisablesAnteriores) {
            $("#"+idDatePicker).datepicker({
                todayHighlight: true,
                format: formato,
                autoclose: true,
                todayBtn: true,
                startView: formaVisualizacion, //2 comienza por los años, 1 por los meses, 0 por los dias
                endDate: fechasDisablesPosteriores, // "0" sirve para porner disable las fechas posteriores a la actual, o "+1" o el numero de dias que se desee
                startDate: fechasDisablesAnteriores // "0" sirve para porner disable las fechas anteriores a la actual, o "-1" o el numero de dias que se desee
            });
        };
        
        service.configureSelect2 = function (idSelect, value) {
            setTimeout(function () {
                $("#"+idSelect).val(value).trigger("change");
                $("#"+idSelect).select2("val", value).trigger("change");
            }, 100);
        };
        
        service.configurePopover = function () {
            $('[data-toggle="popover"]').popover({
                html : true,
                content: function() {
                    var content = $(this).attr("data-popover-content");
                    return $(content).children(".popover-body").html();
                },
                title: function() {
                    var title = $(this).attr("data-popover-content");
                    return $(title).children(".popover-heading").html();
                }
            });
        };

        service.getPatternValidation = function (validation) {
            switch (validation){
                case 'email': return  '/^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$/';
                case 'phone': return '';
                default : return validation;
            }
        };

        // ----------------------------------------------------------------------------------------------------------------------------------------------------

        service.findCountry = function () {
            var $q = $http.get(service.contextPath + '/join/findCountry');
            $q.then(function (data) {
                service.countryList.data = data.data;    
            });
            return $q;
        };

        service.findStateByCountry = function (idPais, callback) {
            var $q = $http.get(service.contextPath + '/join/findStateByCountry/' + idPais);
            $q.then(function (data) {
                service.stateList.data = data.data;
            });
            $q.success(function () {
                if(callback != undefined){
                    setTimeout(function () {
                        callback();
                    },10);
                }    
            });
            return $q;
        };

        service.findCityByState = function (idEstado, callback) {
            var $q = $http.get(service.contextPath + '/join/findCityByState/' + idEstado);
            $q.then(function (data) {
                service.cityList.data = data.data;
            });
            $q.success(function(data){
                if(callback != undefined){
                    setTimeout(function () {
                        callback(data);
                    },10);
                }
            });
            return $q;
        };
        
        service.existCountry = function (idPais) {
            return $http.get(service.contextPath + '/join/existCountry/' + idPais);
        };
        
        service.findSponsor = function (numeroDistribuidor) {
            return $http({
                method: 'GET',
                url: service.contextPath + '/join/findSponsor/' + numeroDistribuidor,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
        };
        
        return service;
    });
})();