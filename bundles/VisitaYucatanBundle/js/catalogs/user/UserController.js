/**
 * Created by ricardo on 5/01/16.
 */
(function (){
    var app = angular.module('User', ['UserProvider']).config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('UserController', function ($scope, $http, UserService){
        var ctrlUser  = this;
        ctrlUser.user = undefined;
        ctrlUser.listUser = UserService.listUser;
        ctrlUser.titleCreate = '';
        ctrlUser.titleEdit = '';
        ctrlUser.msjLoading = '';
        ctrlUser.titleModal = '';
        ctrlUser.isNewUser = true;

        ctrlUser.init = function (titleCreate, titleEdit, msjLoading, confirmDelete) {
            ctrlUser.titleCreate = titleCreate;
            ctrlUser.titleEdit = titleEdit;
            ctrlUser.msjLoading = msjLoading;
            ctrlUser.titleModal = titleCreate;
            ctrlUser.confirmDelete = confirmDelete;
            ctrlUser.findAllUser();
        };

        ctrlUser.findAllUser = function(){
            return UserService.findUserActives();
        };

        ctrlUser.displayNewUser = function(){
            ctrlUser.cleanForm();
            ctrlUser.titleModal = ctrlUser.titleCreate;
            ctrlUser.isNewUser = true;
            $("#modalUser").modal();
            setTimeout(function(){
                $("#username").trigger('focus');
            }, 1000);
        };

        ctrlUser.displayEditUser = function(User){
            ctrlUser.titleModal = ctrlUser.titleEdit;
            ctrlUser.user = JSON.parse(JSON.stringify(User));
            ctrlUser.isNewUser = false;
            ctrlUser.user.password = '';
            $("#modalUser").modal();
            setTimeout(function(){
                $("#username").trigger('focus');
            }, 1000);
        };

        ctrlUser.saveformUser = function(isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlUser.user != undefined) {
                startLoading(ctrlUser.msjLoading);
                return UserService.createUser(ctrlUser.user).then(function(data){
                    stopLoading();
                    if(data.data.status){
                        ctrlUser.findAllUser();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalUser").modal("hide");
                });
            }

        };

        ctrlUser.updateUser = function(isValid) {
            // check to make sure the form is completely valid
            if (isValid && ctrlUser.user != undefined) {
                startLoading(ctrlUser.msjLoading);
                return UserService.updateUser(ctrlUser.user).then(function(data){
                    stopLoading();
                    if(data.data.status){
                        ctrlUser.findAllUser();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                    $("#modalUser").modal("hide");
                });
            }

        };

        ctrlUser.deleteUser = function(idUser){
            if(confirm(ctrlUser.confirmDelete)){
                return UserService.deleteUserById(idUser).then(function(data){
                    if(data.data.status){
                        ctrlUser.findAllUser();
                    }
                    pNotifyView(data.data.message, data.data.typeStatus);
                });
            }
        };

        ctrlUser.cleanForm = function(){
            $("#username").val("");
            $("#nombres").val("");
            $("#apellidos").val("");
            $("#direccion").val("");
            $("#telefono").val("");
            $("#celular").val("");
            $("#email").val("");
            $("#password").val("");
        }

    });

})();