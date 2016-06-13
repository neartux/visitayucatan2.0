(function() {
    var app = angular.module('WebDirectives',[])
    app.directive('formDetailPaquete',function(){
        return {
            restrict:'EA',
            replace:false,
            template:'<form action="[[urlPath]]" method="[[method]]">'+
                    '<input type="hidden" name="id" value="[[json.id]]">'+
                    '<input type="hidden" name="costo" value="[[json.costo]]">'+
                    '<input type="hidden" name="typeocupacion" value="[[json.ocupacion]]">'+
                    '<input type="hidden" name="namepaquete" value="[[namePaquete]]">'+
                        '<span>[[json.nomHotel]]</span> '+
                        '<span>[[json.costo | myCurrency2 ]] [[json.simbolo]]</span>'+
                        '<button type="submit"> Reservar </button>'+
                '</form>',
            scope:{
                item:'=item',
                urlPath:'@',
                method:'@',
                namePaquete:'@'
            },
            link: function(scope,element,attrs){
                console.info('attrs',attrs);
               scope.json = scope.item[0][0];
               console.info("item json",scope.json );
               console.info("urlPath",scope.urlPath);
            }
        }
    });
})();