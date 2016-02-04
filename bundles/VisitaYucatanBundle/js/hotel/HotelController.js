/**
 * Created by ricardo on 3/02/16.
 */
(function () {
    var app = angular.module('Hotel', ['HotelProvider']).config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('HotelController', function ($scope, $http, HotelService) {
        var ctrlTour = this;
        ctrlTour.hotel = undefined;
        ctrlTour.listHotel = HotelService.listHotel;
        ctrlTour.listLanguage = HotelService.listLanguage;
        ctrlTour.hotelIdiomaTo = HotelService.hotelIdiomaTO;
        ctrlTour.imagesHotel = HotelService.imagesHotelList;
        ctrlTour.titleCreate = '';
        ctrlTour.titleEdit = '';
        ctrlTour.msjLoading = '';
        ctrlTour.msjDeleteImage = '';
        ctrlTour.titleModal = '';
        ctrlTour.isNewHotel = true;
        ctrlTour.configHotel = false;
        ctrlTour.idHotelGlobal = 0;
        ctrlTour.nameHotelTitle = '';

        ctrlTour.init = function (titleCreate, titleEdit, confirmDelete, msjLoading, msjDeleteImg) {
            ctrlTour.titleCreate = titleCreate;
            ctrlTour.titleEdit = titleEdit;
            ctrlTour.msjLoading = msjLoading;
            ctrlTour.titleModal = titleCreate;
            ctrlTour.confirmDelete = confirmDelete;
            ctrlTour.msjDeleteImage = msjDeleteImg;
            ctrlTour.findAllHotels();
            ctrlTour.findAllLanguages();
        };

        ctrlTour.findAllHotels = function () {
            return HotelService.findHotelsActives();
        };

        ctrlTour.findAllLanguages = function () {
            return HotelService.findLanguagesActives();
        };

        ctrlTour.findHotelByIdAndLanguage = function () {
            if(ctrlTour.hotelIdiomaTo.data != undefined){
                var idiomaTmp = ctrlTour.hotelIdiomaTo.data.idIdioma;
                return HotelService.findHotelByIdAndLanguaje(ctrlTour.idHotelGlobal, ctrlTour.hotelIdiomaTo.data.idIdioma).then(function(){
                    ctrlTour.hotelIdiomaTo.data.idIdioma = idiomaTmp;
                    if(! ctrlTour.hotelIdiomaTo.data.status){
                        pNotifyView(ctrlTour.hotelIdiomaTo.data.message, ctrlTour.hotelIdiomaTo.data.typeStatus);
                    }
                    // El siguiente codigo para colocar el texto en el summernote, no se coloca de manera normal con el ng-model
                    $(".summernote").code(ctrlTour.hotelIdiomaTo.data.descripcion);
                });
            }
        };

        ctrlTour.findImagesByHotel = function () {
            setTimeout(function(){
                return HotelService.findImagesHotelByIdHotel(ctrlTour.idHotelGlobal);
            }, 1000);
        };

        ctrlTour.setPrincipalImageHotel = function(idHotel, idImageHotel){
            return HotelService.setPrincipalImage(idHotel, idImageHotel).then(function(data){
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        ctrlTour.deleteImageHotel = function(idImageHotel){
            if(confirm(ctrlTour.msjDeleteImage)){
                return HotelService.deleteImageHotel(idImageHotel).then(function(data){
                    pNotifyView(data.data.message, data.data.typeStatus);
                    if(data.data.status){
                        ctrlTour.findImagesByHotel();
                    }
                });
            }
        };

        ctrlTour.saveHotelLanguage = function(isValid){
            if(isValid){
                startLoading(ctrlTour.msjLoading);
                // Asignasiones
                ctrlTour.hotelIdiomaTo.data.descripcion = $(".summernote").code();
                ctrlTour.hotelIdiomaTo.data.idHotel = ctrlTour.idHotelGlobal;
                return HotelService.saveHotelLanguage(ctrlTour.hotelIdiomaTo.data).then(function (data) {
                    stopLoading();
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        ctrlTour.configurateHotel = function (hotel) {
            ctrlTour.nameHotelTitle = hotel.descripcion;
            ctrlTour.idHotelGlobal = hotel.id;
            ctrlTour.configTour = true;
            ctrlTour.hotelIdiomaTo.data = undefined;
            $(".summernote").code('');
            ctrlTour.findImagesByHotel();
        };

        ctrlTour.returnListTour = function(){
            ctrlTour.configHotel = false;
        };

        ctrlTour.displayNewHotel = function () {
            ctrlTour.cleanForm();
            ctrlTour.titleModal = ctrlTour.titleCreate;
            ctrlTour.isNewHotel = true;
            $("#modalHotel").modal();
            setTimeout(function () {
                $("#description").trigger('focus');
            }, 1000);
        };

        ctrlTour.displayEditHotel = function (hotel) {
            ctrlTour.titleModal = ctrlTour.titleEdit;
            ctrlTour.hotel = JSON.parse(JSON.stringify(hotel));
            ctrlTour.isNewHotel = false;
            $("#modalHotel").modal();
            setTimeout(function () {
                $("#description").trigger('focus');
            }, 1000);
        };

        ctrlTour.saveFormHotel = function (isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlTour.hotel != undefined) {
                startLoading(ctrlTour.msjLoading);
                return HotelService.createHotel(ctrlTour.hotel).then(function (data) {
                    stopLoading();
                    if (data.data.status) {
                        ctrlTour.findAllHotels();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalHotel").modal("hide");
                });
            }

        };

        ctrlTour.updateHotel = function (isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlTour.hotel != undefined) {
                startLoading(ctrlTour.msjLoading);
                return HotelService.updateHotel(ctrlTour.hotel).then(function (data) {
                    stopLoading();
                    if (data.data.status) {
                        ctrlTour.findAllHotels();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalHotel").modal("hide");
                });
            }

        };

        ctrlTour.deleteHotel = function (idHotel) {
            if (confirm(ctrlTour.confirmDelete)) {
                return HotelService.deleteHotelById(idHotel).then(function (data) {
                    if (data.data.status) {
                        ctrlTour.findAllHotels();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        ctrlTour.promovedHotel = function (idHotel) {
            return HotelService.promovedHotel(idHotel).then(function (data) {
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        ctrlTour.removePromovedHotel = function (idHotel) {
            return HotelService.removePromovedHotel(idHotel).then(function (data) {
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        ctrlTour.cleanForm = function () {
            $("#description").val("");
        };

    });

})();