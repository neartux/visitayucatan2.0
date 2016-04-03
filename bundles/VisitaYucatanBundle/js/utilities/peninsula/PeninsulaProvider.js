/**
 * Created by rafael on 20/03/16.
 */

 (function () {
 	var app = angular.module('PeninsulaProvider', []);
 	app.factory('PeninsulaService', function($http, $q){
     var service = {};

     service.listPeninsula = {
     	data: undefined
     };

     service.peninsulaIdiomaTO = {
            data: undefined
        };

    service.listLanguage = {
            data: undefined
        };

     service.findPeninsulasActives = function (){
     	var path = $("#pathListPeninsula").val();
     	service.listPeninsula.data = [];
     	return $http.get(path).then(function(data){    		
     		service.listPeninsula.data = data.data;
     	});

     };

     service.createPeninsula = function(peninsula){
         
          var path = $("#pathCreatePeninsula").val();
          return $http.post(path, $.param({peninsula : peninsula}), {
               headers:{'Content-Type': 'application/x-www-form-urlencoded'}
          });
     };

     service.addPeninsula = function (objPeninsula){
          service.listPeninsula.data.push(objPeninsula);
     };

     service.updatePeninsulaOfTheList = function(objPeninsula){
          var iterate = true;
          
          return angular.forEach(service.listPeninsula.data, function(value, index){
               if (iterate) {

                    if (parseInt(objPeninsula.id) == parseInt(value.id)) {
                         service.listPeninsula.data[index] = objPeninsula;
                         iterate = false;
                         
                    }
               }
          });
     };

     service.updatePeninsula = function(idPeninsula,peninsula){
            var path = $("#pathUpdatePeninsula").val();
            
            return $http.post(path, $.param({idPeninsula: idPeninsula ,peninsula : peninsula}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };


        service.deletePeninsula = function(id){
            var iterate = true;
           angular.forEach(service.listPeninsula.data, function(valor, indice) {
                if(iterate){
                    if (id == valor.id){
                        service.listPeninsula.data.splice(indice, 1);
                        iterate = false;

                    }
                }                    
            });
        };

        service.deletePeninsulaById = function(idPeninsula){
          
            var path = $("#pathDeletePeninsula").val();
            return $http.post(path, $.param({idPeninsula : idPeninsula}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.findLanguagesActives= function(){
            var path = $("#pathAllLanguages").val();
            service.listLanguage.data = [];
            return $http.get(path).then(function(data){
                service.listLanguage.data = data.data;
            });
        };


        service.findPeninsulaByIdAndLanguaje = function(idPeninsula, idLanguage){
            var path = $("#pathPeninsulaByLanguage").val();
            return $http.post(path, $.param({idPeninsula : idPeninsula, idLanguage : idLanguage}), {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (data){
                if(data.data == "false"){
                    service.validation(idLanguage);
                }else{
                   service.peninsulaIdiomaTO.data = data.data;
                }
            });
        };

        service.validation = function(idioma){
            service.peninsulaIdiomaTO.data = {
                idIdioma : idioma,
                nombre : '',
                descripcion: '',
            }
        };

        service.savePeninsulaLanguage = function(descripcion, nombre, idPeninsula, idLanguage){
           var path = $("#pathSavePeninsulaLanguage").val();
           return $http.post(path, $.param({descripcion : descripcion, nombre :nombre, idPeninsula : idPeninsula, idLanguage : idLanguage }), {
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
           });
        };

        service.updatePeninsulaLanguage = function(idarticuloidioma, nombre, descripcion){

            var path = $("#pathUpdatePeninsulaLanguage").val();
            return $http.post(path, $.param({idarticuloidioma : idarticuloidioma, nombre : nombre, descripcion : descripcion}), { headers : {'Content-Type': 'application/x-www-form-urlencoded'}
        });
        };



     return service;

 	});

 })();