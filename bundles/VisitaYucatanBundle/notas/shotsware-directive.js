/**
 * Created by Renan on 15/12/2016.
 */
(function(){
    var app = angular.module('shotsware-directives', []);

    app.directive('shotswareOnlyNumber', function() {
        return {
            restrict: 'A',
            link: function(scope, element) {
                $(element).numeric();
            }
        }
    });

    app.directive('shotswareOnlyNumberDecimal', function() {
        return {
            restrict: 'A',
            link: function(scope, element) {
                $(element).numeric({allow:"."});
            }
        }
    });

    app.directive('shotswareNoEnter', function () {
        return {
            restrict: 'A',
            link: function (scope, element) {
                $(element).keypress(function (event) {
                    var tecla = (document.all) ? event.keyCode : event.which;
                    return (tecla != 13);
                });
            }
        }
    });

    app.directive('shotswareContextPath', function (CommonProvider) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                var path = attrs.shotswareContextPath;
                CommonProvider.contextPath = path;
            }
        }
    });

    app.directive('shotswareAlEscribir', function (CommonProvider) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                $(element).keydown(function () {
                    var idForm = attrs.shotswareAlEscribir;
                    CommonProvider.removeClassInvidualForm(idForm);
                });
            }
        }
    });

    app.directive('shotswareAlClick', function (CommonProvider) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                $(element).click(function () {
                    var idForm = attrs.shotswareAlClick;
                    CommonProvider.removeClassInvidualForm(idForm);
                });
            }
        }
    });

    app.directive('shotswareAlCambiar', function (CommonProvider) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                $(element).change(function () {
                    var idForm = attrs.shotswareAlCambiar;
                    var valorClass = $("."+idForm).text();
                    if(valorClass == "" || valorClass == undefined){
                        CommonProvider.removeClassInvidualForm(idForm);
                    }
                });
            }
        }
    });

    app.directive('shotswareStylePopover', function (CommonProvider) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                var idForm = attrs.shotswareStylePopover;
                CommonProvider.removeClassInvidualForm(idForm);
                CommonProvider.configurePopover();
            }
        }
    });

    app.directive('shotswareBootbox', function (CommonProvider) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                $(element).click(function () {
                    var message = attrs.shotswareBootBoxMsg;
                    var loading = attrs.shotswareBootBoxLoading;
                    var id = attrs.shotswareBootbox;
                    CommonProvider.confirmSaveBootbox(message, loading, id);
                });
            }
        }
    });

    app.directive('shotswareValidation', ['$compile', 'CommonProvider', function($compile, CommonProvider) {
        return {
            priority: 1000,
            terminal: true,
            compile: function(element, attr) {
                element.removeAttr('shotsware-validation');
                element.attr('ng-pattern', CommonProvider.getPatternValidation(attr.shotswareValidation));
                return {
                    pre: function preLink(scope, iElement, iAttrs, controller) {},
                    post: function postLink(scope, iElement, iAttrs, controller) {
                        $compile(iElement)(scope);
                    }
                };
            }
        };
    }]);
})();