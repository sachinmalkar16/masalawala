(function () {
    'use strict';

    angular.module('MyApp')
        .directive('serverValidate', serverValidate);

    serverValidate.$inject = [];

    function serverValidate() {
        return {
            restrict: 'A',
            require: 'form',
            link: function ($scope, $elem, $attrs, form) {
                var invalidateField = function (field, errorType) {
                    var changeListener = function () {
                        field.$setValidity(errorType, true);

                        var index = field.$viewChangeListeners.indexOf(changeListener);
                        if (index > -1) {
                            field.$viewChangeListeners.splice(index, 1);
                        }
                    };

                    field.$setDirty();
                    field.$setValidity(errorType, false);
                    field.$viewChangeListeners.push(changeListener);
                };

                $scope.$watch('serverErrors', function (errors) {

                    if (errors) {
                        angular.forEach(errors, function (error,name) {
                            if (name in form) {
                                invalidateField(form[name], 'server.error');
                                var errorMessage='';
                                angular.forEach(error,function(message){
                                    errorMessage = errorMessage + message + ";";
                                });
                                $scope.formErrors[name]= errorMessage;
                            }
                        });
                    }
                });

            }
        };
    }
})();
