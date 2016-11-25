(function () {
    'use strict';

    angular.module('MyApp').directive('date', date)

    date.$inject = ['dateFilter'];
    function date(dateFilter) {
        return {
            require: 'ngModel',
            link: function (scope, elm, attrs, ctrl) {

                var dateFormat = attrs['date'] || 'yyyy-MM-dd';

                ctrl.$formatters.unshift(function (modelValue) {
                    return dateFilter(modelValue, dateFormat);
                });
            }
        };
    }

})();
