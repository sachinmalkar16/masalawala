'use strict';

angular.module('MyApp')
    .controller('OrdersListCtrl', function ($scope, $state, OrdersSvc, Utils) {
        $scope.orders = [];
        $scope.currency = Utils.getCookie('setting').currency;
        OrdersSvc.list().then(function(result){
            $scope.orders = result.data;
        });
    });