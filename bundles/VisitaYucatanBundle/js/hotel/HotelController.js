/**
 * Controller para app de hoteles
 * Created by ricardo on 3/02/16.
 */
(function () {
    var app = angular.module('Hotel', ['HotelProvider']).config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('HotelController', function ($scope, $http, HotelService) {
        var ctrlHotel = this;
        ctrlHotel.hotelTO = undefined;
        ctrlHotel.listHotel = HotelService.listHotel;
        ctrlHotel.listLanguage = HotelService.listLanguage;
        ctrlHotel.hotelIdiomaTo = HotelService.hotelIdiomaTO;
        ctrlHotel.imagesHotel = HotelService.imagesHotelList;
        ctrlHotel.listDestino = HotelService.listDestino;
        ctrlHotel.contactHotelList = HotelService.contactHotelList;
        ctrlHotel.listaFechas = HotelService.listaFechas;
        ctrlHotel.listaContratos = HotelService.listaContratos;
        ctrlHotel.listaPlanes = HotelService.listaPlanes;
        ctrlHotel.listaHabitacionesHotel = HotelService.listaHabitacionesHotel;
        ctrlHotel.hotelHabitacionIdiomaTO = HotelService.hotelHabitacionIdiomaTO;
        ctrlHotel.listaTarifasHotel = HotelService.listaTarifasHotel;
        ctrlHotel.titleCreate = '';
        ctrlHotel.titleEdit = '';
        ctrlHotel.msjLoading = '';
        ctrlHotel.msjDeleteImage = '';
        ctrlHotel.titleModal = '';
        ctrlHotel.isNewHotel = true;
        ctrlHotel.configHotel = false;
        ctrlHotel.idHotelGlobal = 0;
        ctrlHotel.nameHotelTitle = '';
        ctrlHotel.isNewContact = false;
        ctrlHotel.hotelContacto = {};
        ctrlHotel.hotelContract = undefined;
        ctrlHotel.isNewContract = false;
        ctrlHotel.displayFormContract = false;
        ctrlHotel.displayFormHabitacion = false;
        ctrlHotel.isNewHabitacion = false;
        ctrlHotel.hotelHabitacionTO = {};
        ctrlHotel.showIdiomaHabitacionBolean = false;
        ctrlHotel.showIdiomaHabitacionDescripcion = false;

        ctrlHotel.init = function () {
            ctrlHotel.titleCreate = 'Nuevo Hotel';
            ctrlHotel.titleEdit = 'Editar Hotel';
            ctrlHotel.msjLoading = 'Cargando';
            ctrlHotel.titleModal = 'Nuevo Hotel';
            ctrlHotel.confirmDelete = '¿ Seguro que desea eliminar el hotel ?';
            ctrlHotel.msjDeleteImage = '¿ Desea eliminar la imagen ? ';
            ctrlHotel.hotelTO = {
                estrellas: '1'
            };
            ctrlHotel.findAllHotels();
            ctrlHotel.findAllLanguages();
            HotelService.findDestinos();
            HotelService.planesAlimentos();
        };

        ctrlHotel.findAllHotels = function () {
            return HotelService.findHotelsActives();
        };

        ctrlHotel.findAllHotelContracts = function () {
            return HotelService.findListContracts(ctrlHotel.idHotelGlobal);
        };

        ctrlHotel.findContractById = function () {
            if(ctrlHotel.hotelContratoTO.data.idContract == ''){
                ctrlHotel.displayFormContract = false;
            }else{
                return HotelService.findContractById(ctrlHotel.hotelContratoTO.data.idContract).then(function(data){
                    $(".datepickerInicio").datepicker("update", data.data.fechaInicio);
                    $(".datepickerFin").datepicker("update", data.data.fechaFin);
                    ctrlHotel.hotelContract = data.data;
                    ctrlHotel.isNewContract = false;
                    ctrlHotel.displayFormContract = true;
                });
            }
        };

        ctrlHotel.findHabitacionById = function () {
            if(ctrlHotel.hotelHabitacionTO.id == ''){
                ctrlHotel.displayFormHabitacion = false;
            }else{
                return HotelService.findHabitacionById(ctrlHotel.hotelHabitacionTO.id).then(function(data){
                    ctrlHotel.hotelHabitacionTO = data.data;
                    $(".summernoteHab").code(data.data.descripcion);
                    ctrlHotel.isNewHabitacion = false;
                    ctrlHotel.displayFormHabitacion = true;
                });
            }
        };

        ctrlHotel.displayNewContract = function(){
            cleanForm('field-contract-hotel');
            $('#selectContract option:eq(0)').prop('selected', true);
            ctrlHotel.displayFormContract = true;
            ctrlHotel.isNewContract = true;
            ctrlHotel.hotelContract = {
                idHotelPlan: "0"
            };
        };

        ctrlHotel.displayNewHabitacion = function(){
            cleanForm('field-habitacion-hotel');
            $('#selectHabitaciones option:eq(0)').prop('selected', true);
            ctrlHotel.displayFormHabitacion = true;
            ctrlHotel.isNewHabitacion = true;
        };

        ctrlHotel.findPlanAlimentos = function () {
            return HotelService.planesAlimentos();
        };

        ctrlHotel.findContactsHotel = function (idHotel) {
            ctrlHotel.hotelContacto = {};
            ctrlHotel.idHotelGlobal = idHotel;
            return HotelService.findContactsHotel(idHotel).then(function(){
                ctrlHotel.isNewContact = false;
                $("#modalHotelContacts").modal();
            });
        };

        ctrlHotel.findHabitacionesHotel = function () {
            ctrlHotel.hotelHabitacion = {};
            return HotelService.findHabitacionesHotel(ctrlHotel.idHotelGlobal);
        };

        ctrlHotel.findFechasCierreByHotel = function () {
            return HotelService.findFechasByHotel(ctrlHotel.idHotelGlobal);
        };


        ctrlHotel.createContactHotel = function () {
            if(ctrlHotel.validateContactHotel()){
                ctrlHotel.hotelContacto.idHotel = ctrlHotel.idHotelGlobal;
                return HotelService.createContactHotel(ctrlHotel.hotelContacto).then(function(data){
                    pNotifyView(data.data.message, data.data.typeStatus);
                    if(data.data.status){
                        HotelService.findContactsHotel(ctrlHotel.hotelContacto.idHotel);
                        ctrlHotel.isNewContact = false;
                        ctrlHotel.cleanFormContact();
                    }
                });
            }
        };

        ctrlHotel.deleteContactHotel = function(idContact){
            if(confirm('¿Seguro que desea eliminar el contacto?')){
                return HotelService.deleteContactHotel(idContact).then(function(data){
                    HotelService.findContactsHotel(ctrlHotel.idHotelGlobal);
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        ctrlHotel.validateContactHotel = function() {
            var nameContact = $("#nameContact");
            var lastNameContact = $("#lastNameContac");
            var emailContact = $("#emailContact");
            if(! $.trim(nameContact.val()).length){
                pNotifyView('Captura Nombre de Contacto', 'info');
                nameContact.trigger('focus');
                return false;
            }else if(! $.trim(lastNameContact.val()).length){
                pNotifyView('Captura Apellidos de Contacto', 'info');
                lastNameContact.trigger('focus');
                return false;
            }else if(! $.trim(emailContact.val()).length){
                pNotifyView('Captura Correo de Contacto', 'info');
                emailContact.trigger('focus');
                return false;
            }
            return true;
        };

        ctrlHotel.cleanFormContact = function() {
            $("#nameContact").val();
            $("#lastNameContac").val();
            $("#emailContact").val();
        };

        ctrlHotel.findAllLanguages = function () {
            return HotelService.findLanguagesActives();
        };

        ctrlHotel.findHotelByIdAndLanguage = function () {
            if(ctrlHotel.hotelIdiomaTo.data != undefined){
                var idiomaTmp = ctrlHotel.hotelIdiomaTo.data.idIdioma;
                return HotelService.findHotelByIdAndLanguaje(ctrlHotel.idHotelGlobal, ctrlHotel.hotelIdiomaTo.data.idIdioma).then(function(){
                    ctrlHotel.hotelIdiomaTo.data.idIdioma = idiomaTmp;
                    if(! ctrlHotel.hotelIdiomaTo.data.status){
                        pNotifyView(ctrlHotel.hotelIdiomaTo.data.message, ctrlHotel.hotelIdiomaTo.data.typeStatus);
                    }
                    // El siguiente codigo para colocar el texto en el summernote, no se coloca de manera normal con el ng-model
                    $(".summernote").code(ctrlHotel.hotelIdiomaTo.data.descripcion);
                });
            }
        };

        ctrlHotel.findImagesByHotel = function () {
            setTimeout(function(){
                return HotelService.findImagesHotelByIdHotel(ctrlHotel.idHotelGlobal);
            }, 1000);
        };

        ctrlHotel.setPrincipalImageHotel = function(idHotel, idImageHotel){
            return HotelService.setPrincipalImage(idHotel, idImageHotel).then(function(data){
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        ctrlHotel.deleteImageHotel = function(idImageHotel){
            if(confirm(ctrlHotel.msjDeleteImage)){
                return HotelService.deleteImageHotel(idImageHotel).then(function(data){
                    pNotifyView(data.data.message, data.data.typeStatus);
                    if(data.data.status){
                        ctrlHotel.findImagesByHotel();
                    }
                });
            }
        };

        ctrlHotel.saveHotelLanguage = function(isValid){
            if(isValid){
                startLoading(ctrlHotel.msjLoading);
                // Asignasiones
                ctrlHotel.hotelIdiomaTo.data.descripcion = $(".summernote").code();
                ctrlHotel.hotelIdiomaTo.data.idHotel = ctrlHotel.idHotelGlobal;
                return HotelService.saveHotelLanguage(ctrlHotel.hotelIdiomaTo.data).then(function (data) {
                    stopLoading();
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        ctrlHotel.configurateHotel = function (hotel) {
            ctrlHotel.nameHotelTitle = hotel.descripcion;
            ctrlHotel.idHotelGlobal = hotel.id;
            ctrlHotel.hotelIdiomaTo.data = undefined;
            ctrlHotel.configHotel = true;
            $(".summernote").code('');
            ctrlHotel.findImagesByHotel();
        };

        ctrlHotel.returnListTour = function(){
            ctrlHotel.configHotel = false;
        };

        ctrlHotel.displayNewHotel = function () {
            ctrlHotel.cleanForm();
            ctrlHotel.titleModal = ctrlHotel.titleCreate;
            ctrlHotel.isNewHotel = true;
            $("#modalHotel").modal();
            setTimeout(function () {
                $("#destinoHotel").trigger('focus');
            }, 1000);
        };

        ctrlHotel.displayEditHotel = function (hotel) {
            ctrlHotel.titleModal = ctrlHotel.titleEdit;
            ctrlHotel.hotelTO = JSON.parse(JSON.stringify(hotel));
            ctrlHotel.isNewHotel = false;
            $("#modalHotel").modal();
            setTimeout(function () {
                $("#destinoHotel").trigger('focus');
            }, 1000);
        };

        ctrlHotel.saveFormHotel = function (isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlHotel.hotelTO != undefined) {
                startLoading(ctrlHotel.msjLoading);
                return HotelService.createHotel(ctrlHotel.hotelTO).then(function (data) {
                    stopLoading();
                    if (data.data.status) {
                        ctrlHotel.findAllHotels();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalHotel").modal("hide");
                });
            }

        };

        ctrlHotel.updateHotel = function (isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlHotel.hotelTO != undefined) {
                startLoading(ctrlHotel.msjLoading);
                return HotelService.updateHotel(ctrlHotel.hotelTO).then(function (data) {
                    stopLoading();
                    if (data.data.status) {
                        ctrlHotel.findAllHotels();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalHotel").modal("hide");
                });
            }

        };

        ctrlHotel.deleteHotel = function (idHotel) {
            if (confirm(ctrlHotel.confirmDelete)) {
                return HotelService.deleteHotelById(idHotel).then(function (data) {
                    if (data.data.status) {
                        ctrlHotel.findAllHotels();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        ctrlHotel.promovedHotel = function (idHotel) {
            return HotelService.promovedHotel(idHotel).then(function (data) {
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        ctrlHotel.removePromovedHotel = function (idHotel) {
            return HotelService.removePromovedHotel(idHotel).then(function (data) {
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        ctrlHotel.cleanForm = function () {
            ctrlHotel.hotelTO = undefined;
            ctrlHotel.hotelTO = {
                estrellas: '1'
            };
        };

        ctrlHotel.deleteHotelFechaCierre = function(idFechaCierre){
            if(confirm('¿Estas seguro de eliminar la fecha?')){
                return HotelService.deleteHotelFechaCierre(idFechaCierre).then(function (data) {
                    ctrlHotel.findFechasCierreByHotel();
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        ctrlHotel.createFechaCierre = function(){
            var idFecha = $("#idFechaHotel");
            var fecha = $("#daterangepicker").val();
            if(fecha.length == 0){
                pNotifyView('Captura la fecha', 'info');
                $("#daterangepicker").trigger('focus');
            }else{
                var fechaArray = fecha.split('-');
                return HotelService.createOrUpdateFechaCierre(idFecha.val(), ctrlHotel.idHotelGlobal, $.trim(fechaArray[0]), $.trim(fechaArray[1])).then(function (data) {
                    ctrlHotel.findFechasCierreByHotel();
                    pNotifyView(data.data.message, data.data.typeStatus);
                    idFecha.val(0);
                });
            }
        };

        ctrlHotel.setFechaEdit = function(fecha) {
            fecha.classDanger = 'danger';
            var fechas = ctrlHotel.getDate(fecha.fechainicio, fecha.fechafin);
            $('#daterangepicker').data('daterangepicker').setStartDate(fechas[0]);
            $('#daterangepicker').data('daterangepicker').setEndDate(fechas[1]);
            $("#idFechaHotel").val(fecha.id);
        };

        ctrlHotel.createContractHotel = function(){
            if(validateContractHotelForm()){
                if(ctrlHotel.isNewContract){
                    ctrlHotel.hotelContract.idHotel = ctrlHotel.idHotelGlobal;
                    return HotelService.createContract(ctrlHotel.hotelContract).then(function(data){
                        if(data.data.status){
                            ctrlHotel.findAllHotelContracts();
                            ctrlHotel.displayFormContract = false;
                        }
                        pNotifyView(data.data.message, data.data.typeStatus);
                    });
                }else{
                    return HotelService.updateContract(ctrlHotel.hotelContract).then(function(data){
                        if(data.data.status){
                            ctrlHotel.findAllHotelContracts();
                            ctrlHotel.displayFormContract = false;
                        }
                        pNotifyView(data.data.message, data.data.typeStatus);
                    });
                }
            }
        };

        ctrlHotel.createHabitacionHotel = function(){
            if(validateHabitacionHotelForm()){
                ctrlHotel.hotelHabitacionTO.descripcion = $(".summernoteHab").code();
                if(ctrlHotel.isNewHabitacion){
                    ctrlHotel.hotelHabitacionTO.idHotel = ctrlHotel.idHotelGlobal;
                    return HotelService.createHabitacion(ctrlHotel.hotelHabitacionTO).then(function(data){
                        if(data.data.status){
                            ctrlHotel.findHabitacionesHotel();
                            ctrlHotel.displayFormHabitacion = false;
                        }
                        pNotifyView(data.data.message, data.data.typeStatus);
                    });
                }else{
                    return HotelService.updateHabitacion(ctrlHotel.hotelHabitacionTO).then(function(data){
                        if(data.data.status){
                            ctrlHotel.findHabitacionesHotel();
                            ctrlHotel.displayFormHabitacion = false;
                        }
                        pNotifyView(data.data.message, data.data.typeStatus);
                    });
                }
            }
        };

        ctrlHotel.showIdiomaHabitacion = function(){
            if(ctrlHotel.hotelHabitacionIdiomaTO.id != ""){
                ctrlHotel.hotelHabitacionIdiomaTO.idIdioma = "";
                ctrlHotel.showIdiomaHabitacionBolean = true;
            }else{
                ctrlHotel.showIdiomaHabitacionBolean = false;
            }
            ctrlHotel.showIdiomaHabitacionDescripcion = false;
        };

        ctrlHotel.findHabitacionIdioma = function(){
            if(ctrlHotel.hotelHabitacionIdiomaTO.idIdioma != "" && ctrlHotel.hotelHabitacionIdiomaTO.idIdioma != undefined && ctrlHotel.hotelHabitacionIdiomaTO.id != ""){
                return HotelService.findHabitacionByIdAndIdioma(ctrlHotel.hotelHabitacionIdiomaTO.id, ctrlHotel.hotelHabitacionIdiomaTO.idIdioma).then(function(data){
                    ctrlHotel.hotelHabitacionIdiomaTO = data.data;
                    $("#descripcionHotelHabitacionIdioma").code(data.data.descripcion);
                    ctrlHotel.showIdiomaHabitacionDescripcion = true;
                });
            }else{
                ctrlHotel.showIdiomaHabitacionDescripcion = false;
            }
        };

        ctrlHotel.saveHotelHabitacionIdioma = function(){
            ctrlHotel.hotelHabitacionIdiomaTO.descripcion = $("#descripcionHotelHabitacionIdioma").code();
            return HotelService.saveHabitacionIdioma(ctrlHotel.hotelHabitacionIdiomaTO).then(function(data){
                pNotifyView(data.data.message, data.data.typeStatus);
                ctrlHotel.showIdiomaHabitacionDescripcion = false;
                ctrlHotel.showIdiomaHabitacionBolean = false;
                ctrlHotel.hotelHabitacionIdiomaTO = {
                    id: "",
                    idIdioma: ""
                };
            });
        };

        ctrlHotel.saveHotelTarifaTO = function(){
            return HotelService.saveTarifaHotel().then(function(data){
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        ctrlHotel.getDate = function(fechaInicio, fechaFin){
            var fechaInicioParts = fechaInicio.split('-');
            var fechaFinParts = fechaFin.split('-');
            var fechas = [];
            fechas[0] = $.trim(fechaInicioParts[2])+'/'+ $.trim(fechaInicioParts[1])+'/'+ $.trim(fechaInicioParts[0]);
            fechas[1] = $.trim(fechaFinParts[2])+'/'+ $.trim(fechaFinParts[1])+'/'+ $.trim(fechaFinParts[0]);

            return fechas;
        };

    });

})();