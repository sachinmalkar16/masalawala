(function () {
    'use strict';
    angular.module('MyApp')
        .controller('HomeController', HomeController);

    HomeController.$inject = ['$scope','$auth','$state','CategoriesSvc'];

    function HomeController($scope,$auth, $state,CategoriesSvc) {
        var vm = this;

        CategoriesSvc.list().then(function (result) {
            vm.categories = result.data;
        });

        vm.search = function () {

            vm.goTo('search.list');
        };

        vm.goTo = function (url) {
            $state.go(url);
        }
    }
})();