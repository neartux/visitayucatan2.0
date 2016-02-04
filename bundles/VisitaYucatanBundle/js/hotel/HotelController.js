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
        ctrlHotel.hotel = undefined;
        ctrlHotel.listHotel = HotelService.listHotel;
        ctrlHotel.listLanguage = HotelService.listLanguage;
        ctrlHotel.hotelIdiomaTo = HotelService.hotelIdiomaTO;
        ctrlHotel.imagesHotel = HotelService.imagesHotelList;
        ctrlHotel.titleCreate = '';
        ctrlHotel.titleEdit = '';
        ctrlHotel.msjLoading = '';
        ctrlHotel.msjDeleteImage = '';
        ctrlHotel.titleModal = '';
        ctrlHotel.isNewHotel = true;
        ctrlHotel.configHotel = false;
        ctrlHotel.idHotelGlobal = 0;
        ctrlHotel.nameHotelTitle = '';

        ctrlHotel.init = function (titleCreate, titleEdit, confirmDelete, msjLoading, msjDeleteImg) {
            ctrlHotel.titleCreate = titleCreate;
            ctrlHotel.titleEdit = titleEdit;
            ctrlHotel.msjLoading = msjLoading;
            ctrlHotel.titleModal = titleCreate;
            ctrlHotel.confirmDelete = confirmDelete;
            ctrlHotel.msjDeleteImage = msjDeleteImg;
            ctrlHotel.findAllHotels();
            ctrlHotel.findAllLanguages();
        };

        ctrlHotel.findAllHotels = function () {
            return HotelService.findHotelsActives();
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
            ctrlHotel.configTour = true;
            ctrlHotel.hotelIdiomaTo.data = undefined;
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
                $("#description").trigger('focus');
            }, 1000);
        };

        ctrlHotel.displayEditHotel = function (hotel) {
            ctrlHotel.titleModal = ctrlHotel.titleEdit;
            ctrlHotel.hotel = JSON.parse(JSON.stringify(hotel));
            ctrlHotel.isNewHotel = false;
            $("#modalHotel").modal();
            setTimeout(function () {
                $("#description").trigger('focus');
            }, 1000);
        };

        ctrlHotel.saveFormHotel = function (isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlHotel.hotel != undefined) {
                startLoading(ctrlHotel.msjLoading);
                return HotelService.createHotel(ctrlHotel.hotel).then(function (data) {
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
            if (isValid && ctrlHotel.hotel != undefined) {
                startLoading(ctrlHotel.msjLoading);
                return HotelService.updateHotel(ctrlHotel.hotel).then(function (data) {
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
            $("#description").val("");
        };

    });

})();