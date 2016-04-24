/**
 * Created by ricardo on 25/12/15.
 */
(function () {
    var app = angular.module('LanguageProvider', []);
    app.factory('LanguageService', function($http, $q){

        var service = {};

        service.listLanguage = {
            data:undefined
        };

        service.findLanguageActives= function(){
            var path = $("#pathListLanguage").val();
            service.listLanguage.data = [];
            return $http.get(path).then(function(data){
                
                service.listLanguage.data = data.data;
            });
        };

        service.addLanguage = function (objLanguage) {
            console.info("addLanguage = "+JSON.stringify(objLanguage));
            service.listLanguage.data.push(objLanguage);
        }

        service.deleteLanguage = function(id){
            var iterate = true;
           angular.forEach(service.listLanguage.data, function(valor, indice) {
                if(iterate){
                    if (id == valor.id ){
                        service.listLanguage.data.splice(indice, 1);
                        iterate = false;
                    }
                }                    
            });
        };

        service.updateLanguageOfTheList = function(objLanguage){
            var iterate = true;
            return angular.forEach(service.listLanguage.data, function(value, index){
                if(iterate){
                    if(parseInt(objLanguage.id) == parseInt(value.id)){
                        service.listLanguage.data[index] = objLanguage;
                        iterate = false;
                    }
                }
            });
        };

        service.createLanguage = function(language){
            console.info("Peninsula = "+JSON.stringify(language));
            var path = $("#pathCreateLanguage").val();
            return $http.post(path, $.param({language : JSON.stringify(language)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.updateLanguage = function(language){
            var path = $("#pathUpdateLanguage").val();
            return $http.post(path, $.param({language : JSON.stringify(language)}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.deleteLanguageById = function(idLanguage){
            var path = $("#pathDeleteLanguage").val();
            return $http.post(path, $.param({idLanguage : idLanguage}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        return service;
    });
})();