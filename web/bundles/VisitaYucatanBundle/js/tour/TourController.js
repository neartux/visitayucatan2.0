/**
 * Created by ricardo on 8/01/16.
 */
(function () {
    var app = angular.module('Tour', ['angularFileUpload', 'TourProvider']).config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.directive('ngThumb', ['$window', function($window) {
        var helper = {
            support: !!($window.FileReader && $window.CanvasRenderingContext2D),
            isFile: function(item) {
                return angular.isObject(item) && item instanceof $window.File;
            },
            isImage: function(file) {
                var type =  '|' + file.type.slice(file.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        };

        return {
            restrict: 'A',
            template: '<canvas/>',
            link: function(scope, element, attributes) {
                if (!helper.support) return;

                var params = scope.$eval(attributes.ngThumb);

                if (!helper.isFile(params.file)) return;
                if (!helper.isImage(params.file)) return;

                var canvas = element.find('canvas');
                var reader = new FileReader();

                reader.onload = onLoadFile;
                reader.readAsDataURL(params.file);

                function onLoadFile(event) {
                    var img = new Image();
                    img.onload = onLoadImage;
                    img.src = event.target.result;
                }

                function onLoadImage() {
                    var width = params.width || this.width / this.height * params.height;
                    var height = params.height || this.height / this.width * params.width;
                    canvas.attr({ width: width, height: height });
                    canvas[0].getContext('2d').drawImage(this, 0, 0, width, height);
                }
            }
        };
    }]);

    app.controller('TourController', ['$scope', 'FileUploader', '$http', 'TourService', function($scope, FileUploader, $http, TourService) {
        var ctrlTour = this;
        ctrlTour.tour = undefined;
        ctrlTour.listTour = TourService.listTour;
        ctrlTour.titleCreate = '';
        ctrlTour.titleEdit = '';
        ctrlTour.msjLoading = '';
        ctrlTour.titleModal = '';
        ctrlTour.isNewTour = true;
        ctrlTour.configTour = false;

        ctrlTour.init = function (titleCreate, titleEdit, confirmDelete, msjLoading) {
            ctrlTour.titleCreate = titleCreate;
            ctrlTour.titleEdit = titleEdit;
            ctrlTour.msjLoading = msjLoading;
            ctrlTour.titleModal = titleCreate;
            ctrlTour.confirmDelete = confirmDelete;
            ctrlTour.findAllTours();
        };
        var pathImage = $("#pathUploadImageTour").val();
        var uploader = $scope.uploader = new FileUploader({
            url: pathImage,
            removeAfterUpload: true,
            formData: [
                { "idTour": 1 }
            ]
        });

        ctrlTour.findAllTours = function () {
            return TourService.findToursActives();
        };

        ctrlTour.displayNewTour = function () {
            ctrlTour.cleanForm();
            ctrlTour.titleModal = ctrlTour.titleCreate;
            ctrlTour.isNewTour = true;
            ctrlTour.tour = {
                minimopersonas: 1
            };
            $("#modalTour").modal();
            setTimeout(function () {
                $("#description").trigger('focus');
            }, 1000);
        };

        ctrlTour.displayEditTour = function (tour) {
            ctrlTour.titleModal = ctrlTour.titleEdit;
            ctrlTour.tour = JSON.parse(JSON.stringify(tour));
            ctrlTour.isNewTour = false;
            $("#modalTour").modal();
            setTimeout(function () {
                $("#description").trigger('focus');
            }, 1000);
        };

        ctrlTour.saveFormTour = function (isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlTour.tour != undefined) {
                startLoading(ctrlTour.msjLoading);
                return TourService.createTour(ctrlTour.tour).then(function (data) {
                    stopLoading();
                    if (data.data.status) {
                        ctrlTour.findAllTours();
                        updateDataTable();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalTour").modal("hide");
                });
            }

        };

        ctrlTour.updateTour = function (isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlTour.tour != undefined) {
                startLoading(ctrlTour.msjLoading);
                return TourService.updateTour(ctrlTour.tour).then(function (data) {
                    stopLoading();
                    if (data.data.status) {
                        ctrlTour.findAllTours();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalTour").modal("hide");
                });
            }

        };

        ctrlTour.deleteTour = function (idTour) {
            if (confirm(ctrlTour.confirmDelete)) {
                return TourService.deleteTourById(idTour).then(function (data) {
                    if (data.data.status) {
                        ctrlTour.findAllTours();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        ctrlTour.promovedTour = function (idTour) {
            return TourService.promovedTour(idTour).then(function (data) {
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        ctrlTour.removePromovedTour = function (idTour) {
            return TourService.removePromovedTour(idTour).then(function (data) {
                pNotifyView(data.data.message, data.data.typeStatus);
            });
        };

        ctrlTour.configurateTour = function(tour){
          ctrlTour.configTour = true;
        };

        ctrlTour.cleanForm = function () {
            $("#description").val("");
            $("#symbolo").val("");
            $("#tipoCambio").val("");
        };



        // FILTERS

        uploader.filters.push({
            name: 'imageFilter',
            fn: function(item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });

        // CALLBACKS

        uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
            console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploader.onAfterAddingFile = function(fileItem) {
            console.info('onAfterAddingFile', fileItem);
        };
        uploader.onAfterAddingAll = function(addedFileItems) {
            console.info('onAfterAddingAll', addedFileItems);
        };
        uploader.onBeforeUploadItem = function(item) {
            console.info('onBeforeUploadItem', item);
        };
        uploader.onProgressItem = function(fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
        };
        uploader.onProgressAll = function(progress) {
            console.info('onProgressAll', progress);
        };
        uploader.onSuccessItem = function(fileItem, response, status, headers) {
            console.info('onSuccessItem', fileItem, response, status, headers);
        };
        uploader.onErrorItem = function(fileItem, response, status, headers) {
            console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader.onCancelItem = function(fileItem, response, status, headers) {
            console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploader.onCompleteItem = function(fileItem, response, status, headers) {
            console.info('onCompleteItem', fileItem, response, status, headers);
        };
        uploader.onCompleteAll = function() {
            ctrlTour.completeUploadImage();
        };

        ctrlTour.completeUploadImage = function(){
            console.log("termina todo");
            console.info(uploader);
        };

        console.info('uploader', uploader);

    }]);

})();