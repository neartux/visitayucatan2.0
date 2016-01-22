/**
 * Created by ricardo on 5/01/16.
 */
(function () {
    var app = angular.module('UserProvider', []);
    app.factory('UserService', function($http, $q){

        var service = {};

        service.listUser = {
            data:undefined
        };

        service.findUserActives= function(){
            var path = $("#pathListUser").val();
            service.listUser.data = [];
            return $http.get(path).then(function(data){
                console.log(JSON.stringify(data.data));
                service.listUser.data = data.data;
            });
        };

        service.createUser = function(User){
            var path = $("#pathCreateUser").val();
            return $http.post(path, $.param({user : JSON.stringify(User)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.updateUser = function(User){
            var path = $("#pathUpdateUser").val();
            return $http.post(path, $.param({user : JSON.stringify(User)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.deleteUserById = function(idUser){
            var path = $("#pathDeleteUser").val();
            return $http.post(path, $.param({idUser : idUser}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        return service;
    });
})();