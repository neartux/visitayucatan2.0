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
                        '<span>[[json.costo]]</span>'+
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
               console.info("item",scope.item);
               console.info("urlPath",scope.urlPath);
            }
        }
    });
    /* 
    <form action="{{ path('web_tour_reserva') }}" method="POST">
                    <input type="hidden" value="{{ tour.id }}" name="idTour"/>

                    fecha tour: <input type="text" name="fechaReserva" class="datepicker"/>&nbsp; Menores:
                    <select name="numeroMenores" data-ng-model="ctrlWeb.totalPersons.children" ng-change="ctrlWeb.recalculateCostTour()">
                        <option value='0'>0</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                    </select> 
                    Adultos: 
                    <select name="numeroAdultos" data-ng-model="ctrlWeb.totalPersons.adults" ng-change="ctrlWeb.recalculateCostTour()">
                        <option value='0'>0</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                    </select>

                    <hr>
                    reserva ahora <br>
                    2 Adultos, impuestos incluidos <br>
                    transporte saliendo de {# lo anterior es propertie lo siguiente no #} {{ tour.origen }} <br>
                    <button type="submit">
                        Reserva
                    </button>
                    <br>
                    <span id="totalCostTour">${{ tour.costTwoAdults }} {{ tour.simboloMoneda }}</span>

                </form>*/
})();